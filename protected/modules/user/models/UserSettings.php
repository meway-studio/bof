<?php

/**
 * This is the model class for table "{{users_settings}}".
 *
 * The followings are the available columns in table '{{users_settings}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $private_profile
 * @property integer $private_subscribe
 * @property integer $private_publisher
 * @property integer $email_notification
 */
class UserSettings extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserSettings the static model class
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
		return '{{users_settings}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, private_profile, private_subscribe, private_publisher, email_notification', 'required'),
			array('user_id, private_profile, private_subscribe, private_publisher, email_notification', 'numerical', 'integerOnly'=>true),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'                 =>  Yii::t('usersettings', 'ID'),
			'user_id'            =>  Yii::t('usersettings', 'Пользователь'),
			'private_profile'    =>  Yii::t('usersettings', 'Кто видит мою информацию?'),
			'private_subscribe'  =>  Yii::t('usersettings', 'Кто видит мои подписки?'),
			'private_publisher'  =>  Yii::t('usersettings', 'Кто видит мои издательства?'),
			'email_notification' =>  Yii::t('usersettings', 'Получать новости проекта?'),
		);
	}
	
	protected function valueList(){
		return array(
			0 => Yii::t('usersettings', 'Только я'),
			1 => Yii::t('usersettings', 'Пользователи'),
			2 => Yii::t('usersettings', 'Весь интернет'),
		);
	}
	
	public function getProfileList(){
		return $this->valueList();
	}

	public function getProfileName(){
		$list = $this->ProfileList;
		return isset($list[$this->private_profile]) ? $list[$this->private_profile] : Yii::t('usersettings', 'Неизвестно');
	}
	
	
	public function getSubscribeList(){
		return $this->valueList();
	}

	public function getSubscribeName(){
		$list = $this->subscribeList;
		return isset($list[$this->private_subscribe]) ? $list[$this->private_subscribe] : Yii::t('usersettings', 'Неизвестно');
	}
	
	
	public function getPublisherList(){
		return $this->valueList();
	}

	public function getPublisherName(){
		$list = $this->PublisherList;
		return isset($list[$this->private_publisher]) ? $list[$this->private_publisher] : Yii::t('usersettings', 'Неизвестно');
	}
	
	
	public function getEmailList(){
		return array(
			1 => Yii::t('usersettings', 'Да'),
			0 => Yii::t('usersettings', 'Нет'),
		);
	}

	public function getEmailName(){
		$list = $this->getEmailList;
		return isset($list[$this->email_notification]) ? $list[$this->email_notification] : Yii::t('usersettings', 'Неизвестно');
	}
	
}