<?php

/**
 * This is the model class for table "{{users_credit_cards}}".
 *
 * The followings are the available columns in table '{{users_credit_cards}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $card_type
 * @property string $card_number
 * @property integer $card_exp_year
 * @property integer $card_exp_month
 */
class UsersCreditCard extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UsersCreditCard the static model class
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
		return '{{users_credit_cards}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, card_type, card_exp_year, card_exp_month', 'required'), //card_number
			array('user_id, card_type, card_exp_year, card_exp_month', 'numerical', 'integerOnly'=>true),
			array('card_number', 'length', 'max'=>20),

			array('id, user_id, card_type, card_number, card_exp_year, card_exp_month', 'safe', 'on'=>'search'),

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
			'id' => Yii::t('userscreditcard', 'ID'),
			'user_id' => Yii::t('userscreditcard', 'Владелец'),
			'card_exp' => Yii::t('userscreditcard', 'Окончание действия'),
			'card_type' => Yii::t('userscreditcard', 'Тип карты'),
			'card_number' => Yii::t('userscreditcard', 'Номер карты'),
			'card_exp_year' => Yii::t('userscreditcard', 'Год окончания'),
			'card_exp_month' => Yii::t('userscreditcard', 'Месяц окончания'),
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('card_type',$this->card_type);
		$criteria->compare('card_number',$this->card_number,true);
		$criteria->compare('card_exp_year',$this->card_exp_year);
		$criteria->compare('card_exp_month',$this->card_exp_month);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getTypeList(){
		return array(
			1 => Yii::t('user', 'Visa'),
			2 => Yii::t('user', 'Master Card'),
		);
	}

	public function getTypeName(){
		$list = $this->TypeList;
		return isset($list[$this->card_type]) ? $list[$this->card_type] : Yii::t('user', 'Неизвестно');
	}
	
	public function getYearList(){
		$result = array();
		for($i=date("Y");$i<date("Y")+10;$i++){
			$result[$i] = $i;
		}
		return $result;
	}
	
	public function getMonthList(){
		$result = array();
		for($i=1;$i<13;$i++){
			$result[$i] = $i;
		}
		return $result;
	}
}