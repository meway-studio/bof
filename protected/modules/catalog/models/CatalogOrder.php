<?php

/**
 * This is the model class for table "{{catalog_order}}".
 * The followings are the available columns in table '{{catalog_order}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $create_date
 * @property string $update_date
 * @property string $comment
 * @property integer $delivery_id
 * @property integer $status_id
 * @property integer $active
 * @method array orderElements()
 */
class CatalogOrder extends ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{catalog_order}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array( 'user_id, delivery_id, status_id, active', 'numerical', 'integerOnly' => true ),
            array( 'create_date, update_date, comment', 'safe' ),
            array(
                'id, user_id, create_date, update_date, comment, delivery_id, status_id, active',
                'safe',
                'on' => 'search'
            ),
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
            'orderElements' => array(
                self::HAS_MANY,
                'CatalogOrderElement',
                'order_id',
            ),
            'delivery'      => array(
                self::BELONGS_TO,
                'CatalogOrderDelivery',
                'delivery_id',
            ),
            'status'        => array(
                self::BELONGS_TO,
                'CatalogOrderStatus',
                'status_id',
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
            'user_id'     => 'Пользователь',
            'create_date' => 'Дата создания',
            'update_date' => 'Дата обновления',
            'comment'     => 'Комментарий',
            'delivery_id' => 'Доставка',
            'status_id'   => 'Статус',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare( 'id', $this->id );
        $criteria->compare( 'user_id', $this->user_id );
        $criteria->compare( 'create_date', $this->create_date, true );
        $criteria->compare( 'update_date', $this->update_date, true );
        $criteria->compare( 'comment', $this->comment, true );
        if ($this->delivery_id) {
            $criteria->compare( 'delivery_id', $this->delivery_id );
        }
        if ($this->status_id) {
            $criteria->compare( 'status_id', $this->status_id );
        }
        $criteria->compare( 'active', $this->active );

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CatalogOrder the static model class
     */
    public static function model( $className = __CLASS__ )
    {
        return parent::model( $className );
    }
}
