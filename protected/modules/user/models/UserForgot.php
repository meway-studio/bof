<?php

/**
 * This is the model class for table "{{users_forgot}}".
 *
 * The followings are the available columns in table '{{users_forgot}}':
 * @property integer $id
 * @property integer $status
 * @property integer $user_id
 * @property integer $create_date
 * @property integer $ending_date
 * @property integer $update_date
 * @property integer $create_ip
 * @property string $referer
 * @property string $hash
 */
class UserForgot extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserForgot the static model class
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
		return '{{users_forgot}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			
			// create
			array('user_id', 'required', 'on'=>'create'),
			
			// update
			array('status, update_date', 'required', 'on'=>'update'),

			
			// The following rule is used by search().
			array('id, status, user_id, create_date, ending_date, update_date, create_ip, referer, hash', 'safe', 'on'=>'search'),
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
			'user'=>array(self::BELONGS_TO, 'User','user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'          =>  Yii::t('userforgot', 'ID'),
			'status'      =>  Yii::t('userforgot', 'Статус'),
			'user_id'     =>  Yii::t('userforgot', 'Пользователь'),
			'create_date' =>  Yii::t('userforgot', 'Создан'),
			'ending_date' =>  Yii::t('userforgot', 'Истекает'),
			'update_date' =>  Yii::t('userforgot', 'Изменен'),
			'create_ip'   =>  Yii::t('userforgot', 'Ip'),
			'referer'     =>  Yii::t('userforgot', 'Обращения'),
			'hash'        =>  Yii::t('userforgot', 'Хэш'),
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('ending_date',$this->ending_date);
		$criteria->compare('update_date',$this->update_date);
		$criteria->compare('create_ip',$this->create_ip);
		$criteria->compare('referer',$this->referer,true);
		$criteria->compare('hash',$this->hash,true);

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
				$this->status      = 0;
				$this->create_date = date("U");
				$this->create_ip   = ip2long(Yii::app()->request->userHostAddress);
				$this->hash        = md5(uniqid());
				$this->referer     = Yii::app()->user->returnUrl;
				$this->ending_date = date('U')+3600;
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
			0 => Yii::t('userforgot', 'Новый'),
			1 => Yii::t('userforgot', 'Использован'),
		);
	}

	public function getStatusName(){
		$list = $this->StatusList;
		return isset($list[$this->status]) ? $list[$this->status] : Yii::t('userforgot', 'Неизвестно');
	}

	public function getFormatCreateDate(){
		return ($this->create_date>0) ? Yii::app()->dateFormatter->format("dd.MM.y, HH:mm", $this->create_date) : Yii::t('userforgot', 'Неизвестно');
	}

	public function getFormatUpdateDate(){
		return ($this->update_date>0) ? Yii::app()->dateFormatter->format("dd.MM.y, HH:mm", $this->update_date) : Yii::t('userforgot', 'Неизвестно');
	}

}