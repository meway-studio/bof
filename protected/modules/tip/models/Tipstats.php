<?php

/**
 * This is the model class for table "{{tipstats}}".
 *
 * The followings are the available columns in table '{{tipstats}}':
 * @property integer $id
 * @property integer $create_date
 * @property integer $update_date
 * @property integer $month
 * @property integer $year
 * @property integer $tipster_id
 * @property string $profit
 * @property string $yield
 * @property integer $tipscount
 * @property integer $count_won
 * @property integer $count_lost
 * @property integer $count_void
 * @property integer $bank
 * @property integer $desc
 */
class Tipstats extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tipstats the static model class
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
		return '{{tipstats}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('month, year, tipster_id, profit, yield, tipscount, count_won, count_lost, count_void', 'required'),
			array('create_date, update_date, month, year, tipster_id, tipscount, count_won, count_lost, count_void', 'numerical', 'integerOnly'=>true),
			array('profit, yield, bank', 'length', 'max'=>10),
			array('desc', 'length', 'max'=>250),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, update_date, month, year, tipster_id, profit, yield, tipscount', 'safe', 'on'=>'search'),
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
			// disabled on console
			'createAttribute'    => 'create_date',
			'updateAttribute'    => 'update_date',
			)
		);
	}

	public function byTipster($id)
	{
		$this->getDbCriteria()->compare('tipster_id', $id);
		return $this;
	}
	
	public function scopes()
    {
        return array(
            'toView' => array(
                'limit'   => 12,
				'order'   => 'year DESC, month DESC',
            ),
			'toGrid' => array(
				'order'   => 'year DESC, month DESC',
			),
        );
    }
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id'          => 'ID',
			'update_date' => Yii::t('tips', 'Дата обновления'),
			'create_date' => Yii::t('tips', 'Дата создания'),
			'month'       => Yii::t('tips', 'Месяц'),
			'year'        => Yii::t('tips', 'Год'),
			'tipster_id'  => Yii::t('tips', 'Автор'),
			'profit'      => Yii::t('tips', 'Прибыль'),
			'yield'       => Yii::t('tips', 'Доходность'),
			'tipscount'   => Yii::t('tips', 'Результат'),
			'count_won'   => Yii::t('tips', 'Выиграл'),
			'count_lost'  => Yii::t('tips', 'Потерял'),
			'count_void'  => Yii::t('tips', 'Пустой'),
			'bank'        => Yii::t('tips', 'Банк'),
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
		$criteria->compare('month',$this->month);
		$criteria->compare('year',$this->year);
		$criteria->compare('tipster_id',$this->tipster_id);
		$criteria->compare('profit',$this->profit,true);
		$criteria->compare('yield',$this->yield,true);
		$criteria->compare('tipscount',$this->tipscount);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function monthStat(){
		
		$criteria=new CDbCriteria;
		$criteria->compare('tipster_id', $this->tipster_id);
		$criteria->condition = 'tipscount>0';
		$criteria->order     = 'year, month DESC';
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => self::TIP_LAST_COUNT,
			),
		));
	}
	
	public function getStatDate(){
		$mask = ( $this->month == date('m') AND $this->year==date("Y") ) ? 'd MMMM yy' : 'MMMM yy';
		$day  = ( $this->month == date('m') AND $this->year==date("Y") ) ? date('d')   : '01';
		return Yii::app()->dateFormatter->format($mask, strtotime($day.'-'.$this->month.'-'.$this->year.' 00:00:00'));
	}
	
	public function getMonthX(){
		$mask = ( $this->month == date('m') AND $this->year==date("Y") ) ? 'd MMM yy' : 'MMM yy';
		$day  = ( $this->month == date('m') AND $this->year==date("Y") ) ? date('d')   : '01';
		return Yii::app()->dateFormatter->format($mask, strtotime($day.'-'.$this->month.'-'.$this->year.' 00:00:00'));
	}
	
	public function getPrevMonthX(){
	
		if($this->month==1){
			$month = 12;
			$year  = $this->year-1;
		}else{
			$month = $this->month-1;
			$year  = $this->year;
		}
			
		return Yii::app()->dateFormatter->format('MMM yy', strtotime('01-'.$month.'-'.$year.' 00:00:00'));
	}
}