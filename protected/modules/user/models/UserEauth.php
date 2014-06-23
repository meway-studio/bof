<?php

/**
 * This is the model class for table "{{users_eauth}}".
 *
 * The followings are the available columns in table '{{users_eauth}}':
 * @property integer $id
 * @property string $hash
 * @property integer $user_id
 * @property string $service
 */
class UserEauth extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserEauth the static model class
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
		return '{{users_eauth}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('hash, user_id, service', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('hash', 'length', 'max'=>32),
			array('service', 'length', 'max'=>50),
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
			'user' => array(self::BELONGS_TO, 'User','user_id'),
		);
	}
}