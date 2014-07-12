<?php

/**
 * Accepts request from 1C
 */
class From1cController extends CController
{
    protected $xml = null;

    public function init()
    {
        set_time_limit( 0 );

        // Отключаем логирование
        if (Yii::app()->hasComponent( 'log' )) {
            foreach (Yii::app()->log->routes as $route) {
                $route->enabled = false;
            }
        }
        parent::init();
    }

    /**
     * Initialize catalog.
     */
    public function actionInit()
    {
        $fileSize = (int)(ini_get( 'upload_max_filesize' )) * 1024 * 1024;
        echo "zip=no\n";
        echo "filelimit={$fileSize}\n";
    }

    /**
     * Загрузка потока в фаил
     */
    public function actionPhpinput()
    {
        $this->checkAction();

        $input = file_get_contents( 'php://input' );
        $fileName = Yii::app()->request->getQuery( 'filename', CatalogComponent::config( 'import.1c.filename' ) );
        $result = file_put_contents( $this->buildPathToTempFile( $fileName ), $input );

        if ($result !== false) {
            echo "success\n";
        }
    }

    public function actionStart()
    {
        $this->checkAction();

        if (!($catalogIdName = Yii::app()->request->getQuery( 'catalog', false ))) {
            exit('ERR_WRONG_CATALOG_PARAM');
        }

        $catalog = null;

        if (preg_match( '/^\d+$/', $catalogIdName )) {
            $catalog = CatalogCategory::model()->roots()->findByPk( $catalogIdName );
        } else {
            $catalog = CatalogCategory::model()->roots()->findByAttributes( array( 'name' => $catalogIdName ) );
        }

        if (!$catalog) {
            exit('ERR_WRONG_CATALOG');
        }

        $fileName = Yii::app()->request->getQuery( 'filename', CatalogComponent::config( 'import.1c.filename' ) );
        if (!($this->xml = $this->getXml( $fileName ))) {
            exit('ERR_WRONG_XML_DATA');
        }

        // Импорт категорий
        if (isset($this->xml->{"Классификатор"}->{"Группы"})) {
            $this->importCategories( $this->xml->{"Классификатор"}->{"Группы"}, $catalog );
        }

        // Импорт элементов каталога
        if (isset($this->xml->{"Каталог"}->{"Товары"})) {
            $this->importElements();
        }

        // Import properties
        /*if(isset($this->xml->{"Классификатор"}->{"Свойства"}))
            $this->importProperties();*/

        // Import prices
        /*if(isset($this->xml->{"ПакетПредложений"}->{"Предложения"}))
            $this->importPrices();*/

        echo "success\n";

        Yii::app()->end();
    }

    /**
     * @param $data
     * @param null|StoreCategory $parent
     */
    protected function importCategories( $data = null, $parent = null )
    {
        if (!$data || !$parent) {
            return;
        }

        foreach ($data->{"Группа"} as $group) {
            /**
             * @var $model CatalogCategory|NestedSetBehavior
             */
            $category = CatalogCategory::model()->findByAttributes( array( 'hash' => $group->{"Ид"} ) );

            if (!$category) {
                $category = new CatalogCategory();
                $category->hash = $group->{"Ид"};
                $category->title = $group->{"Наименование"};
                $category->appendTo( $parent );
                $category->saveNode();
            }

            // Обрабатываем подкатегории
            if (isset($group->{"Группы"})) {
                $this->importCategories( $group->{"Группы"}, $category );
            }
        }
    }

