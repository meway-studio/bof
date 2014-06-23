<?php
/**
 * Chosen class file.
 *
 * @author egoss <dev@egoss.ru>
 */
 
class Chosen extends CWidget {
	
	public $model;
	public $attribute;
	public $data;
	public $htmlOptions;
	
	protected $id;
	
	public function init(){
	
		parent::init();
		
		// проверить модель
		if( !($this->model instanceof CModel) )
			 throw new CException(Yii::t('chosen', 'Модель не является экземпляром класса CModel'));
			 
		$this->id = CHtml::activeId($this->model, $this->attribute);
	}
	
	public function run(){
		parent::run();
		
		// set assets
		$this->registerAssets();
		
		echo CHtml::activeDropDownList($this->model, $this->attribute, $this->data, $this->htmlOptions);
	}
	
	/**
	 * Register CSS and JS files.
	 */
	protected function registerAssets(){

		$cs = Yii::app()->clientScript;
		$cs->registerCoreScript('jquery');

		$assets_path = dirname(__FILE__) . DIRECTORY_SEPARATOR.'assets';
		$url         = Yii::app()->assetManager->publish($assets_path, false, -1, YII_DEBUG);
		$webroot     = Yii::getPathOfAlias('webroot').DIRECTORY_SEPARATOR;
		$plugins     = array();
		
		// register redactor files
		$cs->registerScriptFile($url.'/chosen.jquery.min.js');
		$cs->registerCssFile($url.'/chosen.min.css');
		
		$cs->registerScript('chosen_'.$this->id, '
			$("#'.$this->id.'").chosen({no_results_text: "'.Yii::t('chosen', 'Ничего не найдено').'"});
		');
		
	}
}