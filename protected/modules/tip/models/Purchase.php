<?php

/**
 * This is the model class for table "{{purchase}}".
 *
 * The followings are the available columns in table '{{purchase}}':
 * @property integer $id
 * @property integer $status
 * @property integer $type
 * @property integer $create_date
 * @property integer $update_date
 * @property integer $user_id
 * @property integer $days
 * @property integer $payment_id
 * @property string $price
 */
class Purchase extends CActiveRecord
{
	
	const STATUS_NEW    = 0;
	const STATUS_HOVER  = 1;
	const STATUS_PAID   = 2;
	const STATUS_REJECT = 3;
	
	const PAYMENT_QIWI      = 1;
	const PAYMENT_MB        = 2;
	const PAYMENT_PAYPALL   = 3;
	const PAYMENT_WEBCREDS  = 4;
	const PAYMENT_CARD      = 5;
	const PAYMENT_ROBOKASSA = 6;
	const PAYMENT_ZPAY      = 7;
	const PAYMENT_RBK       = 8;
	const PAYMENT_MAILRU    = 9;
	const PAYMENT_LIQPAY    = 10;
	const PAYMENT_EDK       = 11;
	const PAYMENT_EASYPAY   = 12;
	const PAYMENT_YANDEX    = 13;
	const PAYMENT_WEBMONEY  = 14;

	const TYPE_ONCE  = 0;
	const TYPE_DATE  = 1;
	
