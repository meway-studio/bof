<?php

/**
 * This is the model class for table "{{guidline_messages}}".
 *
 * The followings are the available columns in table '{{guidline_messages}}':
 * @property integer $id
 * @property integer $status
 * @property integer $create_date
 * @property integer $update_date
 * @property integer $create_ip
 * @property integer $user_id
 * @property string $question
 * @property string $details
 * @property string $name
 * @property string $email
 */
class GuidlineMessages extends CActiveRecord
{
	const STATUS_NEW    = 0;
	const STATUS_READED = 1;

	public $verifyCode;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return GuidlineMessages the static model class
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
		return '{{guidline_messages}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(

			/*
			array('status, create_date, create_ip, user_id, question, details, name, email', 'required'),
			array('status, create_date, create_ip, user_id', 'numerical', 'integerOnly'=>true),
			array('question', 'length', 'max'=>250),
			array('name, email', 'length', 'max'=>50),
			*/

			array('status', 'numerical', 'integerOnly'=>true),

			// form scenario
			array('question, details, name, email', 'required', 'on'=>'form'),
			array('email', 'email' ,'on'=>'form'),
			array('create_date, update_date, create_ip, user_id', 'numerical', 'integerOnly'=>true, 'on'=>'form'),
			array('question', 'length', 'max'=>250, 'on'=>'form'),
			array('name, email', 'length', 'max'=>50, 'on'=>'form'),
			array('verifyCode', 'length', 'max'=>6, 'on'=>'form'),
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'on'=>'form'),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, status, create_date, create_ip, user_id, question, details, name, email', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave(){

		if(parent::beforeSave()){
			
			if($this->isNewRecord){

				$this->create_ip   = ip2long(Yii::app()->request->userHostAddress);

				if(!Yii::app()->user->isGuest)
					$this->user_id = Yii::app()->user->id;
			}

			return true;
		
		}else{
			return false;
		}
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

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'          => Yii::t('GuidlineMessages', 'ID'),
			'status'      => Yii::t('GuidlineMessages', 'Статус'),
			'create_date' => Yii::t('GuidlineMessages', 'Дата создания'),
			'create_ip'   => Yii::t('GuidlineMessages', 'IP пользователя'),
			'user_id'     => Yii::t('GuidlineMessages', 'Пользователь'),
			'question'    => Yii::t('GuidlineMessages', 'Вопрос'),
			'details'     => Yii::t('GuidlineMessages', 'Подробности'),
			'name'        => Yii::t('GuidlineMessages', 'Имя'),
			'email'       => Yii::t('GuidlineMessages', 'Email'),
			'verifyCode'  => Yii::t('GuidlineMessages', 'Проверочный код'),
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

		$criteria->compare('id',$this->id);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('create_ip',$this->create_ip);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('question',$this->question,true);
		$criteria->compare('details',$this->details,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
	            'defaultOrder'=>'create_date DESC',
	        ),
		));
	}

	public function getFormatCreateDate(){
		return ($this->create_date>0) ? Yii::app()->dateFormatter->format("dd.MM.y, HH:mm", $this->create_date) : Yii::t('GuidlineMessages', 'Неизвестно');
	}

	public function getFormatUpdateDate(){
		return ($this->update_date>0) ? Yii::app()->dateFormatter->format("dd.MM.y, HH:mm", $this->update_date) : Yii::t('GuidlineMessages', 'Неизвестно');
	}

	public function getIp(){
		return long2ip($this->create_ip);
	}

	public function getStatusName(){

		$list = $this->StatusList;

		if($this->status==self::STATUS_READED)
			return $list[$this->status].' ('.$this->getFormatUpdateDate().')';

		return isset($list[$this->status]) ? $list[$this->status] : Yii::t('GuidlineMessages', 'Неизвестно');
	}

	public function getStatusList(){
		return array(
			self::STATUS_NEW    => Yii::t('GuidlineMessages', 'Новый'),
			self::STATUS_READED => Yii::t('GuidlineMessages', 'Прочитаный'),
		);
	}

	public function getByUser(){
		//return $this->user_id==0 ? Yii::t('GuidlineMessages','Guest') : ($this->user==null ? Yii::t('GuidlineMessages','Not Found') : $this->user->FullName);
		return $this->user_id==0 ? $this->name : ($this->user==null ? Yii::t('GuidlineMessages','Not Found') : CHtml::link($this->user->FullName, array('/user/admin/default/view', 'id'=>$this->user_id)));
	}

	public function getShortQuestion(){
		return mb_strlen($this->question,'utf-8') > 28 ? (mb_substr($this->question, 0, 25, 'utf-8') . '...') : $this->question;
	}
}