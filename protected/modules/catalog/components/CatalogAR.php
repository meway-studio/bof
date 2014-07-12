<?php

class CatalogAR extends ActiveRecord
{
    public $searchSortAttributes = array();
    public $attributeLabels = array();

    public function __construct( $scenario = 'insert', $attributes = array() )
    {
        $this->getMetaData()->attributeDefaults = $attributes;
        parent::__construct( $scenario );
    }

    public function attributeLabels()
    {
        return CMap::mergeArray( parent::attributeLabels(), $this->attributeLabels );
    }
}
