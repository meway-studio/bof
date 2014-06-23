<?php

class reviewsWidget extends CWidget
{

	public $limit   = 12;
	public $visible = 3;

	protected $model;

	public function init(){
		$this->model = Reviews::model()->published()->with('user')->findAll(array('limit'=>$this->limit));
	}
	
	public function run(){
		if(sizeof($this->model)){
			$this->registerAssets();
			$this->render('reviews' , array('model'=>$this->model) );
		}
	}

	/**
	 * Register CSS and JS files.
	 */
	protected function registerAssets() {

		$cs = Yii::app()->clientScript;
		$cs->registerCoreScript('jquery');

		$assets_path = dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
		$url         = Yii::app()->assetManager->publish($assets_path, false, -1, YII_DEBUG);

		$cs->registerScriptFile($url.'/jcarousellite_1.0.1.min.js');

		$cs->registerScript('jcarousellite', '
			$("#reviewscarousel").jCarouselLite({
		        btnNext: ".next",
		        btnPrev: ".prev",
				visible: '.$this->visible.',
		    });
		', CClientScript::POS_READY);
	}

}