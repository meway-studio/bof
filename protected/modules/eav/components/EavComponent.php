<?php

class EavComponent extends CApplicationComponent
{
    public $config = array();
    public static $_config = array();

    public function init()
    {
        if (!$this->getIsInitialized()) {
            self::$_config = &$this->config;

            Yii::app()->setModules( array( 'eav' ) );

            $configHash = md5( serialize( $this->config ) );
            $configCacheKey = 'eav_config_hash';
            $configCachedHash = Yii::app()->cache->get( $configCacheKey );

            if (!$configCachedHash || ($configCachedHash != $configHash)) {
                Yii::app()->cache->set( $configCacheKey, $configHash );
                Yii::app()->cache->delete( 'eav_translate_attributes' );
                $this->configure();
            }
        }
        parent::init();
    }

    public static function config( $path = '', $data = 'EAV_CONFIG_DATA_NULL' )
    {
        $paths = explode( '.', $path );
        $config = &self::$_config;

        foreach ($paths as $p) {
            if (is_array( $config ) && array_key_exists( $p, $config )) {
                $config = &$config[ $p ];
                continue;
            }
            return null;
        }

        if ($data !== 'EAV_CONFIG_DATA_NULL') {
            $config = $data;
        }
        return $config;
    }

    public function configure()
    {
        $languages = array();
        if (!empty($this->config[ 'translate' ])
            && !empty($this->config[ 'translate' ][ 'languages' ])
            && is_array( $this->config[ 'translate' ][ 'languages' ] )
        ) {
            $languages = $this->config[ 'translate' ][ 'languages' ];
        }

        if (!empty($this->config[ 'attributes' ]) && is_array( $this->config[ 'attributes' ] )) {
            foreach ($this->config[ 'attributes' ] as $name => $params) {
                $a = EavAttribute::model()->find( 'name = :name', array( ':name' => $name ) );

                if (!$a) {
                    $a = new EavAttribute();
                }

                if ($params === false && !$a->isNewRecord) {
                    $a->delete();
                    continue;
                }

                $a->name = $name;
                $a->label = isset($params[ 'label' ]) ? $params[ 'label' ] : $a->hint;
                $a->hint = isset($params[ 'hint' ]) ? $params[ 'hint' ] : $a->hint;
                $a->type = isset($params[ 'type' ]) ? $params[ 'type' ] : $a->type;
                $a->many = isset($params[ 'many' ]) ? $params[ 'many' ] : $a->many;
                $a->options = isset($params[ 'options' ]) ? $params[ 'options' ] : $a->options;
                $a->sort = isset($params[ 'sort' ]) ? $params[ 'sort' ] : 0;
                $a->save();
            }
        }

        if (!empty($this->config[ 'entities' ]) && is_array( $this->config[ 'entities' ] )) {
            foreach ($this->config[ 'entities' ] as $type => $entities) {
                foreach ($entities as $entity => $params) {
                    /**
                     * @var $e EavEntity
                     */
                    $e = EavEntity::model()->find(
                        'type = :type AND name = :name',
                        array(
                            ':type' => $type,
                            ':name' => $entity
                        )
                    );

                    if (!$e) {
                        $e = new EavEntity();
                    }

                    if ($params === false && !$e->isNewRecord) {
                        $e->delete();
                        continue;
                    }

                    $e->type = $type;
                    $e->name = $entity;
                    $e->optimize = isset($params[ 'sort' ]) ? $params[ 'sort' ] : $e->optimize;
                    $e->save();

                    if (!empty($params[ 'attributes' ]) && is_array( $params[ 'attributes' ] )) {
                        foreach ($params[ 'attributes' ] as $sort => $attribute) {
                            $a = EavAttribute::model()->find( 'name = :name', array( ':name' => $attribute ) );
                            if (!$a) {
                                continue;
                            }

                            /**
                             * @var $ea EavEntityAttribute
                             */
                            $ea = EavEntityAttribute::model()->find(
                                'entity_id = :entity_id AND attribute_id = :attribute_id',
                                array(
                                    ':entity_id'    => $e->id,
                                    ':attribute_id' => $a->id,
                                )
                            );

                            if (!$ea) {
                                $ea = new EavEntityAttribute();
                            }

                            $ea->entity_id = $e->id;
                            $ea->attribute_id = $a->id;
                            $ea->sort = $sort;
                            $ea->save();
                        }
                    }

                    if ($languages && !empty($params[ 'translate' ]) && is_array( $params[ 'translate' ] )) {
                        foreach ($params[ 'translate' ] as $attribute) {
                            foreach ($languages as $language) {
                                $translateAttribute = "{$attribute}_{$language}";
                                /**
                                 * @var $a EavAttribute
                                 */
                                $a = EavAttribute::model()->find( 'name = :name', array( ':name' => $translateAttribute ) );
                                if (!$a) {
                                    $a = new EavAttribute();
                                    $a->name = $translateAttribute;
                                    $a->label = $translateAttribute;
                                    $a->save();
                                }

                                /**
                                 * @var $ea EavEntityAttribute
                                 */
                                $ea = EavEntityAttribute::model()->find(
                                    'entity_id = :entity_id AND attribute_id = :attribute_id',
                                    array(
                                        ':entity_id'    => $e->id,
                                        ':attribute_id' => $a->id,
                                    )
                                );

                                if (!$ea) {
                                    $ea = new EavEntityAttribute();
                                }

                                $ea->entity_id = $e->id;
                                $ea->attribute_id = $a->id;
                                $ea->save();
                            }
                        }
                    }

                    if (!empty($params[ 'rules' ]) && is_array( $params[ 'rules' ] )) {
                        foreach ($params[ 'rules' ] as $rule) {

                            list($ruleAttributes, $name, $ruleParams) = $rule;

                            foreach ($ruleAttributes as $attribute) {
                                /**
                                 * @var $a EavAttribute
                                 */
                                $a = EavAttribute::model()->find( 'name = :name', array( ':name' => $attribute ) );
                                if (!$a) {
                                    continue;
                                }

                                foreach ($ruleParams as $param => $value) {
                                    /**
                                     * @var $r EavRules
                                     */
                                    $r = EavRules::model()->find(
                                        'entity_id = :entity_id AND attribute_id = :attribute_id AND name = :name AND param = :param',
                                        array(
                                            ':entity_id'    => $e->id,
                                            ':attribute_id' => $a->id,
                                            ':name'         => $name,
                                            ':param'        => $param,
                                        )
                                    );

                                    if (!$r) {
                                        $r = new EavRules();
                                    }

                                    if ($value === false && !$r->isNewRecord) {
                                        $r->delete();
                                        continue;
                                    }

                                    $r->entity_id = $e->id;
                                    $r->attribute_id = $a->id;
                                    $r->name = $name;
                                    $r->param = $param;
                                    $r->value = $value;
                                    $r->save();
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}