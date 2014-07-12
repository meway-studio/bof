<?php

/**
 * Class CatalogEventsBehavior
 * @property CatalogElement|CatalogCategory $owner
 * @property boolean $isBehaviorCatalog
 */
class CatalogARBehavior extends CActiveRecordBehavior
{
    public $_isInit = false;
    public $_isCatalog = null;
    public $catalogs = array();
    public $attributes = array();
    public $relations = array();
    public $attributeLabels = array();

    /**
     * @param $owner CatalogCategory|CatalogElement
     * @param $criteria CDbCriteria|bool
     */
    public function init( &$owner, $criteria = false )
    {
        /**
         * Проверяем инициализировано ли поведение и то что это поведение
         * принадлежит обозначенному в настройках каталогу
         */
        if ($this->_isInit || !$this->isBehaviorCatalog) {
            return;
        }

        /**
         * Добавляем реляции и атрибуты поведения к родителю
         */
        if (count( $this->relations )) {
            foreach ($this->relations as $relationName => $relationData) {
                $relationConfig = array_shift( $relationData );
                $relationEntity = $relationConfig[ 1 ];
                $owner->metaData->addRelation( $relationName, $relationConfig );
                $relation = ($relation = $owner->$relationName) ? $relation : new $relationEntity;
                $this->relations[ $relationName ][ 'data' ] = $relation;
                /**
                 * Добавляем атрибуты реляции к атрибутам родителя
                 * добавляем стандартные правила валидации safe
                 */
                if (!empty($relationData[ 'attributes' ])
                    && is_array( $attributes = $relationData[ 'attributes' ] )
                ) {
                    foreach ($attributes as $attributeName) {
                        $safeValidator = CValidator::createValidator(
                            'safe',
                            $owner,
                            $attributeName
                        );
                        $owner->metaData->columns[ $attributeName ] = true;
                        $owner->validatorList->add( $safeValidator );
                        $owner->$attributeName = $relation->$attributeName;
                        $owner->searchSortAttributes[ $attributeName ] = array(
                            'asc'  => "{$relationName}.{$attributeName} ASC",
                            'desc' => "{$relationName}.{$attributeName} DESC",
                        );
                    }
                }
            }
        }

        /**
         * Добавляем атрибуты поведения к атрибутам родителя
         * добавляем стандартные правила валидации safe
         */
        if (count( $this->attributes )) {
            $withs = array();
            foreach ($this->attributes as $name => $value) {
                $owner->getMetaData()->columns[ $name ] = true;
                $owner->getValidatorList()->add( CValidator::createValidator( 'safe', $owner, $name ) );

                $valueData = explode( '.', $value );
                $attribute = array_pop( $valueData );
                $entity = $owner;


                if (count( $valueData )) {
                    $with = & $withs;
                    foreach ($valueData as $relation) {
                        $entity = $entity->$relation;

                        if (empty($with[ 'with' ])) {
                            $with[ 'with' ] = array();
                        }
                        if (empty($with[ 'with' ][ $relation ])) {
                            $with[ 'with' ][ $relation ] = array();
                        }
                        $with = & $with[ 'with' ][ $relation ];
                    }
                }

                if ($entity) {
                    $owner->setAttribute( $name, $entity->$attribute );
                }

                $attribute = (count( $valueData ) ? array_pop( $valueData ) . "." : '') . $attribute;
                $owner->searchSortAttributes[ $name ] = array(
                    'asc'  => "{$attribute} ASC",
                    'desc' => "{$attribute} DESC",
                );
            }

            if (count( $withs )) {
                $owner->dbCriteria->mergeWith(
                    new CDbCriteria($withs)
                );
            }
        }

        /**
         * Обьединяем критерии поиска
         */
        if ($criteria) {
            $owner->dbCriteria->mergeWith( $criteria );
        }

        /**
         * Устанавливаем описания для атрибутов
         */
        $owner->attributeLabels = CMap::mergeArray(
            $owner->attributeLabels,
            $this->attributeLabels()
        );

        // Устанавливаем флаг инициализации поведения
        $this->_isInit = true;
    }

    /**
     * @param CatalogElement $owner
     */
    public function attach( $owner )
    {
        parent::attach( $owner );
        $this->init( $owner );
    }

    public function beforeSave( $event )
    {
        $owner = $this->owner;
        if ($this->_isInit && $this->isBehaviorCatalog) {
            if (count( $this->relations )) {
                foreach ($this->relations as $relationName => $relationData) {
                    // Проверяем есть ли данные реляции
                    if (empty($this->relations[ $relationName ][ 'data' ])) {
                        continue;
                    }

                    $relation = $this->relations[ $relationName ][ 'data' ];

                    /**
                     * Присваевам реляционные атрибуты родителя к реляции
                     * Сохраняем данные реляции
                     * @var CActiveRecord $relation
                     */
                    if (!empty($relationData[ 'attributes' ])
                        && is_array( $attributes = $relationData[ 'attributes' ] )
                    ) {
                        foreach ($attributes as $attributeName) {
                            $relation->$attributeName = $owner->$attributeName;
                        }
                        if ($owner instanceof CatalogElement) {
                            $relation->element_id = $owner->id;
                        } else {
                            $relation->category_id = $owner->id;
                        }
                        if (!$relation->save()) {
                            $owner->addErrors( $relation->errors );
                            $event->isValid = false;
                        }
                    }
                }
            }
        }
        if ($owner->hasErrors()) {
            $event->isValid = false;
        }
        parent::beforeSave( $event );
    }

    public function beforeFind( $event )
    {
        $owner = $this->owner;
        $this->init( $owner );

        if ($this->getIsBehaviorCatalog()) {
            if (count( $this->relations )) {
                foreach ($this->relations as $relationName => $relationData) {
                    if (!empty($relationData[ 'attributes' ])
                        && is_array( $attributes = $relationData[ 'attributes' ] )
                    ) {
                        foreach ($attributes as $attributeName) {
                            if ($owner->$attributeName !== null) {
                                $owner->dbCriteria->compare(
                                    "{$relationName}.{$attributeName}",
                                    $owner->$attributeName
                                );
                            }
                        }
                    }
                }
            }
            if (count( $this->attributes )) {
                foreach ($this->attributes as $name => $value) {
                    if ($owner->$name !== null) {
                        if (count( $with = explode( '.', $value ) ) > 1) {
                            $attribute = array_pop( $with );
                            $relation = array_pop( $with );
                            $value = "{$relation}.{$attribute}";
                        }
                        $owner->dbCriteria->compare( $value, $owner->$name );
                    }
                }
            }
        }
        parent::beforeFind( $event );
    }

    public function getIsBehaviorCatalog()
    {
        if ($this->_isCatalog !== null) {
            return $this->_isCatalog;
        }

        if (!count( $this->catalogs )) {
            return ($this->_isCatalog = true);
        }

        $owner = $this->owner;

        if ($owner instanceof CatalogElement) {
            if ($owner->category_id && ($catalog = $owner->catalog) && in_array( $catalog->name, $this->catalogs )) {
                return ($this->_isCatalog = true);
            }
        } elseif ($owner instanceof CatalogCategory) {
            $catalog = $owner->isRoot() ? $owner : $owner->catalog;
            if (in_array( $catalog->name, $this->catalogs )) {
                return ($this->_isCatalog = true);
            }
        }

        return ($this->_isCatalog = false);
    }

    public function attributeLabels()
    {
        return array();
    }
}