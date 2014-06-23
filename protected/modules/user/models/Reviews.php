<?php

/**
 * This is the model class for table "{{reviews}}".
 *
 * The followings are the available columns in table '{{reviews}}':
 * @property integer $id
 * @property integer $sort
 * @property integer $status
 * @property integer $create_date
 * @property integer $update_date
 * @property integer $user_id
 * @property string $content
 */
class Reviews extends CActiveRecord
{

	public $user_name;

	const STATUS_DRAFT  = 0;
	const STATUS_ACTIVE = 1;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Reviews the static model class
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
		return '{{reviews}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status, user_id, content', 'required'),
			array('sort, status, create_date, update_date, user_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sort, status, create_date, update_date, user_id, content', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	public function scopes()
    {
        return array(
            'published' => array(
                'condition' => 't.status='.self::STATUS_ACTIVE,
				'order'     => 't.sort DESC',
            ),
        );
    }

	protected function afterFind(){

	  $this->user_name  = $this->getUserName();

	  parent::afterFind(); //To raise the event
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'          => Yii::t('Reviews', 'ID'),
			'sort'        => Yii::t('Reviews', 'Сортировка'),
			'status'      => Yii::t('Reviews', 'Статус'),
			'create_date' => Yii::t('Reviews', 'Дата добавления'),
			'update_date' => Yii::t('Reviews', 'Дата обновления'),
			'user_id'     => Yii::t('Reviews', 'Пользователь'),
			'user_name'   => Yii::t('Reviews', 'Пользователь'),
			'content'     => Yii::t('Reviews', 'Описание'),
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
		
		$criteria->with = array( 'user' );

		$criteria->compare('id',$this->id);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_date',$this->create_date);
		$criteria->compare('update_date',$this->update_date);

		$criteria->compare('user.firstname',$this->user_id, true);
		$criteria->compare('user.email',$this->user_id, true, 'OR');
		
		$criteria->compare('content',$this->content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getStatusList(){
		return array(
			self::STATUS_DRAFT  => Yii::t('tips','Черновик'),
			self::STATUS_ACTIVE => Yii::t('tips','Опубликован'),

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
		return ($this->create_date>0) ? Yii::app()->dateFormatter->format("dd.MM.y, HH:mm", $this->create_date) : Yii::t('user', 'Неизвестно');
	}

	public function getFormatUpdateDate(){
		return ($this->update_date>0) ? Yii::app()->dateFormatter->format("dd.MM.y, HH:mm", $this->update_date) : Yii::t('user', 'Неизвестно');
	}

	public function getUserName(){
		return $this->user!=null ? ($this->user->FullName.'('.$this->user->email.')') : Yii::t('Reviews', 'Не найдено');
	}

	public function getUserFullName(){
		return $this->user!=null ? $this->user->FullName : Yii::t('Reviews', 'Не найдено');
	}

	public function getUserRank(){
		return $this->user!=null ? ($this->user->tipster!=null ? $this->user->tipster->rank : Yii::t('Reviews', 'Подписчик BOF')) : Yii::t('Reviews', 'Подписчик BOF') ;
	}

	public function getUserAvatar(){
		return $this->user!=null ? $this->user->PhotoThumb : 'https://cdn3.iconfinder.com/data/icons/ballcons/png/classic.png';
	}

	public function getShortContent(){
		return mb_strlen($this->content,'utf-8') > 100 ? (mb_substr($this->content, 0, 97, 'utf-8') . '...') : $this->content;
	}
	
}