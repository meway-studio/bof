<?php

/**
 * This is the model class for table "faq_categories".
 *
 * The followings are the available columns in table 'faq_categories':
 * @property integer $id
 * @property integer $status
 * @property integer $sort
 * @property integer $create_date
 * @property integer $update_date
 * @property string $title
 */
class FaqCategory extends CActiveRecord
{

	const STATUS_DRAFT  = 0;
	const STATUS_ACTIVE = 1;

	public $format_create_date;
	public $format_update_date;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FaqCategory the static model class
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
		return 'faq_categories';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status, title', 'required'),
			array('status, sort, create_date, update_date', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, status, sort, create_date, update_date, title', 'safe', 'on'=>'search'),
		);
	}

	public function scopes()
    {
        return array(
            'published' => array(
                'condition' => 't.status=1',
				'order'     => 't.sort DESC',
            ),
			'draft' => array(
                'condition' => 't.status=0',
				'order'     => 't.sort DESC',
            ),
			
        );
    }

    public function behaviors(){
		
		return array(
			'CTimestampBehavior' => array(
			'class'              => 'zii.behaviors.CTimestampBehavior',
			
			'createAttribute'    => 'create_date',
			'updateAttribute'    => 'update_date',
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
			'items'   => array(self::HAS_MANY, 'FaqItem', 'category_id', 'order'=>'sort ASC'),
			'p_items' => array(self::HAS_MANY, 'FaqItem', 'category_id', 'order'=>'sort ASC', 'condition' => 'status=1'),
		);
	}

	protected function afterFind(){
	  $this->format_create_date = Yii::app()->dateFormatter->format('dd/MM/yyyy HH:mm', $this->create_date);
	  $this->format_update_date = Yii::app()->dateFormatter->format('dd/MM/yyyy HH:mm', $this->update_date);

	  parent::afterFind(); //To raise the event
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'          => 'ID',
			'status'      => Yii::t('tips', 'Статус'),
			'sort'        => Yii::t('tips', 'Сортировка'),
			'create_date' => Yii::t('tips', 'Дата создания'),
			'update_date' => Yii::t('tips', 'Дата обновления'),
			'title'       => Yii::t('tips', 'Название'),
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
		$criteria->compare('sort',$this->sort);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('update_date',$this->update_date);
		$criteria->compare('title',$this->title,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getStatusList(){
		return array(
			self::STATUS_DRAFT  => Yii::t('tips','Черновик'),
			self::STATUS_ACTIVE => Yii::t('tips','Опубликованный'),

		);
	}
	
	public function getStatusName(){
		
		foreach($this->getStatusList() AS $id => $name){
			if($this->status==$id)
				return $name;
		}
		
		return Yii::t('tips', 'Неизвестно');
	}

	public function getFormatCreateDate(){
		return Yii::app()->dateFormatter->format('d MMM hh:mm', $this->create_date);
	}
	
	public function getFormatEventDate(){
		return Yii::app()->dateFormatter->format('d MMM hh:mm', $this->event_date);
	}
	
}