<?php
/**
 * Redactor class file.
 *
 * @author egoss <dev@egoss.ru>
 * Todo: сделать возможым работу без модели
 * Todo: добавить CAction для загрузки изображений
 */
 
class Redactor extends CWidget {
	
	public $model;
	public $attribute;
	public $language;
	public $plugins;
	public $settings;
	public $htmlOptions;
	
	public function init(){
	
		parent::init();
		
		// проверить модель
		if( !($this->model instanceof CModel) )
			 throw new CException(Yii::t('redactor', 'Модель не является экземпляром класса CModel'));
		
		// проверить язык
		if(empty($this->language))
			$this->language = Yii::app()->language;
		
		// проверить настройки
		if(!is_array($this->settings))
			$this->settings = array();
		
		// проверить плагины
		if(!is_array($this->plugins))
			$this->plugins = array();
			
		$this->settings = array_merge(array('lang'=>$this->language),$this->settings);
		
	}
	
	public function run(){
		parent::run();
		
		// set assets
		$this->registerAssets();
		
		echo CHtml::activeTextArea($this->model, $this->attribute, $this->htmlOptions);
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
		$cs->registerScriptFile($url.'/redactor.js');
		$cs->registerCssFile($url.'/redactor.css');
		//$cs->registerCssFile($url.'/redactor-iframe.css');

		// register plugins files
		foreach($this->plugins AS $plugin){
			
			$plugins_path = $url . DIRECTORY_SEPARATOR . 'plugins' . DIRECTORY_SEPARATOR . $plugin . DIRECTORY_SEPARATOR . $plugin;
			
			if(file_exists($webroot.$plugins_path.'.js')){
				$cs->registerScriptFile($plugins_path.'.js');
				$this->settings['plugins'][] = $plugin;
			}
			
			if(file_exists($webroot.$plugins_path.'.css'))
				$cs->registerCssFile($plugins_path.'.css');
		}
		
		// register lang file
		$lang_path = $url . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR;
		
		if(file_exists($webroot.$lang_path.$this->language.'.js'))
			$cs->registerScriptFile($lang_path.$this->language.'.js', CClientScript::POS_END);
		
		$settings = sizeof($this->settings) ? CJavaScript::encode($this->settings) : '';

		$cs->registerScript('redactor'.$this->attribute, '
			$("#'.CHtml::activeId($this->model, $this->attribute).'").redactor('.$settings.');
		');
		
	}
}