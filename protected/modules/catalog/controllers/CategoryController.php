<?php

class CategoryController extends Controller
{
    public $defaultAction = 'view';

    /**
     * @throws HttpException
     * @internal param $id
     */
    public function actionView()
    {
        /**
         * @var $category CatalogCategory
         * @var $elements CatalogElement
         */
        $search = false;

        if (!($category = CatalogCategory::model()->findByPk( Yii::app()->request->getQuery( 'id' ) ))
            && !($category = CatalogCategory::model()->findByAttributes(
                array(
                    'name' => Yii::app()->request->getParam( 'name' ),
                )
            ))
        ) {
            throw new HttpException('Каталог не найден', 404);
        }

        $elements = $category->getAllElements();

        if (!empty($_GET[ 'CatalogElement' ])) {
            $elements->attributes = $_GET[ 'CatalogElement' ];
            $search = true;
        }

        if (!empty($_POST[ 'CatalogElement' ])) {
            $elements->attributes = $_POST[ 'CatalogElement' ];
            $search = true;
        }

        $dataProvider = $elements->search();
        $dataProvider->pagination->pageSize = 20;
        $dataProvider->pagination->route = $category->getUrl();

        $viewPath = ($viewPath = $category->getTplViewPath()) ? $viewPath : 'view';
        if ($viewDir = CatalogComponent::catalogViewDir( $category->catalog->name )) {
            $newViewPath = rtrim( $viewDir, '/' ) . '/' . ltrim( $viewPath, '/' );
            $viewPath = $this->getViewFile( $newViewPath ) ? $newViewPath : $viewPath;
        }

        $this->render(
            $viewPath,
            array(
                'category'     => $category,
                'elements'     => $elements,
                'dataProvider' => $dataProvider,
                'search'       => $search,
            )
        );
    }
}