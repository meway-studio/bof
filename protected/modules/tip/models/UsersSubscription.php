<?php

/**
 * This is the model class for table "{{users_subscription}}".
 *
 * The followings are the available columns in table '{{users_subscription}}':
 * @property integer $id
 * @property integer $update_date
 * @property integer $type
 * @property integer $user_id
 * @property integer $tipster_id
 * @property integer $expiration_date
 */
class UsersSubscription extends CActiveRecord
{
	public $format_expiration_date;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UsersSubscription the static model class
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
		return '{{users_subscription}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, expiration_date', 'required'),
			array('update_date, type, user_id, tipster_id', 'numerical', 'integerOnly'=>true),
			array('format_expiration_date', 'date', 'allowEmpty'=>true, 'timestampAttribute'=>'expiration_date', 'format'=>'MM/dd/yyyy'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, update_date, type, user_id, tipster_id, expiration_date', 'safe', 'on'=>'search'),
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
			'id'              => Yii::t('usub', 'ID'),
			'update_date'     => Yii::t('usub', 'Обновлен'),
			'type'            => Yii::t('usub', 'Тип'),
			'user_id'         => Yii::t('usub', 'Пользователь'),
			'tipster_id'      => Yii::t('usub', 'Автор'),
			'expiration_date' => Yii::t('usub', 'Дата окончания подписки'),
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
		$criteria->compare('update_date',$this->update_date);
		$criteria->compare('type',$this->type);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('tipster_id',$this->tipster_id);
		$criteria->compare('expiration_date',$this->expiration_date);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getActive(){
		return ($this->expiration_date - date('U') ) > 0;
	}

	public function getFormatCreateDate(){
		return ($this->create_date>0) ? Yii::app()->dateFormatter->format("dd.MM.y, HH:mm", $this->create_date) : Yii::t('usub', 'Неизвестно');
	}

	public function getFormatUpdateDate(){
		return ($this->update_date>0) ? Yii::app()->dateFormatter->format("dd.MM.y, HH:mm", $this->update_date) : Yii::t('usub', 'Неизвестно');
	}

	public function getFormatExpirationDate(){
		return ($this->expiration_date>0) ? Yii::app()->dateFormatter->format("MM/dd/yyyy", $this->expiration_date) : Yii::t('usub', 'Неизвестно');
	}
}