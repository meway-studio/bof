<?php

class ElementController extends BackController
{
    public $layout = '//layouts/column2';
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

    /**
     * Create product
     */
    public function actionIndex()
    {
        $this->actionUpdate( true );
    }

    public function actionCreate()
    {
        $this->actionUpdate( true );
    }

    /**
     * Delete products
     * @param array $id
     */
    public function actionDelete( $id = null )
    {
        $model = CatalogElement::model()->findByPk( $id );

        if (!empty($model)) {
            $model->delete();
        }

        if (!Yii::app()->request->isAjaxRequest) {
            $this->redirect( Yii::app()->request->getUrlReferrer() );
        }
    }

    /**
     * Create/update product
     * @param bool $new
     * @throws CHttpException
     */
    public function actionUpdate( $new = false )
    {
        if ($new === true) {
            $model = new CatalogElement('insert', array(
                'category_id' => Yii::app()->request->getParam( 'id' )
            ));
            if (!($model->category_id = Yii::app()->request->getParam( 'id' )) || !$model->category) {
                throw new CHttpException(404, 'Категория не найдена.');
            }
        } else {
            $model = CatalogElement::model()->findByPk( Yii::app()->request->getParam( 'id' ) );
            $this->currentCategory = $model->category;
        }

        if (!$model) {
            throw new CHttpException(404, 'Продукт не найден.');
        }

        if (Yii::app()->request->isPostRequest) {
            $model->setAttributes( $_POST[ 'CatalogElement' ] );
            if ($model->save()) {
                $this->redirect( Yii::app()->createUrl( 'catalog/admin/category/index', array( 'id' => $model->category_id ) ) );
            }
        }

        $viewPath = 'update';
        if ($viewDir = CatalogComponent::catalogViewDir( $model->catalog->name, true )) {
            $newViewPath = rtrim( $viewDir, '/' ) . '/' . ltrim($viewPath, '/');
            $viewPath = $this->getViewFile($newViewPath) ? $newViewPath : $viewPath;
        }

        $this->render(
            $viewPath,
            array(
                'model' => $model,
            )
        );
    }
}