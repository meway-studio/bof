<?php
// User
class DefaultController extends Controller
{
	
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
	public $defaultAction = 'admin';
	
	public function init(){
		
		Yii::app()->theme = 'bootstrap';
		
		Yii::app()->setComponents(array(
			'mail'=>array(
				'viewPath' => 'webroot.themes.'.Yii::app()->theme->name.'.views.user.mail',
			),
		));
		
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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','update', 'view'),
                'roles'=>array('manager'),
            ),
            array('allow',
                'actions'=>array('admin','delete','update','view'), //,'create'
                'roles'=>array('admin'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
		$model = $this->loadModel($id);
		
		if(Yii::app()->user->roleId == User::ROLE_MANAGER AND $model->role!=User::ROLE_TIPSTER)
			throw new CHttpException(403,Yii::t('user', 'Авторизуйтесь для выполнения этого действия.'));
		
        $this->render('view',array(
            'model'=>$model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new User;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['User']))
        {
            $model->attributes=$_POST['User'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
		
		if(Yii::app()->user->roleId == User::ROLE_MANAGER AND $model->role!=User::ROLE_TIPSTER){
			throw new CHttpException(403,Yii::t('user', 'Авторизуйтесь для выполнения этого действия.'));
		}
		
		$model->scenario = 'admin_update';

        if($model->role == User::ROLE_USER AND $model->sub==NULL){
            $sub = new UsersSubscription();
            $sub->user_id = $model->id;
            $sub->expiration_date = 0;
            $sub->save();
            $model=$this->loadModel($id);
        }

        if($model->role == User::ROLE_USER){
            $model->sub->format_expiration_date = $model->sub->FormatExpirationDate;
        }
		
		if($model->role == User::ROLE_TIPSTER AND $model->tipster==null){
		
			$tipster = new Tipsters();
			$tipster->user_id = $model->id;
			$tipster->bank    = Tips::BANK;
			$tipster->save();
			
			$model = $this->loadModel($id);
		}

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $redirect = false;

        if(isset($_POST['User']))
        {
            $model->attributes=$_POST['User'];

            if($model->update_exp_date==1){
                $model->sub->attributes = $_POST['UsersSubscription'];
                $model->sub->validate();

                if(!$model->sub->hasErrors() AND $model->sub->save())
                    $redirect = true;
            }

            $model->validate();
            if(!$model->hasErrors() AND $model->save())
                $redirect = $redirect == true ? true : false;
                
        }

        if($model->tipster!=null AND isset($_POST['Tipsters'])){
            $model->tipster->attributes = $_POST['Tipsters'];
            $model->tipster->validate();

            if(!$model->tipster->hasErrors() AND $model->tipster->save())
                $redirect = $redirect == true ? true : false;
        }

        if($redirect==true)
            $this->redirect(array('view','id'=>$model->id));


        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400,Yii::t('user', 'Неверный запрос. Пожалуйста, не повторяйте этот запрос снова.'));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
		$this->layout='//layouts/column1';
        $model=new User('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['User']))
            $model->attributes=$_GET['User'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model=User::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,Yii::t('user', 'Запрашиваемая страница не существует.'));
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}