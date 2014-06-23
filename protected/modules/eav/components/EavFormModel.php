<?php

/**
 * Class EavFormModel
 */
class EavFormModel extends CFormModel
{
    private $eav_attributes = array();

    public function __get( $name )
    {
        try {
            return parent::__get( $name );
        } catch ( Exception $e ) {
            if ($this->hasEavAttribute( $name )) {
                return $this->eav_attributes[ $name ];
            }
            return parent::__get( $name );
        }
    }

    public function __set( $name, $value )
    {
        try {
            return parent::__set( $name, $value );
        } catch ( Exception $e ) {
            if ($this->hasEavAttribute( $name )) {
                return ($this->eav_attributes[ $name ] = $value);
            }
            return parent::__set( $name, $value );
        }
    }

    public function getAttributes($names=null)
    {
        $attributes = parent::getAttributes($names);
        return array_merge($attributes, $this->eav_attributes);
    }

    public function hasEavAttribute( $name )
    {
        return isset($this->eav_attributes[ $name ]);
    }

    public function addEavAttribute( $name, $value = null )
    {
        return ($this->eav_attributes[ $name ] = $value);
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            array(
                'EavFormBehavior' => array(
                    'class' => 'application.modules.eav.behaviors.EavFormBehavior',
                ),
            )
        );
    }
}