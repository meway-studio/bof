<?php
Yii::import( 'application.modules.eav.models.*' );

class EavBehavior extends CModelBehavior
{
    const EAV_FORM = 'form';
    const EAV_MODEL = 'model';
    protected $eav_entity = null;
    protected $eav_attributes = array();
    protected $eav_translate_attributes = array();
    protected $eav_rules = array();
    protected $entity_type = null;

    public function getEntityType()
    {
        if ($this->entity_type) {
            return $this->entity_type;
        }
        return ($this->entity_type = $this->owner instanceof CActiveRecord ? self::EAV_MODEL : self::EAV_FORM);
    }

    public function checkEavEntity()
    {
        if ($this->eav_entity) {
            return true;
        }

        $owner = $this->owner;
        $entityName = get_class( $owner );
        $entityType = $this->getEntityType();

        if (0 === Yii::app()->cache->get( "check_eav_{$entityType}_{$entityName}" )) {
            return false;
        }
        return true;
    }

    public function getEavEntity()
    {
        if ($this->eav_entity) {
            return $this->eav_entity;
        }

        $owner = $this->owner;
        $entityName = get_class( $owner );
        $entityType = $this->getEntityType();

        /**
         * Ищем сущность
         * @var EavEntity $entity
         */
        if (!($entityType == self::EAV_FORM && !($owner instanceof EavFormModel))) {
            $this->eav_entity = EavEntity::model()->cache( 60 * 60 * 24 * 7 )->find(
                'type = :type AND name = :name',
                array(
                    ':type' => $entityType,
                    ':name' => $entityName
                )
            );
        }

        Yii::app()->cache->set(
            "check_eav_{$entityType}_{$entityName}",
            $this->eav_entity ? 1 : 0
        );

        return $this->eav_entity;
    }

    /**
     * Получение атрибутов
     * @return array|mixed
     */
    public function getEavAttributes()
    {
        /**
         * @var $entity EavEntity
         */
        if (!$this->eav_attributes && ($entity = $this->getEavEntity())) {
            $this->eav_attributes = $entity->cache( 60 * 60 * 24 * 7 )->eav_attributes;
        }
        return $this->eav_attributes;
    }

    /**
     * Получение атрибутов
     * @return array|mixed
     */
    public function getEavTranslateAttributes()
    {

        $owner = $this->owner;
        $entityName = get_class( $owner );
        $entityType = $this->getEntityType();
        $currentLanguage = Yii::app()->language;
        $cacheId = "eav_translate_attributes_{$entityType}_{$entityName}_{$currentLanguage}";

        if ($cacheData = Yii::app()->cache->get( $cacheId )) {
            return ($this->eav_translate_attributes = $cacheData);
        }

        if (!is_array( $languages = EavComponent::config( 'translate.languages' ) )
            || !in_array( Yii::app()->language, $languages )
        ) {
            return array();
        }

        if (is_array( $languages ) && is_array( $entities = EavComponent::config( 'entities' ) )) {
            if (!empty($entities[ $entityType ])
                && !empty($entities[ $entityType ][ $entityName ])
                && !empty($entities[ $entityType ][ $entityName ][ 'translate' ])
            ) {
                $translateAttributes = $entities[ $entityType ][ $entityName ][ 'translate' ];
                if (!is_array( $translateAttributes ) && $translateAttributes === '*') {
                    $translateAttributes = array_keys($owner->attributes);
                }
                foreach ($translateAttributes as $translateAttribute) {
                    $this->eav_translate_attributes[ $translateAttribute ] = implode(
                        '_',
                        array(
                            $translateAttribute,
                            $currentLanguage
                        )
                    );
                }
            }
        }

        Yii::app()->cache->set( $cacheId, $this->eav_translate_attributes, 60 * 60 * 24 * 7 );
        return $this->eav_translate_attributes;
    }

    /**
     * Получение атрибутов
     * @return array|mixed
     */
    public function getEavRules()
    {
        /**
         * @var $entity EavEntity
         * @var $attribute EavAttribute
         */

        $result = array();
        $entity = $this->getEavEntity();
        $attributes = $this->getEavAttributes();

        foreach ($attributes as $attribute) {

            $rules = EavRules::model()->cache( 60 * 60 * 24 * 7 )->findAll(
                'entity_id = :entity_id AND attribute_id = :attribute_id',
                array(
                    ':entity_id'    => $entity->id,
                    ':attribute_id' => $attribute->id,
                )
            );

            /**
             * @var $rule EavRules
             */
            foreach ($rules as $rule) {

                // Формируем общий массив
                if (empty($result[ $rule->name ])) {
                    $result[ $rule->name ] = array(
                        'attributes' => array(),
                        'params'     => array(),
                    );
                }

                // Формируется массив атрибутов
                if (empty($result[ $rule->name ][ 'attributes' ])) {
                    $result[ $rule->name ][ 'attributes' ] = $attribute->name;
                } else {
                    $attrs = explode( ',', $result[ $rule->name ][ 'attributes' ] );
                    if (!in_array( $attribute->name, $attrs )) {
                        $result[ $rule->name ][ 'attributes' ] .= ",{$attribute->name}";
                    }
                }

                // Формируем массив параметров
                if (empty($result[ $rule->name ][ 'params' ])) {
                    $result[ $rule->name ][ 'params' ] = array();
                }
                $result[ $rule->name ][ 'params' ][ $rule->param ] = $rule->value;
            }
        }

        return $result;
    }

    /**
     * @param $owner CActiveRecord|EavFormModel
     */
    public function attach( $owner )
    {
        parent::attach( $owner );

        if (!$this->checkEavEntity()) {
            return;
        }

        foreach ($this->getEavAttributes() as $a) {
            switch ($this->getEntityType()) {
                case self::EAV_MODEL:
                    $owner->getMetaData()->columns[ $a->name ] = true;
                    break;
                case self::EAV_FORM:
                    $owner->addEavAttribute( $a->name );
                    break;
            }
            $owner->getValidatorList()->add( CValidator::createValidator( 'safe', $owner, $a->name ) );
        }

        foreach ($this->getEavTranslateAttributes() as $name => $nameTranslate) {
            $originName = $name . '_origin';
            $owner->getValidatorList()->add( CValidator::createValidator( 'safe', $owner, $originName ) );

            switch ($this->getEntityType()) {
                case self::EAV_MODEL:
                    $owner->getMetaData()->columns[ $originName ] = true;
                    break;
                case self::EAV_FORM:
                    $owner->addEavAttribute( $originName, $owner->$name );
                    break;
            }
        }

        foreach ($this->getEavRules() as $name => $rule) {
            $validator = CValidator::createValidator(
                $name,
                $owner,
                $rule[ 'attributes' ],
                $rule[ 'params' ]
            );
            $owner->getValidatorList()->add( $validator );
        }
    }
}