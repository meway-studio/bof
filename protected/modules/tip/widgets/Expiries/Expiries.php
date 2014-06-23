<?php
/**
 * Expiries class file.
 *
 * @author egoss <dev@egoss.ru>
 */
 
class Expiries extends CWidget
{

	public $user_id;
	
	protected $model;
	
	public function init(){
		
		if(empty($this->user_id))
			$this->user_id = !Yii::app()->user->isGuest ? Yii::app()->user->id : null;
		
		$this->model = User::model()->active()->findByPk($this->user_id);
	}
	
	public function run(){
		if($this->model)
			$this->render( 'view' , array('model'=>$this->model));
	}

}