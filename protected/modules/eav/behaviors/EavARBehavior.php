<?php
Yii::import( 'application.modules.eav.behaviors.EavBehavior' );

/**
 * Class EavARBehavior
 * @property CActiveRecord $owner
 */
class EavARBehavior extends EavBehavior
{
    public function events()
    {
        return array_merge(
            parent::events(),
            array(
                'onBeforeSave'   => 'beforeSave',
                'onAfterSave'    => 'afterSave',
                'onBeforeDelete' => 'beforeDelete',
                'onAfterFind'    => 'afterFind',
            )
        );
    }

    /**
     * Получает или устанавливает значение атрибута
     * @param $attributeName
     * @param null $attributeValue
     * @param bool $delete
     * @return array|mixed|null
     * @throws ErrorException
     */
    public function eav( $attributeName, $attributeValue = null, $delete = false )
    {
        // ID элемента сущности
        $elementId = $this->owner instanceof CActiveRecord ? $this->owner->getPrimaryKey() : null;

        /**
         * Получаем сущность
         * @var $entity EavEntity
         */
        $entity = $this->getEavEntity();

        /**
         * Ищем атрибут
         * @var $attribute EavAttribute
         */
        $attribute = EavAttribute::model()->find( 'name = :name', array( ':name' => $attributeName ) );

        if (!$attribute) {
            throw new ErrorException("EAV Attribute name '{$attributeName}' not found in entity '{$entity->type}.{$entity->name}'!");
        }

        /**
         * Ищем значение
         * @var $value EavValue
         */
        $value = new EavValue();
        $criteria = new CDbCriteria();
        $criteria->condition = 'entity_id = :entity_id AND attribute_id = :attribute_id';
        $criteria->params = array(
            ':entity_id'    => $entity->id,
            ':attribute_id' => $attribute->id,
        );

        if ($elementId !== null) {
            $criteria->addCondition( 'element_id = :element_id' );
            $criteria->params = array_merge(
                $criteria->params,
                array( ':element_id' => $elementId )
            );
        }


        // Для множественных значений
        if ($attribute->many) {
            if ($attributeValue && !is_array( $attributeValue )) {
                $attributeValue = array( $attributeValue );
            }

            $result = array();
            $values = $value->findAll( $criteria );
            foreach ($values as $value) {
                // Удаляем старые значения атрибутов
                if ($delete || $attributeValue) {
                    $value->delete();
                    continue;
                }
                $result[ ] = $value->value;
            }

            // Устанавливаем новые значения атрибутов
            if (!$delete && $attributeValue) {
                foreach ($attributeValue as $v) {
                    $value = new EavValue();
                    $value->entity_id = $entity->id;
                    $value->attribute_id = $attribute->id;
                    $value->value = $v;
                    $value->element_id = $elementId;
                    $value->save();
                }
                $result = $attributeValue;
            }
            return $result;
        }

        // Получаем единичное значение
        if ($value = $value->find( $criteria )) {
            // Удаляем значение EAV атрибута
            if ($delete) {
                $value->delete();
                return null;
            }
            // Если есть значение атрибута то устанавливаем его и возвращаем
            if ($attributeValue) {
                $value->value = $attributeValue;
                $value->save();
            }
            return $value->value;
        }

        // Новое значение EAV атрибута
        if ($attributeValue !== null) {
            $value = new EavValue();
            $value->entity_id = $entity->id;
            $value->attribute_id = $attribute->id;
            $value->value = $attributeValue;
            $value->element_id = $elementId;
            $value->save();
        }

        return $attributeValue;
    }

    /**
     * Прилепляем EAV атрибуты к модели
     * @param CEvent $event
     */
    public function afterFind( $event )
    {
        if (!$this->checkEavEntity()) {
            return;
        }

        $owner = $this->owner;

        foreach ($this->getEavAttributes() as $a) {
            $owner->setAttribute( $a->name, $this->eav( $a->name ) );
        }

        foreach ($this->getEavTranslateAttributes() as $name => $nameTranslate) {
            $owner->setAttribute( $name . '_origin', $owner->$name );
            if ($value = $this->eav( $nameTranslate )) {
                $owner->setAttribute( $name, $value );
            }
        }
    }

    /**
     * Сохраняем значения языковых EAV атрибутов
     * @param CModelEvent $event
     */
    public function beforeSave( $event )
    {
        if (!$this->checkEavEntity()) {
            return;
        }

        $owner = $this->owner;

        foreach ($this->getEavTranslateAttributes() as $name => $nameTranslate) {
            $owner->setAttribute( $nameTranslate, $owner->getAttribute( $name ) );
            $owner->setAttribute( $name, $owner->getAttribute( $name . '_origin' ) );
        }
    }

    /**
     * Сохраняем значения EAV атрибутов
     * @param CModelEvent $event
     */
    public function afterSave( $event )
    {
        if (!$this->checkEavEntity()) {
            return;
        }

        $owner = $this->owner;

        foreach ($this->getEavAttributes() as $a) {
            $this->eav( $a->name, $this->owner->getAttribute( $a->name ) );
        }

        foreach ($this->getEavTranslateAttributes() as $name => $nameTranslate) {
            $owner->setAttribute( $name, $owner->getAttribute( $nameTranslate ) );
        }
    }

    /**
     * Сохраняем значения EAV атрибутов
     * @param CModelEvent $event
     */
    public function beforeDelete( $event )
    {
        if (!$this->checkEavEntity()) {
            return;
        }

        foreach ($this->getEavAttributes() as $a) {
            $this->eav( $a->name, null, true );
        }
    }
}