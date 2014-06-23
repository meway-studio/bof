<?php

/**
 * This is the model class for table "{{mail_task}}".
 *
 * The followings are the available columns in table '{{mail_task}}':
 * @property integer $id
 * @property integer $status
 * @property integer $create_date
 * @property integer $update_date
 * @property string $subject
 * @property string $content
 * @property integer $all
 * @property integer $success
 * @property integer $errors
 * @property integer $type
 * @property string $emails
 * @property string $copied
 */
class MailTask extends CActiveRecord
{
	const TYPE_FREE     = 0;
	const TYPE_PAID     = 1;
	const TYPE_ALL      = 2;
	const TYPE_NB       = 3;
	
	const STATUS_DRAFT   = 0;
	const STATUS_ACTIVE  = 1;
	const STATUS_PROCESS = 2;
	const STATUS_PAUSE   = 3;
	const STATUS_CLOSE   = 4;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MailTask the static model class
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
		return '{{mail_task}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status, subject, content, type', 'required'),
			array('status, create_date, update_date, all, success, errors, type, copied', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>250),
			array('content, emails', 'length', 'max'=>4000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, status, create_date, update_date, subject, all, success, errors, type, emails', 'safe', 'on'=>'search'),
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
			'recipient' => array(self::HAS_MANY, 'MailTaskRecipients', 'task_id'),
		);
	}
	
	public function behaviors(){
		
		return array(
			'CTimestampBehavior' => array(
			'class'              => 'zii.behaviors.CTimestampBehavior',
			// disabled on console
			'createAttribute'    => 'create_date',
			'updateAttribute'    => 'update_date',
			)
		);

	}
	
	public function scopes()
    {
        return array(

			'active' => array(
                'condition' => 't.status = '.self::STATUS_ACTIVE.' OR t.status = '.self::STATUS_PAUSE,
            ),
        );
    }
	
	public function afterSave(){
		
		if($this->copied==1)
			return parent::afterSave();
		
		// получить всех пользователей и занести их в список рассылки
		$model = User::model()->active()->spamer();
		
		if($this->type == self::TYPE_FREE)
			$model = $model->free();
		
		if($this->type == self::TYPE_PAID)
			$model = $model->paid();
		
		$model = $this->type == self::TYPE_NB ? array() : $model->findAll();
		
		$count = count($model);
		
		foreach($model AS $item){
			$rec = new MailTaskRecipients();
			$rec->task_id = $this->id;
			$rec->user_id = $item->id;
			$rec->save();
		}
		
		// добавить дополнительные емейлы
		$emails = explode(",", $this->emails);
		
		foreach($emails AS $e){
			$e   = trim($e);
			
			if(empty($e))
				continue;
			
			$count++;
			
			$rec = new MailTaskRecipients();
			$rec->task_id = $this->id;
			$rec->email   = trim($e);
			$rec->save();
		}

		Yii::app()->db->createCommand()->update($this->tableName(), array(
			'copied' => 1,
			'all'    => $count,
		), 'id=:id', array(':id'=>$this->id));
		
		return parent::afterSave();
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'          => 'ID',
			'status'      => Yii::t('tips', 'Статус'),
			'create_date' => Yii::t('tips', 'Дата создания'),
			'update_date' => Yii::t('tips', 'Дата обновления'),
			'subject'     => Yii::t('tips', 'Тема'),
			'all'         => Yii::t('tips', 'Всего'),
			'success'     => Yii::t('tips', 'Успешно'),
			'errors'      => Yii::t('tips', 'С ошибкой'),
			'type'        => Yii::t('tips', 'Тип'),
			'emails'      => Yii::t('tips', 'Email'),
			'copied'      => Yii::t('tips', 'Копий'),
			'content'      => Yii::t('tips', 'Текст'),
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
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('update_date',$this->update_date);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('all',$this->all);
		$criteria->compare('success',$this->success);
		$criteria->compare('errors',$this->errors);
		$criteria->compare('type',$this->type);
		$criteria->compare('emails',$this->emails,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getStatusList(){
		return array(
			self::STATUS_DRAFT   => Yii::t('tips','Черновик'),
			self::STATUS_ACTIVE  => Yii::t('tips','Активная'),
			self::STATUS_PROCESS => Yii::t('tips','В процессе'),
			self::STATUS_PAUSE   => Yii::t('tips','Пауза'),
			self::STATUS_CLOSE   => Yii::t('tips','Закрыто'),

		);
	}
	
	public function getStatusName(){
		
		foreach($this->getStatusList() AS $id => $name){
			if($this->status==$id)
				return $name;
		}
		
		return Yii::t('tips', 'Неизвестно');
	}
	
	
	public function getTypeList(){
		return array(
			self::TYPE_NB    => Yii::t('tips', 'Никому'),
			self::TYPE_ALL   => Yii::t('tips', 'Все'),
			self::TYPE_FREE  => Yii::t('tips', 'Бесплатная'),
			self::TYPE_PAID  => Yii::t('tips', 'Платная'),
		);
	}
	
	public function getTypeName(){
		$list = $this->getTypeList();
		return isset($list[$this->type]) ? $list[$this->type] : Yii::t('tips', 'Неизвестно') ;
	}
	
	public function getFormatCreateDate(){
		return Yii::app()->dateFormatter->format('d MMM hh:mm', $this->create_date);
	}
	
	public function getFormatUpdateDate(){
		return Yii::app()->dateFormatter->format('d MMM hh:mm', $this->update_date);
	}
	
}