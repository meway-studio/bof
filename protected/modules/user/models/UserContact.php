<?php

/**
 * This is the model class for table "{{users_contacts}}".
 *
 * The followings are the available columns in table '{{users_contacts}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $contact_type
 * @property string $contact_value
 */
class UserContact extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserContact the static model class
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
		return '{{users_contacts}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, contact_type', 'required', 'on'=>'update'),
			array('user_id, contact_type', 'required', 'on'=>'create'),
			array('user_id, contact_type', 'numerical', 'integerOnly'=>true),
			array('contact_value', 'length', 'max'=>250),
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
			'id'            =>  Yii::t('usercontact', 'ID'),
			'user_id'       =>  Yii::t('usercontact', 'Пользователь'),
			'contact_type'  =>  Yii::t('usercontact', 'Тип'),
			'contact_value' =>  Yii::t('usercontact', 'Значение'),
		);
	}
	
	public static function types(){
		return array(
			1 => Yii::t('usercontact', 'Skype'),
			2 => Yii::t('usercontact', 'Facebook'),
			3 => Yii::t('usercontact', 'Вконтакте'),
			4 => Yii::t('usercontact', 'Twitter'),
			5 => Yii::t('usercontact', 'Телефон'),
		);
	}
	
	public function getTypeList(){
		return self::types();
	}
	
	public function getTypeName(){
		$list = $this->typeList;
		return isset($list[$this->contact_type]) ? $list[$this->contact_type] : Yii::t('usercontact', 'Неизвестно');
	}
}