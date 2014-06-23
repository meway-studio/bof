<?php
/**
 * Chart class file.
 *
 * @author egoss <dev@egoss.ru>
 */
 
class Chart extends CWidget {
	
	public $id;
	public $datasets;
	public $labels;
	
	public $width;
	public $height;
	
	protected $fillColor        = "rgba(220,220,220,0.5)";
	protected $strokeColor      = "rgba(220,220,220,1)";
	protected $pointColor       = "rgba(220,220,220,1)";
	protected $pointStrokeColor = "#fff";
	
	protected $options;
	
	public function init(){
		
		if(empty($this->id) OR !is_string($this->id))
			throw new CException(Yii::t('chart', 'id параметра не указан'));
		
		if(empty($this->width) OR !is_numeric($this->width))
			throw new CException(Yii::t('chart', 'Ширина параметра не указана'));
			
		if(empty($this->height) OR !is_numeric($this->height))
			throw new CException(Yii::t('chart', 'Высота параметра не указана'));
		
		if(!is_array($this->labels))
			throw new CException(Yii::t('chart', 'Параметр labels не является масивом'));
			
		if(!is_array($this->datasets))
			throw new CException(Yii::t('chart', 'Параметр datasets не является масивом'));
			
		foreach($this->datasets AS $k=>$data){
			
			if(!is_array($data))
				throw new CException(Yii::t('chart', 'Параметр datasets не является масивом'));
			
			if(!isset($this->datasets[$k]['fillColor']))
				$this->datasets[$k]['fillColor'] = $this->fillColor;
				
			if(!isset($this->datasets[$k]['strokeColor']))
				$this->datasets[$k]['strokeColor'] = $this->strokeColor;
				
			if(!isset($this->datasets[$k]['pointColor']))
				$this->datasets[$k]['pointColor'] = $this->pointColor;
				
			if(!isset($this->datasets[$k]['pointStrokeColor ']))
				$this->datasets[$k]['pointStrokeColor '] = $this->pointStrokeColor ;
		}
		
		// составить options
		$options = array(
			'labels'   => $this->labels,
			'datasets' => $this->datasets,
		);
		
		$this->options = CJavaScript::encode($options);
		
		parent::init();
	}
	
	public function run(){
		parent::run();

		echo CHtml::tag('canvas', array('width'=>$this->width, 'height'=>$this->height, 'id'=>$this->id));
		
		// добавить скрипты
		$this->registerAssets();
	}
	
	/**
	 * Register JS files.
	 */
	protected function registerAssets(){

		$cs = Yii::app()->clientScript;

		$assets_path = dirname(__FILE__) . DIRECTORY_SEPARATOR.'assets';
		$url         = Yii::app()->assetManager->publish($assets_path, false, -1, YII_DEBUG);
		
		// register files
		$cs->registerScriptFile($url.'/Chart.min.js');

		$cs->registerScript('chart-'.$this->id, '
			new Chart(document.getElementById("'.$this->id.'").getContext("2d")).Line('.$this->options.');
		');
		
	}
}