<?php

class CatalogComponent extends CApplicationComponent
{
    const CLEAN = 'CLEAN';
    public $config = array();
    public static $_config = array();
    protected $defaultConfig = array(
        'catalog'  => array(
            'admin'   => array(
                'viewDir' => null,
            ),
            'viewDir' => null,
        ),
        'category' => array(),
        'element'  => array(),
        'import'   => array(
            '1c' => array(
                'filename' => 'import1c.xml',
                'password' => 'test',
                'ip'       => '127.0.0.1',
            ),
        ),
    );

    public function init()
    {
        if (!$this->getIsInitialized()) {
            $this->config = CMap::mergeArray( $this->defaultConfig, $this->config );
            self::$_config = & $this->config;

            $menuItems = array();
            if (CatalogComponent::config( 'orders.show' )) {
                $menuItems[ ] = array(
                    'label' => 'Заказы',
                    'url'   => Yii::app()->createUrl( 'catalog/admin/order' )
                );
            }

            Yii::app()->setModules( array( 'catalog' ) );
        }
        parent::init();
    }

    public static function config( $path = '', $data = 'NULL' )
    {
        $paths = explode( '.', $path );

        $config = & self::$_config;
        foreach ($paths as $p) {
            if (is_array( $config ) && array_key_exists( $p, $config )) {
                $config = & $config[ $p ];
                continue;
            }
            return null;
        }

        if ($data !== 'NULL') {
            $config = $data;
        }
        return $config;
    }

    public static function catalogViewDir( $catalogName = null, $admin = false )
    {
        $admin = $admin ? '.admin' : '';
        if ($catalogName && ($catalogViewDir = self::config( "catalog{$admin}.for.{$catalogName}.viewDir" ))) {
            self::config( "catalog{$admin}.viewDir", $catalogViewDir );
        }
        return self::config( "catalog{$admin}.viewDir" );
    }
}