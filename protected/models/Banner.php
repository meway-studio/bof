<?php

/**
 * This is the model class for table "{{banner}}".
 * The followings are the available columns in table '{{banner}}':
 * @property integer $id
 * @property string $create_date
 * @property string $update_date
 * @property string $title
 * @property string $image
 * @property string $show
 * @property string $url
 */
class Banner extends CActiveRecord
{
    const SHOW_ALL = 'ALL';
    const SHOW_GUEST = 'GUEST';
    const SHOW_AUTHORIZED = 'AUTHORIZED';

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Banner the static model class
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
        return '{{banner}}';
    }

    public function scopes()
    {
        return array(
            'new'    => array(
                'order' => 'create_date DESC',
            ),
            'bySort' => array(
                'order' => 'sort DESC',
            ),
            'active' => array(
                'condition' => 't.active = 1'
            ),
        );
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array( 'title, image, url', 'length', 'max' => 255 ),
            array( 'image', 'file', 'types' => 'jpg,png,bmp', 'allowEmpty' => true, 'safe' => false, 'on' => 'admin' ),
            array( 'show', 'length', 'max' => 10 ),
            array(
                'show',
                'in',
                'range' => array(
                    Yii::t( 'banner', 'Всем' )           => self::SHOW_ALL,
                    Yii::t( 'banner', 'Гостям' )         => self::SHOW_GUEST,
                    Yii::t( 'banner', 'Авторизованным' ) => self::SHOW_AUTHORIZED,
                )
            ),
            array( 'create_date, update_date, sort, active', 'safe' ),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array( 'id, create_date, update_date, title, image, show, url, sort, active', 'safe', 'on' => 'search' ),
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
            'id'          => 'ID',
            'create_date' => Yii::t( 'banner', 'Дата создания' ),
            'update_date' => Yii::t( 'banner', 'Дата обновления' ),
            'title'       => Yii::t( 'banner', 'Заголовок' ),
            'image'       => Yii::t( 'banner', 'Изображение' ),
            'show'        => Yii::t( 'banner', 'Показывать' ),
            'url'         => Yii::t( 'banner', 'Ссылка' ),
            'sort'        => Yii::t( 'banner', 'Сортировка' ),
            'active'      => Yii::t( 'banner', 'Активен' ),
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
        $criteria->compare( 'create_date', $this->create_date, true );
        $criteria->compare( 'update_date', $this->update_date, true );
        $criteria->compare( 'title', $this->title, true );
        $criteria->compare( 'image', $this->image, true );
        $criteria->compare( 'show', $this->show, true );
        $criteria->compare( 'url', $this->url, true );

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getShowData()
    {
        return array(
            'ALL'        => Yii::t( 'banner', 'Всем' ),
            'GUEST'      => Yii::t( 'banner', 'Гостям' ),
            'AUTHORIZED' => Yii::t( 'banner', 'Авторизованным' ),
        );
    }

    /**
     * @return array|mixed
     */
    public function behaviors()
    {
        Yii::import( 'ext.imageBehavior.imageBehavior' );
        return array(
            'ImageBehavior' => array(
                'class'     => 'ext.imageBehavior.imageBehavior',
                'filePath'  => 'webroot.uploads.banners',
                'fileField' => 'image',
            )
        );
    }
}