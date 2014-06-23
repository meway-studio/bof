<?php
/**
 * PreviousTips class file.
 *
 * @author egoss <dev@egoss.ru>
 */

Yii::import('application.modules.tip.models.*');

class PreviousTips extends CWidget
{	
	
	const FREE_NULL    = 0;
	const FREE_TRUE    = 1;
	const FREE_FALSE   = 2;
	
	const ACTIVE_NULL  = 0;
	const ACTIVE_TRUE  = 1;
	const ACTIVE_FALSE = 2;
	const ACTIVE_SOON  = 3;
	const ACTIVE_BOD   = 4;
	const ACTIVE_STAT  = 5;
	
	const STATUS_DRAFT     = 0;
	const STATUS_PUBLISHED = 1;
	const STATUS_ALL       = 2;

	const TIPSTER_BOF  = 'BOF';

	public $tipster    = null;
	public $active     = null;
	public $free       = null;
	public $items      = null;
	public $limit      = 3;
	public $offset     = 0;
	public $status     = 1;
	public $view       = 'active';
	public $order      = 't.event_date ASC, t.create_date DESC';
	
	protected $model;
	
	public function init(){
		
		$this->offset = (int)$this->offset;
		
		$model = Tips::model()->with('tipster');

		$model = $this->tipster ? $model->byTipster($this->tipster) : $model;
		
		SWITCH($this->status)
		{
			CASE self::STATUS_PUBLISHED: $model = $model->published(); break;
			CASE self::STATUS_DRAFT:     $model = $model->draft();     break;
		}
		
		SWITCH($this->active)
		{
			CASE self::ACTIVE_STAT:  $model = $model->onStatPage(); break;
			CASE self::ACTIVE_TRUE:  $model = $model->active(); break;
			CASE self::ACTIVE_FALSE: $model = $model->last();   break;
			CASE self::ACTIVE_SOON:  $model = $model->soon();   break;
			CASE self::ACTIVE_BOD:   $model = $model->bodtips();break;
		}
		
		if($this->free!=self::FREE_NULL)
			$model = $this->free==self::FREE_TRUE ? $model->free() : $model->paid();
			
		if($this->offset > 0)
			$model = $model->setOffset($this->offset);
			
		if($this->items!=null)
			$this->model = $this->items;
		else
			$this->model = $model->findAll(array('limit'=>$this->limit, 'order'=>$this->order));
	}
	
	public function run(){
		if($this->model)
			$this->render( $this->view , array('model'=>$this->model, 'tipster'=>$this->tipster) );
		//else
		//	echo 'No result found.';
	}

}