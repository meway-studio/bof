<?php

/**
 * This is the model class for table "{{catalog_element}}".
 * The followings are the available columns in table '{{catalog_element}}':
 * @property integer $id
 * @property integer $category_id
 * @property string $create_date
 * @property string $update_date
 * @property string $publish_date
 * @property integer $author_id
 * @property string $name
 * @property string $title
 * @property string $article
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
 * @property integer $views
 * @property integer $draft
 * @property integer $published
 * @property integer $active
 * @property CatalogCategory $category
 * @property CatalogCategory $catalog
 * @property User $author
 * @property string|null $tplPath;
 * @property string|null $tplViewPath;
 */
class CatalogElement extends CatalogAR
{
    public $author_search = null;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{catalog_element}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array( 'category_id, author_id, tpl_inherit, views, draft, published, active', 'numerical', 'integerOnly' => true ),
            array( 'title', 'required' ),
            array( 'name, tpl_path', 'length', 'max' => 100 ),
            array( 'hash, article', 'length', 'max' => 50 ),
            array( 'tpl_theme', 'length', 'max' => 20 ),
            array( 'tpl_layout, tpl_view', 'length', 'max' => 30 ),
            array( 'title, image, meta_title, meta_keywords, meta_description', 'length', 'max' => 255 ),
            array( 'hash, article, create_date, update_date, publish_date, short_description, full_description', 'safe' ),
            array( 'active, published', 'default', 'value' => 1 ),
            array( 'image', 'file', 'types' => 'jpg,png', 'allowEmpty' => true, 'safe' => false, 'on' => 'admin' ),
            array(
                'id, category_id, hash, create_date, update_date, publish_date, category_id, author_search, author_id, name, title, article, short_description, full_description',
                'safe',
                'on' => 'search'
            ),
        );
    }

    public function scopes()
    {
        return array(
            'draft'     => array(
                'condition' => 'draft = 1',
            ),
            'notDraft'     => array(
                'condition' => 'draft = 0',
            ),
            'published' => array(
                'condition' => 'published = 1',
            ),
            'active'    => array(
                'condition' => 'active = 1',
            ),
            'available' => array(
                'condition' => 'draft = 0 AND published = 1 AND active = 1',
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
            'category' => array(
                self::BELONGS_TO,
                'CatalogCategory',
                'category_id',
            ),
            'catalog'  => array(
                self::BELONGS_TO,
                'CatalogCategory',
                array( 'root_id' => 'id' ),
                'through' => 'category'
            ),
            'author'   => array(
                self::BELONGS_TO,
                'User',
                'author_id'
            ),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return CMap::mergeArray(
            array(
                'id'                => 'ID',
                'category_id'       => Yii::t( 'CatalogModule.element.model', 'ID категории' ),
                'hash'              => Yii::t( 'CatalogModule.element.model', 'Хэш' ),
                'create_date'       => Yii::t( 'CatalogModule.element.model', 'Дата создания' ),
                'update_date'       => Yii::t( 'CatalogModule.element.model', 'Дата обновления' ),
                'publish_date'      => Yii::t( 'CatalogModule.element.model', 'Дата публикации' ),
                'author_id'         => Yii::t( 'CatalogModule.element.model', 'Автор' ),
                'author_search'     => Yii::t( 'CatalogModule.element.model', 'Автор' ),
                'name'              => Yii::t( 'CatalogModule.element.model', 'Имя элемента' ),
                'title'             => Yii::t( 'CatalogModule.element.model', 'Заголовок' ),
                'article'           => Yii::t( 'CatalogModule.element.model', 'Артикул' ),
                'short_description' => Yii::t( 'CatalogModule.element.model', 'Краткое описание' ),
                'full_description'  => Yii::t( 'CatalogModule.element.model', 'Полное описание' ),
                'image'             => Yii::t( 'CatalogModule.element.model', 'Изображение' ),
                'tpl_inherit'       => Yii::t( 'CatalogModule.element.model', 'Наследовать дизайн от родителя' ),
                'tpl_theme'         => Yii::t( 'CatalogModule.element.model', 'Тема' ),
                'tpl_path'          => Yii::t( 'CatalogModule.element.model', 'Путь к шаблонам' ),
                'tpl_layout'        => Yii::t( 'CatalogModule.element.model', 'Макет' ),
                'tpl_view'          => Yii::t( 'CatalogModule.element.model', 'Шаблон' ),
                'meta_title'        => Yii::t( 'CatalogModule.element.model', 'META заголовок' ),
                'meta_keywords'     => Yii::t( 'CatalogModule.element.model', 'META ключевые слова' ),
                'meta_description'  => Yii::t( 'CatalogModule.element.model', 'META описание' ),
                'views'             => Yii::t( 'CatalogModule.element.model', 'Количество просмотров' ),
                'draft'             => Yii::t( 'CatalogModule.element.model', 'Черновик' ),
                'published'         => Yii::t( 'CatalogModule.element.model', 'Опубликовано' ),
                'active'            => Yii::t( 'CatalogModule.element.model', 'Активно' ),
            ),
            $this->attributeLabels
        );
    }

    public function addView()
    {
        $this->views = $this->views + 1;
        Yii::app()->db->createCommand()->update(
            $this->tableName(),
            array( 'views' => $this->views ),
            "id = :id",
            array( ':id' => $this->id )
        );
    }

    /**
     * Получение пути шаблонов,
     * поиск осуществляется в категории и категориях предках
     * @return null|string
     */
    public function getTplPath()
    {
        $path = $this->tpl_path;
        if (!$path && $this->tpl_inherit) {
            $path = $this->category->getTplPath();
        }
        return $path ? trim( $path, '/' ) : null;
    }

    /**
     * Получение пути к шаблону,
     * поиск осуществляется в категории и категориях предках
     * @param null $altView
     * @return null|string
     */
    public function getTplViewPath( $altView = null )
    {
        $path = $this->getTplPath();
        $view = $altView ? ($this->tpl_view ? $this->tpl_view : $altView) : null;
        return $view ? trim( $path . '/' . $view, '/' ) : null;
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
        /**
         * @var $categogy CatalogCategory|NestedSetBehavior
         */
        $criteria = new CDbCriteria();
        $criteria->alias = 'element';

        if ($merge) {
            $criteria->mergeWith( $this->getDbCriteria() );
        }

        $criteria->compare( 'element.id', $this->id );
        $criteria->compare( 'element.title', $this->hash );
        $criteria->compare( 'element.create_date', $this->create_date, true );
        $criteria->compare( 'element.update_date', $this->update_date, true );
        $criteria->compare( 'element.publish_date', $this->publish_date, true );
        $criteria->compare( 'element.name', $this->name );
        $criteria->compare( 'element.title', $this->title, true );
        $criteria->compare( 'element.article', $this->article, true );
        $criteria->compare( 'element.draft', $this->draft );
        $criteria->compare( 'element.published', $this->published );
        $criteria->compare( 'element.active', $this->active );


        $criteria->with = CMap::mergeArray( $criteria->with, array( 'author' ) );
        $authorSearch = explode( ' ', preg_replace( '/\s\s+/', '', $this->author_search ) );
        foreach ($authorSearch as $search) {
            $criteria->compare( 'author.firstname', $search, true );
            $criteria->compare( 'author.lastname', $search, true, 'OR' );
        }


        if ($this->category_id && ($category = $this->category)) {
            $categoriesId = array_merge( $category->getChildrensId(), array( $category->id ) );
            $criteria->compare( 'element.category_id', $categoriesId );
        }

        if ($this->author_id) {
            $criteria->compare( 'element.author_id', $this->author_id );
        }

        return new CActiveDataProvider($this, array(
            'criteria'   => $criteria,
            'pagination' => array(
                'pageVar' => 'page',
            ),
            'sort'       => array(
                'attributes' => CMap::mergeArray(
                        $this->searchSortAttributes,
                        array(
                            'author_search' => array(
                                'asc'  => 'author.firstname, author.lastname',
                                'desc' => 'author.firstname DESC, author.lastname DESC',
                            ),
                            '*',
                        )
                    ),
            ),
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CatalogElement the static model class
     */
    public static function model( $className = __CLASS__ )
    {
        /**
         * @var $model CatalogElement
         */
        return parent::model( $className );
    }

    public function init()
    {
        parent::init();
    }

    /**
     * Получаем URL товара
     * @param bool $full Получить полный путь
     * @return string
     */
    public function getUrl( $full = true )
    {
        return Yii::app()->createUrl( "catalog/element/view", array( 'id' => $this->id ) );
    }

    /**
     * Поведения модели
     * @return array
     */
    public function behaviors()
    {
        $result = CMap::mergeArray(
            parent::behaviors(),
            array(
                'ImageBehavior' => array(
                    'class'     => 'ext.imageBehavior.imageBehavior',
                    'filePath'  => 'webroot.uploads.catalog.element',
                    'fileField' => 'image',
                ),
            )

        );

        if (is_array( $behaviors = CatalogComponent::config( 'element.behaviors' ) )) {
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
        return parent::beforeSave();
    }
}
