<?php

class Robokassa extends CApplicationComponent
{
	public $sMerchantLogin;
	public $sMerchantPass1;
	public $sMerchantPass2;
	public $sCulture  = 'en';
	public $sEncoding = 'UTF-8';

	public $resultMethod  = 'post';
	public $sIncCurrLabel = 'Qiwi29OceanR';
	public $orderModel;
	public $priceField;
	public $isTest = false;

	public $params;

	protected $_order;

	public function pay($nOutSum, $nInvId, $sInvDesc, $sUserEmail, $sIncCurrLabel)
	{
		$this->sIncCurrLabel = $sIncCurrLabel;
		
		$sign = $this->getPaySign($nOutSum, $nInvId, $sUserEmail);
		
		if($this->getUserCountryCode()=='RU')
			$this->sCulture = 'ru';

		$url  = $this->isTest
			? 'http://test.robokassa.ru/Index.aspx?'
			: 'https://merchant.roboxchange.com/Index.aspx?';

		$url .= "MrchLogin={$this->sMerchantLogin}&";
		$url .= "OutSum={$nOutSum}&";
		$url .= "InvId={$nInvId}&";
		$url .= "Desc={$sInvDesc}&";
		$url .= "SignatureValue={$sign}&";
		$url .= "IncCurrLabel={$this->sIncCurrLabel}&";
		$url .= "Email={$sUserEmail}&";
		$url .= "Culture={$this->sCulture}&";
		$url .= "Encoding={$this->sEncoding}";

		Yii::app()->controller->redirect($url);
	}
	
	private function getUserCountryCode(){
		$data = geoip_record_by_name($_SERVER['REMOTE_ADDR']);
		
		return isset($data['country_code']) ? $data['country_code'] : false;
	}

	private function getPaySign($nOutSum, $nInvId)
	{
		$keys = array(
			$this->sMerchantLogin,
			$nOutSum,
			$nInvId,
			$this->sMerchantPass1,
		);
		return md5(implode(':', $keys));
	}

	public function result()
	{
		$var   = $_GET + $_POST;
		extract($var);
		$event = new CEvent($this);
		$valid = true;

		if(!$valid OR !isset($OutSum, $InvId, $SignatureValue))
		{
			//$this->params = array('reason'=>'Dont set need value');
			$this->params = array('reason'=>Yii::t('robokassa', 'Данные не переданы'));
			$valid = false;
		
		}elseif(!$valid OR !$this->checkResultSignature($OutSum, $InvId, $SignatureValue))
		{
			$this->params = array('reason'=>Yii::t('robokassa', 'Неверная контрольная сумма'));
			$valid = false;
		
		}elseif(!$valid OR !$this->isOrderExists($InvId))
		{
			//$this->params = array('reason'=>'Order #'.$InvId.' not exists');
			$this->params = array('reason'=>Yii::t('robokassa', 'Заказ #{id} не существует', array('{id}'=>$InvId)));
			$valid = false;
		
		}elseif(!$valid || $this->_order->{$this->priceField} != $OutSum)
		{
			$this->params = array('reason'=>Yii::t('robokassa', 'Неправильная стоимость заказа'));
			$valid = false;
		}
		
		if($valid){
			if($this->hasEventHandler('onSuccess')){
				$this->params = array('order'=>$this->_order);
				$this->onSuccess($event);
			}
		}else{
			if($this->hasEventHandler('onFail')){
				return $this->onFail($event);
			}
		}

		echo "OK{$InvId}\n";
	}

	private function isOrderExists($id)
	{
		$this->_order = CActiveRecord::model($this->orderModel)->findByPk((int)$id);

		if($this->_order!=null)
			return true;

		return false;
	}

	private function checkResultSignature($OutSum,$InvId,$SignatureValue)
	{
		$keys = array(
			$OutSum,
			$InvId,
			$this->sMerchantPass2,
		);

		$sign = md5(implode(':', $keys));
		
		if(strtoupper($SignatureValue) == strtoupper($sign))
			return true;

		return false;
	}

	public function onSuccess($event)
	{
		$this->raiseEvent('onSuccess', $event);
	}

	public function onFail($event)
	{
		$this->raiseEvent('onFail', $event);
	}
}

