<?php

class CatalogCategoryUrlRule extends CBaseUrlRule
{
    public $connectionID = 'db';
    public $urlSuffix = '';
    public $urlPrefix = '';

    public function createUrl( $manager, $route, $params, $ampersand )
    {
        $url = array();

        if ($route == 'catalog/category/view' || $route == '/catalog/element/view') {
            if ((!empty($params[ 'id' ])
                    && ($category = CatalogCategory::model()->findByPk( $params[ 'id' ] )))
                || (!empty($params[ 'name' ])
                    && ($category = CatalogCategory::model()->findByAttributes( array( 'name' => $params[ 'name' ] ) )))
            ) {
                foreach ($category->ancestors()->findAll() as $ancestor) {
                    $url[ ] = $ancestor->name;
                }
                $url[ ] = $category->name;
            }
        }

        if ($route == 'catalog/element/view' || $route == '/catalog/element/view') {
            if (!empty($params[ 'id' ])
                && ($element = CatalogElement::model()->findByPk( $params[ 'id' ] ))
                && ($category = $element->category)
            ) {
                foreach ($category->ancestors()->findAll() as $ancestor) {
                    $url[ ] = $ancestor->name;
                }
                $url[ ] = $category->name;
                $url[ ] = $element->name;
            }
        }

        if (count( $url )) {
            unset($params[ 'id' ]);
            unset($params[ 'name' ]);
            foreach ($params as $k => $v) {
                $url[ ] = $k;
                $url[ ] = $v;
            }
            return implode( '/', $url );
        }

        return false;
    }

    public function parseUrl( $manager, $request, $pathInfo, $rawPathInfo )
    {
        if (empty($pathInfo)) {
            return false;
        }

        if (($pathLang = explode( '/', $pathInfo )) && $pathLang[ 0 ] == Yii::app()->language) {
            $pathInfo = implode( '/', array_shift( $pathLang ) );
        }

        $categoryId = 0;
        $pathInfo = ltrim( $pathInfo, '/' );
        $paths = $this->getAllPaths();
        $params = array();

        for ($i = 0, $level = 1, $p = explode( '/', $pathInfo ), $cnt = count( $p ); $i < $cnt; $i++, $level++) {
            $path = array_shift( $p );

            /**
             * Ищем категории, если нашли переходим на следущий уровень
             */
            if (!empty($paths[ $level ]) && !empty($paths[ $level ][ $path ]) && ($catId = $paths[ $level ][ $path ])) {
                $_GET[ 'id' ] = ($categoryId = $catId);
                continue;
            }

            /**
             * Проверяем последнюю часть URL /p1/p2/{p3} <---
             * Ищем элемент каталога по name == {p3}
             */
            if ($element = CatalogElement::model()->findByAttributes( array( 'name' => $path ) )) {
                $_GET[ 'id' ] = $element->id;
                return 'catalog/element/view';
            }

            $p = array_merge( array( $path ), $p );
            foreach ($p as $k => $v) {
                if (($k + 1) % 2) {
                    $_GET[ $p[ $k ] ] = false;
                } else {
                    $_GET[ $p[ $k - 1 ] ] = $v;
                }
            }
            break;
        }

        if ($categoryId) {
            return 'catalog/category/view';
        }
        return false;
    }

    protected function getAllPaths()
    {
        $allPaths = false; //Yii::app()->cache->get( 'CatalogCategoryUrlRule' );
        if ($allPaths === false) {
            $cb = Yii::app()->db->getCommandBuilder();
            $cr = new CDbCriteria();
            $cr->select = array( 'level, name, id' );
            $data = $cb->createFindCommand( CatalogCategory::model()->tableName(), $cr )->queryAll();

            $allPaths = array();
            foreach ($data as $row) {
                $allPaths[ $row[ 'level' ] ][ $row[ 'name' ] ] = $row[ 'id' ];
            }
            //Yii::app()->cache->set( 'CatalogCategoryUrlRule', $allPaths );
        }

        return $allPaths;
    }
}
