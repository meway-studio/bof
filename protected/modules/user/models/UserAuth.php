<?php

/**
 * This is the model class for table "{{users_auth}}".
 *
 * The followings are the available columns in table '{{users_auth}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $create_date
 * @property integer $create_ip
 * @property string $referer
 */
class UserAuth extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserAuth the static model class
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
		return '{{users_auth}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, create_date, create_ip, referer', 'required'),
			array('user_id, create_date, create_ip', 'numerical', 'integerOnly'=>true),
			array('referer', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, create_date, create_ip, referer', 'safe', 'on'=>'search'),
			array('id, user_id, create_date, create_ip, referer', 'safe', 'on'=>'usersearch'),
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
			'id' => Yii::t('userauth', 'ID'),
			'user_id' => Yii::t('userauth', 'Пользователь'),
			'create_date' => Yii::t('userauth', 'Дата добавления'),
			'create_ip' => Yii::t('userauth', 'Создан Ip'),
			'referer' => Yii::t('userauth', 'Обращения'),
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
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('create_ip',$this->create_ip);
		$criteria->compare('referer',$this->referer,true);

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

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('create_ip',$this->create_ip);
		$criteria->compare('referer',$this->referer,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave(){

		if(parent::beforeSave()){
			
			if($this->isNewRecord){
				$this->create_date = date("U");
			}else{
				$this->update_date = date("U");
			}

			return true;
		
		}else{
			return false;
		}
	}

	public function getStatusList(){
		return array(
			0 => Yii::t('userauth', 'Закрыта'),
			1 => Yii::t('userauth', 'Открыта'),
		);
	}

	public function getStatusName(){
		$list = $this->StatusList;
		return isset($list[$this->status]) ? $list[$this->status] : Yii::t('userauth', 'Неизвестно');
	}

	public function getFormatCreateDate(){
		return ($this->create_date>0) ? Yii::app()->dateFormatter->format("dd.MM.y, HH:mm", $this->create_date) : Yii::t('userauth', 'Неизвестно');
	}

	public function getFormatUpdateDate(){
		return ($this->update_date>0) ? Yii::app()->dateFormatter->format("dd.MM.y, HH:mm", $this->update_date) : Yii::t('userauth', 'Неизвестно');
	}
	/*
	public function getShortTitle(){
		return mb_substr($this->title,0,20,'utf-8').'...';
	}
	
	public function getShortDescription(){
		return mb_substr($this->description,0,150,'utf-8').'...';
	}
	*/
}