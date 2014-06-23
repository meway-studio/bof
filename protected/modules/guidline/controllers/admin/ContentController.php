<?php

class ContentController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column1';
	
	public $defaultAction = 'admin';

	public function init(){
		
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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index', 'admin','delete','create','update'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->layout='//layouts/column2';
		$model=new GuidlineContent;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['GuidlineContent']))
		{
			$model->attributes=$_POST['GuidlineContent'];
			$model->validate();
			
			if(!$model->hasErrors() AND $model->save()){
				Yii::app()->user->setFlash('GuidlineContentUpdateSuccess', Yii::t('GuidlineContent', 'Золотое правило создано'));
				$this->redirect(array('update','id'=>$model->id));
			}
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
		$this->layout='//layouts/column2';
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['GuidlineContent']))
		{
			$model->attributes=$_POST['GuidlineContent'];
			$model->validate();
			
			if(!$model->hasErrors() AND $model->save()){
				Yii::app()->user->setFlash('GuidlineContentUpdateSuccess', Yii::t('GuidlineContent', 'Золотое правило обновлено'));
				$this->refresh();
			}else{
				Yii::app()->user->setFlash('GuidlineContentUpdateFailure', Yii::t('GuidlineContent', 'Ошибка. Золотое правило не обновлено'));
			}
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
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,Yii::t('GuidlineContent', 'Неверный запрос. Пожалуйста, не повторяйте этот запрос снова.'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{	

		$index = GuidlineContent::model()->findByAttributes(array('is_index'=>1));

		if($index==null){
			$index = new GuidlineContent();
			$index->is_index = 1;
			$index->status   = 1;
			$index->sort     = 0;
		}

		if(isset($_POST['GuidlineContent']))
		{
			$index->attributes=$_POST['GuidlineContent'];
			$index->validate();
			
			if(!$index->hasErrors() AND $index->save()){
				Yii::app()->user->setFlash('GuidlineContentUpdateSuccess', Yii::t('GuidlineContent', 'Главная страница обновлена'));
			}else{
				Yii::app()->user->setFlash('GuidlineContentUpdateFailure', Yii::t('GuidlineContent', 'Ошибка. Главная страница не обновлена'));
			}
		}

		$model=new GuidlineContent('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['GuidlineContent']))
			$model->attributes=$_GET['GuidlineContent'];

		$this->render('admin',array(
			'model' => $model,
			'index' => $index,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=GuidlineContent::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,Yii::t('GuidlineContent', 'Запрошенная страница не существует.'));
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='guidline-content-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
