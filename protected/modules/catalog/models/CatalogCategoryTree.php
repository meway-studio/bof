<?php

/**
 * Present CatalogCategory as SJsTree node.
 */
class CatalogCategoryTree extends CComponent implements ArrayAccess
{
    /**
     * @var CatalogCategory
     */
    protected $model;
    /**
     * @var string category name
     */
    protected $_name;
    /**
     * @var integer category id
     */
    protected $_id;
    /**
     * @var boolean
     */
    protected $_hasChildren;
    /**
     * @var array category children
     */
    protected $_children;
    protected $options = array();

    /**
     * @param CatalogCategory $model
     * @param array $options
     */
    public function __construct( CatalogCategory $model, $options = array() )
    {
        $this->options =& $options;
        $this->model =& $model;
        return $this;
    }

    /**
     * Create nodes from array
     * @static
     * @param array $model
     * @param array $options
     * @return array
     */
    public static function fromArray( $model, $options = array() )
    {
        $result = array();
        foreach ($model as $row) {
            $result[ ] = new CatalogCategoryTree($row, $options);
        }
        return $result;
    }

    /**
     * @return bool
     */
    public function getHasChildren()
    {
        if (!empty($this->options[ 'current_category_id' ])) {
            if (in_array( $this->options[ 'current_category_id' ], array( $this->model->id, $this->model->parent_id ) )) {
                return true;
            }
            return (boolean)$this->model->descendants()->countByAttributes(
                array( 'id' => $this->options[ 'current_category_id' ] )
            );
        }
        return (boolean)$this->model->children()->count();
    }

    /**
     * @return array
     */
    public function getChildren()
    {
        return self::fromArray( $this->model->children()->findAll(), $this->options );
    }

    /**
     * @return string
     */
    public function getName()
    {
        if (isset($this->options[ 'displayCount' ]) && $this->options[ 'displayCount' ]) {
            return "{$this->model->title} ({$this->model->getCountAllElements()})";
        } else {
            return $this->model->title;
        }
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->model->getUrl();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->model->id;
    }

    /**
     * @param $offset
     * @return mixed
     */
    public function offsetGet( $offset )
    {
        return $this->{$offset};
    }

    public function offsetExists( $offset )
    {
    }

    public function offsetSet( $offset, $value )
    {
    }

    public function offsetUnset( $offset )
    {
    }
}
