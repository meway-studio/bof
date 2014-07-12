<?php

/**
 * Class CategoryController
 * @property CatalogCategory|null $currentCategory
 */
class CategoryController extends BackController
{
    public $layout = '//layouts/column3';
    public $defaultAction = 'index';
    public $isRoot = false;
    public $category_id = 0;
    public $currentCategory = null;

    public function init()
    {
        $currentCategory = new CatalogCategory('search');
        $currentCategory->unsetAttributes();
        $currentCategory->attributes = $_GET;

        if (!empty($_POST) && is_array( $_POST ) && count( $_POST )) {
            $currentCategory->attributes = $_POST;
        }

        $dataProvider = null;
        foreach ($currentCategory->attributes as $attribute) {
            if ($attribute !== null) {
                $dataProvider = $currentCategory->search();
                break;
            }
        }

        if ($dataProvider && (list($currentCategory) = $dataProvider->getData())) {
            $this->currentCategory = $currentCategory;
            $this->category_id = $currentCategory->id;
        }


        if (!$this->category_id) {
            $this->isRoot = true;
        }

        parent::init();
    }

    public function actionIndex()
    {
        $this->layout = '//layouts/column3';

        $element = new CatalogElement('search', array( 'category_id' => $this->category_id ));

        $category = $this->currentCategory;

        if ($category) {
            $element = $category->getAllElements();
        } else {
            $category = CatalogCategory::model()->roots()->find();
        }

        if (!empty($_GET[ 'CatalogElement' ])) {
            $element->attributes = $_GET[ 'CatalogElement' ];
        }

        $dataProvider = $element->search();
        $dataProvider->pagination->pageSize = 10;

        $viewPath = 'elements';
        if ($viewDir = CatalogComponent::catalogViewDir( $category->catalog->name, true )) {
            $newViewPath = rtrim( $viewDir, '/' ) . '/' . ltrim( $viewPath, '/' );
            $viewPath = $this->getViewFile( $newViewPath ) ? $newViewPath : $viewPath;
        }

        $this->render(
            $viewPath,
            array(
                'model'        => $element,
                'category'     => $category,
                'dataProvider' => $dataProvider,
            )
        );
    }

    public function actionCreate()
    {
        $this->actionUpdate( true );
    }

    public function actionUpdate( $new = false )
    {
        if ($new === true) {
            if ($this->currentCategory) {
                $model = new CatalogCategory('insert', array(
                    'root_id' => $this->currentCategory->root_id
                ));
            } else {
                $model = new CatalogCategory();
            }
        } else {
            $model = $this->currentCategory;
        }

        if (!$model) {
            throw new CHttpException(404, 'Категория не найдена.');
        }

        if (Yii::app()->request->isPostRequest) {
            $model->attributes = $_POST[ 'CatalogCategory' ];

            if ($model->validate()) {
                if ($model->isNewRecord) {
                    if ($this->currentCategory) {
                        $model->appendTo( $this->currentCategory );
                    } else {
                        $model->saveNode();
                    }
                } else {
                    $model->saveNode();
                }

                $this->redirect(
                    Yii::app()->createUrl(
                        'catalog/admin/category/index',
                        array( 'id' => $model->id )
                    )
                );
            }
        }

        $viewPath = 'update';
        if ($viewDir = CatalogComponent::catalogViewDir( $model->catalog->name, true )) {
            $newViewPath = rtrim( $viewDir, '/' ) . '/' . ltrim( $viewPath, '/' );
            $viewPath = $this->getViewFile( $newViewPath ) ? $newViewPath : $viewPath;
        }

        $this->render(
            $viewPath,
            array(
                'model' => $model,
            )
        );
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

        /**
         * @var $category CatalogCategory|NestedSetBehavior|NestedSet
         */
        if ($category = CatalogCategory::model()->findByPk( $id )) {
            if ($root = $category->parent()->find()) {
                $categoryId = $root->id;
            }
            $category->deleteNode();
        }

        if (!Yii::app()->request->isAjaxRequest) {
            $this->redirect( Yii::app()->createUrl( 'catalog/admin/category/index', array( 'id' => $categoryId ) ) );
        }
    }
}