    /**
     * Import catalog products
     */
    public function importElements()
    {
        foreach ($this->xml->{"Каталог"}->{"Товары"}->{"Товар"} as $product) {

            $element = CatalogElement::model()->findByAttributes( array( 'hash' => $product->{"Ид"} ) );

            if (!$element) {
                $categoriesHashes = $product->{"Группы"}->{"Ид"};
                $categoryHash = null;

                if (is_array( $categoriesHashes ) && count( $categoriesHashes )) {
                    $categoryHash = $categoriesHashes[ key( $categoriesHashes ) ];
                } else {
                    $categoryHash = $product->{"Группы"}->{"Ид"};
                }

                $categoryHash = preg_replace( array( '/^\s+/', '/\s+$/' ), array( '', '' ), $categoryHash );
                if (!$categoryHash || $categoryHash == '') {
                    continue;
                };

                $cr = new CDbCriteria();
                $cr->select = 'id';
                $cr->compare( 'hash', $categoryHash );

                $cb = Yii::app()->db->getCommandBuilder();
                $category = $cb->createFindCommand( CatalogCategory::model()->tableName(), $cr )->queryRow();

                if (!$category || empty($category[ 'id' ])) {
                    continue;
                }

                $element = new CatalogElement();
                $element->hash = $product->{"Ид"};
                $element->category_id = $category[ 'id' ];
            }

            $element->title = $product->{"Наименование"};
            $element->article = $product->{"Артикул"};
            $element->save();

            // Process properties
            /*if(isset($product->{"ЗначенияСвойств"}->{"ЗначенияСвойства"}))
            {
                $attrsdata=array();
                foreach($product->{"ЗначенияСвойств"}->{"ЗначенияСвойства"} as $attribute)
                {
                    $attributeModel=C1ExternalFinder::getObject(C1ExternalFinder::OBJECT_TYPE_ATTRIBUTE, $attribute->{"Ид"});
                    if($attributeModel && $attribute->{"Значение"} != '')
                    {
                        $cr = new CDbCriteria;
                        $cr->with = 'option_translate';
                        $cr->compare('option_translate.value', $attribute->{"Значение"});
                        $option = StoreAttributeOption::model()->find($cr);

                        if(!$option)
                            $option = $this->addOptionToAttribute($attributeModel->id, $attribute->{"Значение"});
                        $attrsdata[$attributeModel->name]=$option->id;
                    }
                }

                if(!empty($attrsdata))
                {
                    $model->setEavAttributes($attrsdata, true);
                }
            }*/
        }
    }

    /**
     * Import catalog prices
     */
    protected function importPrices()
    {
        /**
         * @var $product CatalogElement
         */
        foreach ($this->xml->{"ПакетПредложений"}->{"Предложения"}->{"Предложение"} as $offer) {
            $product = C1ExternalFinder::getObject( C1ExternalFinder::OBJECT_TYPE_PRODUCT, $offer->{"Ид"} );

            if ($product) {
                $product->price = $offer->{"Цены"}->{"Цена"}->{"ЦенаЗаЕдиницу"};
                $product->quantity = $offer->{"Количество"};
                $product->save( false );
            }
        }
    }

    /**
     * Import product properties
     */
    protected function importAttributes()
    {
        foreach ($this->xml->{"Классификатор"}->{"Свойства"}->{"Свойство"} as $attribute) {
            $model = C1ExternalFinder::getObject( C1ExternalFinder::OBJECT_TYPE_ATTRIBUTE, $attribute->{"Ид"} );

            if ($attribute->{"ЭтоФильтр"} == 'false') {
                $useInFilter = false;
            } else {
                $useInFilter = true;
            }

            if (!$model) {
                // Create new attribute
                $model = new StoreAttribute;
                $model->name = SlugHelper::run( $attribute->{"Наименование"} );
                $model->name = str_replace( '-', '_', $model->name );
                $model->title = $attribute->{"Наименование"};
                $model->type = StoreAttribute::TYPE_DROPDOWN;
                $model->use_in_filter = $useInFilter;
                $model->display_on_front = true;

                if ($model->save()) {
                    // Add to type
                    $typeAttribute = new StoreTypeAttribute;
                    $typeAttribute->type_id = self::DEFAULT_TYPE;
                    $typeAttribute->attribute_id = $model->id;
                    $typeAttribute->save();

                    $this->createExternalId( C1ExternalFinder::OBJECT_TYPE_ATTRIBUTE, $model->id, $attribute->{"Ид"} );
                }
            }

            // Update attributes
            $model->name = SlugHelper::run( $attribute->{"Наименование"} );
            $model->use_in_filter = $useInFilter;
            $model->save();
        }
    }

    protected function checkAction()
    {
        $request = Yii::app()->request;

        if ($request->getQuery( 'password' ) != CatalogComponent::config( 'import.1c.password' )) {
            exit('ERR_WRONG_PASS');
        }

        if ($request->userHostAddress != CatalogComponent::config( 'import.1c.ip' )) {
            exit('ERR_WRONG_IP');
        }
    }

    /**
     * parse xml file from temp dir.
     * @param $xmlFileName
     * @return bool|object
     */
    protected function getXml( $xmlFileName )
    {
        $fullPath = $this->buildPathToTempFile( $xmlFileName );

        if (file_exists( $fullPath ) && is_file( $fullPath )) {
            return simplexml_load_file( $fullPath );
        } else {
            return false;
        }
    }

    /**
     * Builds path to 1C downloaded files. E.g: we receive
     * file with name 'import/df3/fl1.jpg' and build path to temp dir,
     * protected/runtime/fl1.jpg
     * @param $fileName
     * @return string
     */
    protected function buildPathToTempFile( $fileName )
    {
        $fileName = end( explode( '/', $fileName ) );
        return Yii::getPathOfAlias( 'application.runtime' ) . DIRECTORY_SEPARATOR . $fileName;
    }
}
