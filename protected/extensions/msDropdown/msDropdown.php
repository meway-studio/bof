<?php
/**
 * msDropdown class file.
 *
 * @author egoss <dev@egoss.ru>
 */
 
class msDropdown extends CWidget {
	
	public $model;
	public $attribute;
	public $language;
	public $htmlOptions;
	
	protected $url;
	
	public function init(){
	
		parent::init();
		
		// проверить модель
		if( !($this->model instanceof CModel) )
			 throw new CException(Yii::t('msdropdown', 'Модель не является экземпляром класса CModel'));
		
		// проверить язык
		if(empty($this->language))
			$this->language = Yii::app()->language;
			
		// проверить htmlOptions
		if(!is_array($this->htmlOptions))
			$this->htmlOptions = array();
		
	}
	
	public function run(){
		parent::run();
		
		// set assets
		$this->registerAssets();

		echo $this->getDropDownList();
	}
	
	protected function getDropDownList(){
	
		// get countries
		$countries = require(dirname(__FILE__) . DIRECTORY_SEPARATOR. 'countries.php');
		$options   = CHtml::renderAttributes($this->htmlOptions);
		$html      = '<select id="'.CHtml::activeId($this->model, $this->attribute).'" name='.CHtml::activeName($this->model, $this->attribute).' '.$options.'>';
		
		foreach($countries AS $id => $item)
			$html.='<option '.( $this->model->{$this->attribute}==$id ? 'selected="selected"' : '' ).' value="'.$id.'" data-image="'.$this->url.'/images/icons/blank.gif" data-imagecss="'.$item['data-imagecss'].'" data-title="'.$item['label'].'">'.$item['label'].'</option>';
		
		$html.="</select>";
		
		return $html;
	}
	
	/**
	 * Register CSS and JS files.
	 */
	protected function registerAssets(){

		$cs = Yii::app()->clientScript;
		$cs->registerCoreScript('jquery');

		$assets_path = dirname(__FILE__) . DIRECTORY_SEPARATOR.'assets';
		$url         = Yii::app()->assetManager->publish($assets_path, false, -1, YII_DEBUG);
		$this->url   = $url;
		$webroot     = Yii::getPathOfAlias('webroot').DIRECTORY_SEPARATOR;
		$plugins     = array();
		
		// register files
		$cs->registerScriptFile($url.'/js/jquery.dd.min.js');
		$cs->registerCssFile($url.'/css/dd.css');
		$cs->registerCssFile($url.'/css/flags.css');

		$cs->registerScript('msDropdown'.$this->attribute, '
			$("#'.CHtml::activeId($this->model, $this->attribute).'").msDropdown();
		');
	}
}