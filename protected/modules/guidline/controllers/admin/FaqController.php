<?php

class FaqController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'DeleteItem','view','create','update'),
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
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new FaqCategory;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['FaqCategory']))
		{
			$model->attributes=$_POST['FaqCategory'];
			$model->validate();

			if(!$model->hasErrors() AND $model->save()){
				Yii::app()->user->setFlash('GuidlineContentUpdateSuccess', Yii::t('GuidlineContent', 'Категория создана'));
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
		$model   = $this->loadModel($id);
		$FaqItem = new FaqItem();
		
		if(isset($_POST['FaqItem'])){
		
			foreach($_POST['FaqItem'] AS $id => $item){
				
				$fmodel = null;
				
				if($id==0){
					$fmodel = $FaqItem;
				}else{
					$fmodel = FaqItem::model()->findByPk($id);
				}
				
				if($fmodel == null)
					continue;
				
				$fmodel->attributes  = $item;
				$fmodel->category_id = $model->id;
				$fmodel->validate();
				
				if(!$fmodel->hasErrors()){
					$fmodel->save();
					$fmodel->unsetAttributes();
				}
				
			}
		}
		
		if(isset($_POST['FaqCategory']))
		{
			$model->attributes=$_POST['FaqCategory'];
			$model->validate();
			
			if(!$model->hasErrors() AND $model->save()){
				Yii::app()->user->setFlash('GuidlineContentUpdateSuccess', Yii::t('GuidlineContent', 'Категория обновлена'));
				$this->refresh();
			}else{
				Yii::app()->user->setFlash('GuidlineContentUpdateFailure', Yii::t('GuidlineContent', 'Ошибка. Категория не обновлена'));
			}
		}

		$this->render('update',array(
			'model'   => $model,
			'FaqItem' => $FaqItem,
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
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeleteItem($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			FaqItem::model()->deleteByPk($id);

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,Yii::t('GuidlineContent', 'Неверный запрос. Пожалуйста, не повторяйте этот запрос снова.'));
	}
	
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('FaqCategory');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new FaqCategory('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FaqCategory']))
			$model->attributes=$_GET['FaqCategory'];

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
		$model=FaqCategory::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='faq-category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
