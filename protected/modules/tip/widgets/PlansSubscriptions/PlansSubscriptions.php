<?php
/**
 * PlansSubscriptions class file.
 *
 * @author egoss <dev@egoss.ru>
 */
 
class PlansSubscriptions extends CWidget
{

	public $style;
	
	protected $data = array();
	
	protected function convertPrice($sum){
		return Yii::app()->language=='ru' ? $sum*Yii::app()->params->rur_eur : $sum;
	}
	
	public function init(){
		$this->data = array(
			'WEEKEND' => $this->convertPrice(Yii::app()->config->get('SUBSCRIPTION_WEEKEND_PRICE')),
			'MONTH'   => $this->convertPrice(Yii::app()->config->get('SUBSCRIPTION_MONTH_PRICE')),
			'3MONTH'  => $this->convertPrice(Yii::app()->config->get('SUBSCRIPTION_3MONTH_PRICE')),
			'SEASON'  => $this->convertPrice(Yii::app()->config->get('SUBSCRIPTION_SEASON_PRICE')),
		);
	}
	
	public function run(){
		$this->render( 'view' , array('style'=>$this->style, 'data'=>$this->data));
	}

}