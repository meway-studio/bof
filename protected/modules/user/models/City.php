<?php

/**
 * This is the model class for table "{{city}}".
 *
 * The followings are the available columns in table '{{city}}':
 * @property string $id
 * @property string $id_region
 * @property integer $id_country
 * @property string $oid
 * @property string $city_name_ru
 * @property string $city_name_en
 */
class City extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return City the static model class
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
		return '{{city}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_region, id_country, oid, city_name_en', 'required'),
			array('id_country', 'numerical', 'integerOnly'=>true),
			array('id_region, oid', 'length', 'max'=>10),
			array('city_name_ru, city_name_en', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_region, id_country, oid, city_name_ru, city_name_en', 'safe', 'on'=>'search'),
			array('id, id_region, id_country, oid, city_name_ru, city_name_en', 'safe', 'on'=>'usersearch'),
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
			'id' => Yii::t('city', 'ID'),
			'id_region' => Yii::t('city', 'Id региона'),
			'id_country' => Yii::t('city', 'Id Страны'),
			'oid' => Yii::t('city', 'Oid'),
			'city_name_ru' => Yii::t('city', 'Наименование города Ru'),
			'city_name_en' => Yii::t('city', 'Наименование города En'),
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('id_region',$this->id_region,true);
		$criteria->compare('id_country',$this->id_country);
		$criteria->compare('oid',$this->oid,true);
		$criteria->compare('city_name_ru',$this->city_name_ru,true);
		$criteria->compare('city_name_en',$this->city_name_en,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

		/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function usersearch()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('id_region',$this->id_region,true);
		$criteria->compare('id_country',$this->id_country);
		$criteria->compare('oid',$this->oid,true);
		$criteria->compare('city_name_ru',$this->city_name_ru,true);
		$criteria->compare('city_name_en',$this->city_name_en,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function listData(){
		return CHtml::listData( City::model()->findAll(), 'id', 'Name');
	}
	
	public function getName(){
		return Yii::app()->language=='ru' ? $this->city_name_ru : $this->city_name_en;
	}
}