<?php

/**
 * This is the model class for table "{{eav_value}}".
 * The followings are the available columns in table '{{eav_value}}':
 * @property integer $id
 * @property string $create_date
 * @property string $update_date
 * @property integer $entity_id
 * @property integer $attribute_id
 * @property integer $element_id
 * @property string $value
 */
class EavValue extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{eav_value}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array( 'entity_id, attribute_id, element_id', 'numerical', 'integerOnly' => true ),
            array( 'create_date, update_date, value', 'safe' ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array( 'id, create_date, update_date, entity_id, attribute_id, element_id, value', 'safe', 'on' => 'search' ),
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

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'entity_id' => 'ID сущности',
            'attribute_id' => 'ID аттрибута',
            'element_id' => 'ID елемента',
            'value' => 'Значение',
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
        $criteria->compare( 'create_date', $this->create_date, true );
        $criteria->compare( 'update_date', $this->update_date, true );
        $criteria->compare( 'entity_id', $this->entity_id );
        $criteria->compare( 'attribute_id', $this->attribute_id );
        $criteria->compare( 'element_id', $this->element_id );
        $criteria->compare( 'value', $this->value, true );

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return EavValue the static model class
     */
    public static function model( $className = __CLASS__ )
    {
        return parent::model( $className );
    }
}
