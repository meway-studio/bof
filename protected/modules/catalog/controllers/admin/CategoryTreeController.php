<?php

/**
 * Class CategoryController
 * @property $currentCategory CatalogCategory
 */
class CategoryTreeController extends BackController
{
    public $layout = '//layouts/column1';
    public $defaultAction = 'moveNode';
    public $isRoot = false;
    public $category_id = 0;
    public $currentCategory = null;

    /*public function filters()
    {
        return CMap::mergeArray(
            parent::filters(),
            array(
                'ajaxOnly',
            )
        );
    }*/

    public function init()
    {
        header( 'Content-type: application/json' );

        // Отключаем логирование
        if (Yii::app()->hasComponent( 'log' )) {
            foreach (Yii::app()->log->routes as $route) {
                $route->enabled = false;
            }
        }
        parent::init();
    }

    /**
     * Drag-n-drop nodes
     */
    public function actionMoveNode()
    {
        $node = CatalogCategory::model()->findByPk( $_GET[ 'id' ] );
        $target = CatalogCategory::model()->findByPk( $_GET[ 'ref' ] );

        if ((int)$_GET[ 'position' ] > 0) {
            $pos = (int)$_GET[ 'position' ];
            $childs = $target->children()->findAll();

            if (isset($childs[ $pos - 1 ])
                && $childs[ $pos - 1 ] instanceof CatalogCategory
                && $childs[ $pos - 1 ][ 'id' ] != $node->id
            ) {
                $node->moveAfter( $childs[ $pos - 1 ] );
            }
        } else {
            $node->moveAsFirst( $target );
        }

        $node->saveNode( false );
    }

    /**
     * Redirect to category front.
     */
    public function actionRedirect()
    {
        $node = CatalogCategory::model()->findByPk( $_GET[ 'id' ] );
        $this->redirect( $node->getUrl() );
    }

    /**
     * @param $id
     * @throws CHttpException
     */
    public function actionDelete( $id )
    {
        $categoryId = 0;
        $model = CatalogCategory::model()->findByPk( $id );

        //Delete if not root node
        if ($model /*&& !$model->isRoot()*/) {
            if ($root = $model->parent()->find()) {
                $categoryId = $root->id;
            }
            $model->deleteAllElements();
            $model->deleteNode();
        }

        if (!Yii::app()->request->isAjaxRequest) {
            $this->redirect( Yii::app()->createUrl( 'catalog/admin/category/index', array( 'id' => $categoryId ) ) );
        }
    }

    public function actionRoots()
    {
        $idPrefix = 'CatalogCategoryTreeNode_';
        $result = array();
        $currentId = Yii::app()->request->getQuery( 'current_id', 0 );
        $catalog = CatalogCategory::model()->findByPk(
            Yii::app()->request->getQuery( 'id', 0 )
        );

        if ($catalog) {
            $node = array(
                'id'       => $idPrefix . $catalog->id,
                'text'     => $catalog->title . " ({$catalog->getCountAllElements()})",
                'children' => (boolean)$catalog->children()->count(),
            );
            if ($catalog->id == $currentId) {
                $node[ 'state' ] = array(
                    'opened'   => true,
                    'selected' => true,
                );
            } else {
                if ($catalog->descendants()->findByAttributes( array( 'id' => $currentId ) )) {
                    $node[ 'state' ] = array(
                        'opened' => true,
                    );
                }
            }
            $result[ ] = $node;
        } else {
            foreach (CatalogCategory::model()->roots()->findAll() as $root) {
                $node = array(
                    'id'       => $idPrefix . $root->id,
                    'text'     => $root->title . " ({$root->getCountAllElements()})",
                    'children' => (boolean)$root->children()->count(),
                );
                if ($root->descendants()->findByAttributes( array( 'id' => $currentId ) )) {
                    $node[ 'state' ] = array(
                        'opened' => true,
                    );
                }
                $result[ ] = $node;
            }
        }

        echo CJSON::encode( $result );
    }

    public function actionNodes()
    {
        $idPrefix = 'CatalogCategoryTreeNode_';
        $result = array();
        $currentId = Yii::app()->request->getQuery( 'current_id', 0 );
        $currentCategory = CatalogCategory::model()->findByPk(
            Yii::app()->request->getQuery( 'category_id', 0 )
        );

        if ($currentCategory) {
            foreach ($currentCategory->children()->findAll() as $child) {
                $node = array(
                    'id'       => $idPrefix . $child->id,
                    'text'     => $child->title . " ({$child->getCountAllElements()})",
                    'children' => (boolean)$child->children()->count(),
                );
                if ($child->id == $currentId) {
                    $node[ 'state' ] = array(
                        'opened'   => true,
                        'selected' => true,
                    );
                } elseif ($child->descendants()->findByAttributes( array( 'id' => $currentId ) )) {
                    $node[ 'state' ] = array(
                        'opened' => true,
                    );
                }
                $result[ ] = $node;
            }
        }

        echo CJSON::encode( $result );
    }
}