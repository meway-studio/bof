<?php

class ReviewsController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $defaultAction = 'admin';

    public function init()
    {

        Yii::app()->theme = 'bootstrap';

        parent::init();
    }

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(

            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array( 'create', 'update', 'admin', 'delete', 'autocomplete', 'addByUser' ),
                'roles'   => array( 'admin' ),
            ),
            array(
                'deny', // deny all users
                'users' => array( '*' ),
            ),
        );
    }

    public function actionAddByUser( $id )
    {

        $user = User::model()->findByPk( $id );

        if ($user == null) {
            $user = new User();
        }

        $model = new Reviews();
        $model->content = $user->about;
        $model->user_id = $user->id;
        $model->user_name = $user->FullName . ' (' . $user->email . ')';
        $model->status = Reviews::STATUS_DRAFT;

        $this->render( 'create', array( 'model' => $model ) );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Reviews;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST[ 'Reviews' ])) {
            $model->attributes = $_POST[ 'Reviews' ];
            $model->validate();

            if (!$model->hasErrors() AND $model->save()) {
                $this->redirect( array( 'update', 'id' => $model->id ) );
            }
        }

        $this->render(
            'create',
            array(
                'model' => $model,
            )
        );
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate( $id )
    {
        $model = $this->loadModel( $id );

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST[ 'Reviews' ])) {
            $model->attributes = $_POST[ 'Reviews' ];
            $model->validate();

            if (!$model->hasErrors() AND $model->save()) {
                $this->redirect( array( 'update', 'id' => $model->id ) );
            }
        }

        $this->render(
            'update',
            array(
                'model' => $model,
            )
        );
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete( $id )
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel( $id )->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET[ 'ajax' ])) {
                $this->redirect( isset($_POST[ 'returnUrl' ]) ? $_POST[ 'returnUrl' ] : array( 'admin' ) );
            }
        } else {
            throw new CHttpException(400, Yii::t( 'user', 'Неверный запрос. Пожалуйста, не повторяйте этот запрос снова.' ));
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $this->layout = '//layouts/column1';
        $model = new Reviews('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET[ 'Reviews' ])) {
            $model->attributes = $_GET[ 'Reviews' ];
        }

        $this->render(
            'admin',
            array(
                'model' => $model,
            )
        );
    }

    public function actionAutocomplete()
    {

        $term = Yii::app()->getRequest()->getParam( 'term' );

        if (!empty($term)) {

            $criteria = new CDbCriteria;
            $criteria->addSearchCondition( 'firstname', $term );
            $customers = User::model()->findAll( $criteria );
            $result = array();
            foreach ($customers as $city) {
                $lable = $city[ 'firstname' ] . ' (' . $city[ 'email' ] . ')';
                $result[ ] = array( 'id' => $city[ 'id' ], 'label' => $lable, 'value' => $lable );
            }
        }

        echo CJSON::encode( $result );
        Yii::app()->end();
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel( $id )
    {
        $model = Reviews::model()->findByPk( $id );
        if ($model === null) {
            throw new CHttpException(404, Yii::t( 'user', 'Запрашиваемая страница не существует.' ));
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation( $model )
    {
        if (isset($_POST[ 'ajax' ]) && $_POST[ 'ajax' ] === 'reviews-form') {
            echo CActiveForm::validate( $model );
            Yii::app()->end();
        }
    }
}