	public $format_create_date;
	public $format_update_date;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Purchase the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{purchase}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status, user_id, payment_id, price, type', 'required'),
			array('status, type, create_date, update_date, user_id, days, payment_id', 'numerical', 'integerOnly'=>true),
			array('price', 'length', 'max'=>10),
			array('payment_id', 'in', 'range'=>array(1,2,3,4,5,6,7,8,9,10,11,12,13,14)),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, status, type, create_date, update_date, user_id, days, payment_id, price', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'tips' => array(self::HAS_MANY, 'PurchaseTips', 'purchase_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}
	
	public function behaviors(){
		
		return array(
			'CTimestampBehavior' => array(
			'class'              => 'zii.behaviors.CTimestampBehavior',
			// disabled on console
			'createAttribute'    => 'create_date',
			'updateAttribute'    => 'update_date',
			)
		);

	}
	
	protected function afterFind(){

	  $this->format_create_date = Yii::app()->dateFormatter->format('dd/MM/yyyy HH:mm', $this->create_date);
	  $this->format_update_date = Yii::app()->dateFormatter->format('dd/MM/yyyy HH:mm', $this->update_date);

	  parent::afterFind(); //To raise the event
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'          => Yii::t('Purchase','ID'),
			'status'      => Yii::t('Purchase','Статус'),
			'type'        => Yii::t('Purchase','Тип'),
			'create_date' => Yii::t('Purchase','Дата создания'),
			'update_date' => Yii::t('Purchase','Дата обновления'),
			'user_id'     => Yii::t('Purchase','Пользователь'),
			'days'        => Yii::t('Purchase','День'),
			'payment_id'  => Yii::t('Purchase','Оплата'),
			'price'       => Yii::t('Purchase','Стоимость'),
			'description'  => Yii::t('Purchase','Описание'),
			'user'       => Yii::t('Purchase','Пользователь'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		
		$criteria->with = array('user');

		$criteria->compare('t.id',$this->id);
		$criteria->compare('t.status',$this->status);
		$criteria->compare('t.type',$this->type);
		$criteria->compare('t.create_date',$this->create_date);
		$criteria->compare('t.update_date',$this->update_date);
		
		$criteria->compare('user.firstname',$this->user_id, true, 'OR');
		$criteria->compare('user.email',$this->user_id, true, 'OR');
		
		$criteria->compare('t.days',$this->days);
		$criteria->compare('t.payment_id',$this->payment_id);
		$criteria->compare('t.price',$this->price,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
	            'defaultOrder'=>'t.create_date DESC',
	        ),
		));
	}

	public function history(){

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('status',$this->status);
		$criteria->compare('type',$this->type);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('update_date',$this->update_date);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('days',$this->days);
		$criteria->compare('payment_id',$this->payment_id);
		$criteria->compare('price',$this->price,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 10,
			),
			'sort'=>array(
	            'defaultOrder'=>'create_date DESC',
	        ),
		));
	}
	
	public function getStatusList(){
		return array(
			self::STATUS_NEW    => Yii::t('Purchase','Новый'),
			self::STATUS_HOVER  => Yii::t('Purchase','Выделен'),
			self::STATUS_PAID   => Yii::t('Purchase','Платный'),
			self::STATUS_REJECT => Yii::t('Purchase','Отклонен'),
	
		);
	}
	
	public function getStatusName(){
		
		foreach($this->getStatusList() AS $id => $name){
			if($this->status==$id)
				return $name;
		}
		
		return Yii::t('Purchase', 'Неизвестно');
	}
	
	public function getTypeList(){
		return array(
			self::TYPE_ONCE  => Yii::t('Purchase','Один раз'),
			self::TYPE_DATE  => Yii::t('Purchase','Дней'),
	
		);
	}
	
	public function getTypeName(){
		
		foreach($this->getTypeList() AS $id => $name){
			if($this->type==$id)
				return $name;
		}
		
		return Yii::t('Purchase', 'Неизвестно');
	}
	
	public function getFormatCreateDate(){
		return Yii::app()->dateFormatter->format('d MMM hh:mm', $this->create_date);
	}
	
	public function getFormatUpdateDate(){
		return Yii::app()->dateFormatter->format('d MMM hh:mm', $this->update_date);
	}

	public function getDescription(){
		
		$result = Yii::t('Purchase', 'Не найдено');

		if($this->type == self::TYPE_ONCE){

			$result = '';

			foreach($this->tips AS $item)
				$result .= Yii::t('Purchase', 'После того как {tfn}, ', array('{tfn}'=>'<b>'.$item->TipsterFullName.'</b>'));

			$result = trim($result, ', ').' ('.count($this->tips).' tips)';

		}elseif($this->type == self::TYPE_DATE){

			$result = Yii::t('Purchase', 'Подписка на {days} дней', array('{days}'=> '<b>'.($this->days/3600/24).'</b>'));

		}

		return $result;
	}
	
	public function getUserFullStr(){
		return $this->user==null ? 'Unknown' : $this->user->FullName." (".$this->user->email.")";
	}
	
	public function getPriceRUR(){
		return $this->price*Yii::app()->params->rur_eur;
	}
	
	public function getViewPrice(){

		if(Yii::app()->language=='ru')
			return $this->getPriceRUR();

		return $this->price;
	}
	
	public function getRobokassaMethods(){
		return array(
			self::PAYMENT_QIWI,
			self::PAYMENT_CARD,
			self::PAYMENT_EASYPAY,
			self::PAYMENT_ROBOKASSA,
			self::PAYMENT_RBK,
			self::PAYMENT_MAILRU,
			self::PAYMENT_LIQPAY ,
			self::PAYMENT_EDK ,
			self::PAYMENT_YANDEX ,
			self::PAYMENT_WEBMONEY ,
		);
	}
	
	public function getIsRobokassa(){
		return in_array($this->payment_id, $this->getRobokassaMethods());
	}
	
	public function getIsPaypall(){
		return $this->payment_id == self::PAYMENT_PAYPALL ? true : false;
	}
	
	public function getIncCurrLabel(){
		switch($this->payment_id)
		{
			CASE self::PAYMENT_QIWI      : return 'Qiwi29OceanR';
			CASE self::PAYMENT_CARD      : return 'BANKOCEAN2R';
			CASE self::PAYMENT_EASYPAY   : return 'EasyPayB';
			CASE self::PAYMENT_RBK       : return '';
			CASE self::PAYMENT_MAILRU    : return 'MailRuOceanR';
			CASE self::PAYMENT_LIQPAY    : return 'LiqPayZ';
			CASE self::PAYMENT_EDK       : return 'W1R';
			CASE self::PAYMENT_YANDEX    : return 'YandexMerchantR';
			CASE self::PAYMENT_WEBMONEY  : return 'WMEM';
			default: return '';
		}
	}
}