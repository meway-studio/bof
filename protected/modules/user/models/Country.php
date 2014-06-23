<?php

/**
 * This is the model class for table "{{country}}".
 *
 * The followings are the available columns in table '{{country}}':
 * @property integer $id
 * @property string $oid
 * @property string $country_name_ru
 * @property string $country_name_en
 */
class Country extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Country the static model class
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
		return '{{country}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('oid, country_name_ru, country_name_en', 'required'),
			array('oid', 'length', 'max'=>10),
			array('country_name_ru, country_name_en', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, oid, country_name_ru, country_name_en', 'safe', 'on'=>'search'),
			array('id, oid, country_name_ru, country_name_en', 'safe', 'on'=>'usersearch'),
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
			'id' => Yii::t('country', 'ID'),
			'oid' => Yii::t('country', 'Oid'),
			'country_name_ru' => Yii::t('country', 'Наименование страны Ru'),
			'country_name_en' => Yii::t('country', 'Наименование страны En'),
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
		$criteria->compare('oid',$this->oid,true);
		$criteria->compare('country_name_ru',$this->country_name_ru,true);
		$criteria->compare('country_name_en',$this->country_name_en,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function listData(){
		return CHtml::listData( Country::model()->findAll(), 'id', Yii::app()->language=='ru' ? 'country_name_ru' : 'country_name_en');
	}
}