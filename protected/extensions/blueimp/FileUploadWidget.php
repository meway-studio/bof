<?php
/**
 * FileUploadWidget class file.
 *
 * @author egoss <dev@egoss.ru>
 * Todo: продумать передачу js функций через массив опции
 */
 
class FileUploadWidget extends CWidget {
	
	public $model;
	public $attribute;
	public $action;
	public $options;
	public $htmlOptions = array();
	
	protected $file_id;
	protected $hidden_id;
	
	public function init(){
	
		parent::init();
		
		// проверить модель
		if( !($this->model instanceof CModel) )
			 throw new CException(Yii::t('fileupload', 'Модель не является экземпляром класса CModel'));
	}
	
	public function run(){
		parent::run();
		
		$this->file_id   = uniqid();
		$this->hidden_id = CHtml::activeId($this->model, $this->attribute);
		
		// cделать fileInput
		echo CHtml::fileField($this->attribute, '', array_merge(array('id'=>$this->file_id, 'data-url'=>$this->action), $this->htmlOptions));
		
		// сделать HiddenInput
		echo CHtml::activeHiddenField($this->model, $this->attribute);
		
		// добавить скрипты
		$this->registerAssets();
	}
	
	/**
	 * Register JS files.
	 */
	protected function registerAssets(){

		$cs = Yii::app()->clientScript;
		$cs->registerCoreScript('jquery');

		$assets_path = dirname(__FILE__) . DIRECTORY_SEPARATOR.'assets';
		$url         = Yii::app()->assetManager->publish($assets_path, false, -1, YII_DEBUG);
		
		// register files
		$cs->registerScriptFile($url.'/jquery.iframe-transport.js');
		$cs->registerScriptFile($url.'/jquery.ui.widget.js');
		$cs->registerScriptFile($url.'/jquery.fileupload.js');

		$cs->registerScript('fileupload'.$this->attribute, '
			$("#'.$this->file_id.'").fileupload('.$this->options.');
		');
		
	}
}