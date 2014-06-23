<?php

/**
 * This is the model class for table "{{guidline_content}}".
 * The followings are the available columns in table '{{guidline_content}}':
 * @property integer $id
 * @property integer $status
 * @property integer $sort
 * @property integer $create_date
 * @property integer $update_date
 * @property integer $is_index
 * @property string $content
 */
class GuidlineContent extends CActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_PUBLIC = 1;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return GuidlineContent the static model class
     */
    public static function model( $className = __CLASS__ )
    {
        return parent::model( $className );
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{guidline_content}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array( 'status, sort, content', 'required' ),
            array( 'status, sort, create_date, update_date, is_index', 'numerical', 'integerOnly' => true ),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array( 'id, status, sort, create_date, update_date, is_index, content', 'safe', 'on' => 'search' ),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }

    public function behaviors()
    {
        return array(
            'CTimestampBehavior' => array(
                'class'           => 'zii.behaviors.CTimestampBehavior',
                // disabled on console
                'createAttribute' => 'create_date',
                'updateAttribute' => 'update_date',
            ),
            'EavARBehavior'     => array(
                'class' => 'application.modules.eav.behaviors.EavARBehavior',
            ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'          => Yii::t( 'GuidlineContent', 'ID' ),
            'status'      => Yii::t( 'GuidlineContent', 'Статус' ),
            'sort'        => Yii::t( 'GuidlineContent', 'Сортировка' ),
            'create_date' => Yii::t( 'GuidlineContent', 'Дата создания' ),
            'update_date' => Yii::t( 'GuidlineContent', 'Дата обновления' ),
            'is_index'    => Yii::t( 'GuidlineContent', 'На главной' ),
            'content'     => Yii::t( 'GuidlineContent', 'Описание' ),
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

        $criteria = new CDbCriteria;

        $criteria->compare( 'id', $this->id );
        $criteria->compare( 'status', $this->status );
        $criteria->compare( 'sort', $this->sort );
        $criteria->compare( 'create_date', $this->create_date );
        $criteria->compare( 'update_date', $this->update_date );
        $criteria->compare( 'is_index', 0 );
        $criteria->compare( 'content', $this->content, true );

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'     => array(
                'defaultOrder' => 'sort ASC',
            ),
        ));
    }

    public function getFormatCreateDate()
    {
        return ($this->create_date > 0) ? Yii::app()->dateFormatter->format( "dd.MM.y, HH:mm", $this->create_date ) : Yii::t(
            'GuidlineContent',
            'Неизвестно'
        );
    }

    public function getFormatUpdateDate()
    {
        return ($this->update_date > 0) ? Yii::app()->dateFormatter->format( "dd.MM.y, HH:mm", $this->update_date ) : Yii::t(
            'GuidlineContent',
            'Неизвестно'
        );
    }

    public function getStatusName()
    {

        $list = $this->StatusList;
        return isset($list[ $this->status ]) ? $list[ $this->status ] : Yii::t( 'GuidlineContent', 'Неизвестно' );
    }

    public function getStatusList()
    {
        return array(
            self::STATUS_PUBLIC => Yii::t( 'GuidlineContent', 'Опубликованный' ),
            self::STATUS_DRAFT  => Yii::t( 'GuidlineContent', 'Черновик' ),
        );
    }

    public function getShortContent()
    {
        return mb_strlen( $this->content, 'utf-8' ) > 100 ? (mb_substr( $this->content, 0, 97, 'utf-8' ) . '...') : $this->content;
    }
}