<?php

/**
 * This is the model class for table "{{catalog_category}}".
 * The followings are the available columns in table '{{catalog_category}}':
 * @property integer $id
 * @property string $create_date
 * @property string $update_date
 * @property integer $root_id
 * @property integer $left_id
 * @property integer $right_id
 * @property integer $parent_id
 * @property integer $author_id
 * @property integer $level
 * @property string $name
 * @property string $title
 * @property string $short_description
 * @property string $full_description
 * @property string $hash
 * @property string $image
 * @property integer $tpl_inherit
 * @property string $tpl_theme
 * @property string $tpl_path
 * @property string $tpl_layout
 * @property string $tpl_view
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 * @property integer $sort
 * @property integer $search
 * @property integer $active
 * @property CatalogElement[] $allElements
 * @property CatalogCategory $catalog
 * @property string|null $tplPath
 * @property string|null $tplViewPath
 */
class CatalogCategory extends CatalogAR
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{catalog_category}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(
                'root_id, left_id, right_id, parent_id, author_id, level, tpl_inherit, sort, search, active',
                'numerical',
                'integerOnly' => true
            ),
            array( 'hash', 'length', 'max' => 50 ),
            array( 'title', 'required' ),
            array( 'name, tpl_path', 'length', 'max' => 100 ),
            array( 'tpl_theme', 'length', 'max' => 20 ),
            array( 'tpl_layout, tpl_view', 'length', 'max' => 30 ),
            array( 'title, meta_title, meta_keywords, meta_description', 'length', 'max' => 255 ),
            array( 'create_date, update_date, short_description, full_description, hash', 'safe' ),
            array( 'image', 'file', 'types' => 'jpg,png', 'allowEmpty' => true, 'safe' => false, 'on' => 'admin' ),
            array(
                'id, hash, create_date, update_date, root_id, parent_id, author_id, level, name, title, short_description, full_description, meta_title, meta_keywords, meta_description, search',
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
            'catalog'       => array(
                self::BELONGS_TO,
                'CatalogCategory',
                'root_id',
            ),
            'elements'      => array(
                self::HAS_MANY,
                'CatalogElement',
                'category_id',
            ),
            'countElements' => array(
                self::STAT,
                'CatalogElement',
                'category_id',
            ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'                => 'ID',
            'hash'              => Yii::t( 'CatalogModule.category.model', 'Хэш' ),
            'create_date'       => Yii::t( 'CatalogModule.category.model', 'Дата создания' ),
            'update_date'       => Yii::t( 'CatalogModule.category.model', 'Дата обновления' ),
            'root_id'           => Yii::t( 'CatalogModule.category.model', 'Каталог' ),
            'left_id'           => 'Left',
            'right_id'          => 'Right',
            'parent_id'         => 'Parent',
            'author_id'         => Yii::t( 'CatalogModule.category.model', 'Автор' ),
            'level'             => Yii::t( 'CatalogModule.category.model', 'Уровень вложенности' ),
            'name'              => Yii::t( 'CatalogModule.category.model', 'Имя' ),
            'title'             => Yii::t( 'CatalogModule.category.model', 'Заголовок' ),
            'short_description' => Yii::t( 'CatalogModule.category.model', 'Краткое описание' ),
            'full_description'  => Yii::t( 'CatalogModule.category.model', 'Полное описание' ),
            'image'             => Yii::t( 'CatalogModule.category.model', 'Изображение' ),
            'tpl_inherit'       => Yii::t( 'CatalogModule.category.model', 'Наследовать дизайн от родителя' ),
            'tpl_theme'         => Yii::t( 'CatalogModule.category.model', 'Тема' ),
            'tpl_path'          => Yii::t( 'CatalogModule.category.model', 'Путь к шаблонам' ),
            'tpl_layout'        => Yii::t( 'CatalogModule.category.model', 'Макет' ),
            'tpl_view'          => Yii::t( 'CatalogModule.category.model', 'Шаблон' ),
            'meta_title'        => Yii::t( 'CatalogModule.category.model', 'META заголовок' ),
            'meta_keywords'     => Yii::t( 'CatalogModule.category.model', 'META ключевые слова' ),
            'meta_description'  => Yii::t( 'CatalogModule.category.model', 'META описание' ),
            'sort'              => Yii::t( 'CatalogModule.category.model', 'Сортировка' ),
            'active'            => Yii::t( 'CatalogModule.category.model', 'Активна' ),
            'search'            => Yii::t( 'CatalogModule.category.model', 'Доступна для поиска' ),
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     * @param bool $merge
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search( $merge = true )
    {
        $criteria = new CDbCriteria();
        $criteria->alias = 'category';

        if ($merge) {
            $criteria->mergeWith( $this->getDbCriteria() );
        }

        $criteria->compare( 'category.id', $this->id );
        $criteria->compare( 'category.hash', $this->hash );
        $criteria->compare( 'category.create_date', $this->create_date, true );
        $criteria->compare( 'category.update_date', $this->update_date, true );
        $criteria->compare( 'category.root_id', $this->root_id );
        $criteria->compare( 'category.parent_id', $this->parent_id );
        $criteria->compare( 'category.author_id', $this->author_id );
        $criteria->compare( 'category.level', $this->level );
        $criteria->compare( 'category.name', $this->name );
        $criteria->compare( 'category.title', $this->title, true );
        $criteria->compare( 'category.short_description', $this->short_description, true );
        $criteria->compare( 'category.full_description', $this->full_description, true );

        return new CActiveDataProvider($this, array(
            'criteria'   => $criteria,
            'pagination' => array(
                'pageVar' => 'page',
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CatalogCategory the static model class
     */
    public static function model( $className = __CLASS__ )
    {
        return parent::model( $className );
    }

    public function getUrl()
    {
        return Yii::app()->createUrl( "catalog/category/view", array( 'id' => $this->id ) );
    }

    /**
     * Получение ID потомков
     * @return array
     */
    public function getChildrensId()
    {
        $cr = $this->descendants()->getDbCriteria();
        $cr->select = 'id';

        $this->setDbCriteria( new CDbCriteria() );

        $cb = Yii::app()->db->getCommandBuilder();
        $cb = $cb->createFindCommand( $this->tableName(), $cr );

        return array_map(
            function ( $v ) {
                return $v[ 'id' ];
            },
            $cb->queryAll()
        );
    }

    /**
     * Получить кол-во всех элементов категории и всех категорий потомков
     * @param bool $criteria
     * @return string
     */
    public function getCountAllElements( $criteria = false )
    {
        return $this->getAllElements( $criteria )->count();
    }

    /**
     * Получить всех элементов категории и всех категорий потомков
     * @param bool $criteria
     * @return CatalogElement
     */
    public function getAllElements( $criteria = false )
    {
        if (!$criteria) {
            $criteria = new CDbCriteria();
        }
        $criteria->addInCondition(
            "category_id",
            array_merge( $this->getChildrensId(), array( $this->id ) )
        );
        // Данная конструкция нужна для инициализации behaviors
        $model = new CatalogElement('insert', array( 'category_id' => $this->id ));
        $model->getDbCriteria()->mergeWith( $criteria );
        return $model;
    }

    /**
     * Получение пути шаблонов,
     * поиск осуществляется в категории и категориях предках
     * @return null|string
     */
    public function getTplPath()
    {
        $path = $this->tpl_path;
        if (!$path && $this->tpl_inherit && ($parent = $this->ancestors()->find( 'tpl_path IS NOT NULL' ))) {
            $path = $parent->tpl_path;
        }
        return $path ? trim( $path, '/' ) : null;
    }

    /**
     * Получение пути к шаблону,
     * поиск осуществляется в категории и категориях предках
     * @return null|string
     */
    public function getTplViewPath()
    {
        $path = $this->getTplPath();
        $view = $this->tpl_view;

        if (!$view && $this->tpl_inherit && ($parent = $this->ancestors()->find( 'tpl_view IS NOT NULL' ))) {
            $view = $parent->tpl_view;
        }
        return $view ? trim( $path . '/' . $view, '/' ) : null;
    }

    /**
     * Поведения модели
     * 1) Деревья Nested Sets
     * @return array
     */
    public function behaviors()
    {
        $result = CMap::mergeArray(
            parent::behaviors(),
            array(
                'NestedSetBehavior' => array(
                    'class'          => 'application.modules.catalog.behaviors.nestedset.NestedSetBehavior',
                    'rootAttribute'  => 'root_id',
                    'leftAttribute'  => 'left_id',
                    'rightAttribute' => 'right_id',
                    'hasManyRoots'   => true,
                ),
                'ImageBehavior'     => array(
                    'class'     => 'ext.imageBehavior.imageBehavior',
                    'filePath'  => 'webroot.uploads.catalog.category',
                    'fileField' => 'image',
                ),
            )
        );


        if (is_array( $behaviors = CatalogComponent::config( 'category.behaviors' ) )) {
            $result = CMap::mergeArray( $result, $behaviors );
        }
        return $result;
    }

    public function beforeSave()
    {
        if (!$this->author_id && Yii::app()->hasComponent( 'user' )) {
            $this->author_id = Yii::app()->user->id;
        }

        if (!$this->name) {
            $this->name = strtolower( Transliteration::url( $this->title ) );
        }

        if (!$this->isRoot() && ($parent = $this->parent()->find())) {
            $this->parent_id = $parent->id;
        } else {
            $this->parent_id = 0;
        }
        return parent::beforeSave();
    }
}
