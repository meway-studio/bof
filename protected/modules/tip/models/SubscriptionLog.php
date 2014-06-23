<?php

/**
 * This is the model class for table "{{subscription_log}}".
 *
 * The followings are the available columns in table '{{subscription_log}}':
 * @property integer $id
 * @property integer $create_date
 * @property integer $type
 * @property integer $user_id
 * @property integer $tipster_id
 * @property integer $expiration_date
 */
class SubscriptionLog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SubscriptionLog the static model class
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
		return '{{subscription_log}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('create_date, type, user_id, tipster_id, expiration_date', 'required'),
			array('create_date, type, user_id, tipster_id, expiration_date', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, create_date, type, user_id, tipster_id, expiration_date', 'safe', 'on'=>'search'),
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

	public function behaviors(){
		return array(
			'CTimestampBehavior' => array(
				'class'              => 'zii.behaviors.CTimestampBehavior',
				'updateAttribute'    => 'update_date',
				'createAttribute'    => 'create_date',
			)
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'              => Yii::t('SubscriptionLog', 'ID'),
			'create_date'     => Yii::t('SubscriptionLog', 'Create Date'),
			'type'            => Yii::t('SubscriptionLog', 'Type'),
			'user_id'         => Yii::t('SubscriptionLog', 'User'),
			'tipster_id'      => Yii::t('SubscriptionLog', 'Tipster'),
			'expiration_date' => Yii::t('SubscriptionLog', 'Expiration Date'),
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
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('type',$this->type);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('tipster_id',$this->tipster_id);
		$criteria->compare('expiration_date',$this->expiration_date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}