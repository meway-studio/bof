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

    /**
     * @param $col
     * @param $bool
     * @return $this
     */
    public function booleanScope( $col, $bool )
    {
        $cr = new CDbCriteria();
        $cr->compare( $col, (int)$bool );
        $this->dbCriteria->mergeWith( $cr );
        return $this;
    }

    /**
     * @param bool $active
     * @return $this
     */
    public function active( $active = true )
    {
        return $this->booleanScope( 'active', $active );
    }

    /**
     * @param string $direction
     * @return $this
     */
    public function sort( $direction = self::SORT_ASC )
    {
        $this->dbCriteria->mergeWith(
            new CDbCriteria(array(
                'order' => "sort {$direction}"
            ))
        );
        return $this;
    }
}
