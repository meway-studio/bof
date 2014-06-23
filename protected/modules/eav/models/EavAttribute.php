<?php

/**
 * This is the model class for table "{{eav_attribute}}".
 * The followings are the available columns in table '{{eav_attribute}}':
 * @property integer $id
 * @property string $create_date
 * @property string $update_date
 * @property string $name
 * @property string $label
 * @property string $hint
 * @property string $type
 * @property integer $many
 * @property string $options
 * @property integer $sort
 * @property EavValue $eav_value
 * @property array $eav_values EavValue
 */
class EavAttribute extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{eav_attribute}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array( 'sort, many', 'numerical', 'integerOnly' => true ),
            array( 'name', 'length', 'max' => 100 ),
            array( 'label, hint, type', 'length', 'max' => 255 ),
            array( 'create_date, update_date', 'safe' ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array( 'id, name, label, type', 'safe', 'on' => 'search' ),
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
            'name' => 'Название',
            'label' => 'Ярлык',
            'hint' => 'Подсказка',
            'type' => 'Тип',
            'options' => 'Опции',
            'sort' => 'Сортировка',
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
        $criteria->compare( 'name', $this->name, true );
        $criteria->compare( 'label', $this->label, true );
        $criteria->compare( 'type', $this->type, true );
        $criteria->compare( 'many', $this->many, true );

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return EavAttribute the static model class
     */
    public static function model( $className = __CLASS__ )
    {
        return parent::model( $className );
    }

    /*public function beforeSave()
    {
        if (is_array($this->options)) {
            $this->options = json_encode($this->options);
        }
    }*/

    public function beforeDelete()
    {
        $tables = array(
            EavEntityAttribute::model()->tableName(),
            EavRules::model()->tableName(),
            EavValue::model()->tableName(),
        );

        foreach ($tables as $table) {
            Yii::app()->db->createCommand()->delete(
                $table,
                'attribute_id = :attribute_id',
                array(
                    ':attribute_id' => $this->id
                )
            );
        }
        return parent::beforeDelete();
    }
}
