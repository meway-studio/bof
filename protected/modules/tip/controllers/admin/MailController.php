<?php

class MailController extends Controller
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
				'viewPath' => 'webroot.themes.'.Yii::app()->theme->name.'.views.tip.mail',
			),
		));
		
		//Yii::app()->theme = null;
		parent::init();
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
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
				'actions'=>array('admin','delete','create','update', 'test'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionTest(){
	
		$model = User::model()->active();//->spamer();
		
		//$model = $model->free();
		
		$model = $model->paid();
		
		$model = $model->findAll();
		
		foreach($model AS $item){
			echo $item->email." - ".$item->fullName."\n";
		}
		
		Yii::app()->end();
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new MailTask;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MailTask']))
		{
			$model->attributes=$_POST['MailTask'];
			$model->validate();
			
            if(!$model->hasErrors() AND $model->save())
				$this->redirect(array('update','id'=>$model->id));
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
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['MailTask']))
		{
			$model->attributes=$_POST['MailTask'];
			$model->validate();
			
            if(!$model->hasErrors() AND $model->save())
				$this->redirect(array('update','id'=>$model->id));
		}

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
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->layout = '//layouts/column1';
		$model=new MailTask('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['MailTask']))
			$model->attributes=$_GET['MailTask'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return MailTask the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=MailTask::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,Yii::t('tips', 'Запрашиваемая страница не существует.'));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param MailTask $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='mail-task-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
