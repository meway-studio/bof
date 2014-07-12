<?php

/**
 * This is the model class for table "{{catalog_order_element}}".
 * The followings are the available columns in table '{{catalog_order_element}}':
 * @property integer $id
 * @property integer $order_id
 * @property integer $element_id
 * @property string $create_date
 * @property string $update_date
 * @property integer $quantity
 */
class CatalogOrderElement extends ActiveRecord
{
    public $element_title_search;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{catalog_order_element}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array( 'order_id, element_id, quantity', 'required' ),
            //array( 'order_id, element_id, quantity', 'numerical', 'integerOnly' => true ),
            array( 'create_date, update_date', 'safe' ),
            array( 'id, order_id, element_id, create_date, update_date, quantity, element_title_search', 'safe', 'on' => 'search' ),
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
            'element' => array(
                self::BELONGS_TO,
                'CatalogElement',
                array( 'element_id' => 'id' ),
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
            'order_id'    => 'ID заказа',
            'element_id'  => 'ID элемента',
            'create_date' => 'Дата создания',
            'update_date' => 'Update Date',
            'quantity'    => 'Кол-во',
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
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare( 'id', $this->id );
        $criteria->compare( 'order_id', $this->order_id );
        $criteria->compare( 'element_id', $this->element_id );
        $criteria->compare( 'create_date', $this->create_date, true );
        $criteria->compare( 'update_date', $this->update_date, true );
        $criteria->compare( 'quantity', $this->quantity );

        $criteria->with = array( 'element' );
        $criteria->compare( 'element.title', $this->element_title_search, true );

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'     => array(
                'attributes' => array(
                    'element_title_search' => array(
                        'asc'  => 'element.title',
                        'desc' => 'element.title DESC',
                    ),
                    '*',
                ),
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CatalogOrderElement the static model class
     */
    public static function model( $className = __CLASS__ )
    {
        return parent::model( $className );
    }
}
