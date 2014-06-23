<?php
/**
 * @author ElisDN <mail@elisdn.ru>
 * @link http://www.elisdn.ru
 */

/**
 * Class DConfig
 * @property $model Config
 */
class DConfig extends CApplicationComponent
{
    public $cache = 0;
    public $model = null;
    public $dependency = null;
    protected $data = array();

    public function init()
    {
        $this->model = Config::model()->cache( 60 * 60 * 24 * 7 );
        parent::init();
    }

    public function get( $key )
    {
        if (isset($this->data[ $key ])) {
            return $this->data[ $key ];
        }
        if ($config = $this->model->findByAttributes( array( 'param' => $key ) )) {
            return ($this->data[ $key ] = $config->value);
        }
        throw new CException(Yii::t( 'dconfig', 'Не определен параметр {key}', array( '{key}' => $key ) ));
    }

    public function has( $key )
    {
        if (isset($this->data[ $key ])) {
            return true;
        }
        return (bool)$this->model->countByAttributes( array( 'param' => $key ) );
    }

    public function set( $key, $value )
    {
        if (!($model = $this->model->findByAttributes( array( 'param' => $key ) ))) {
            throw new CException(Yii::t( 'dconfig', 'Не определен параметр {key}', array( '{key}' => $key ) ));
        }

        $model->value = $value;

        if ($model->save()) {
            $this->data[ $key ] = $value;
        }
    }

    public function add( $params )
    {
        if (is_array( $params )) {
            foreach ($params as $item) {
                $this->createParameter( $item );
            }
        } elseif ($params) {
            $this->createParameter( $params );
        }
    }

    public function delete( $key )
    {
        if (is_array( $key )) {
            foreach ($key as $item) {
                $this->removeParameter( $item );
            }
        } elseif ($key) {
            $this->removeParameter( $key );
        }
    }

    protected function createParameter( $param )
    {
        if (!empty($param[ 'param' ])) {
            if (!($model = $this->model->findByAttributes( array( 'param' => $param[ 'param' ] ) ))) {
                $model = new Config();
            }

            $model->param = $param[ 'param' ];
            $model->label = isset($param[ 'label' ]) ? $param[ 'label' ] : $param[ 'param' ];
            $model->value = isset($param[ 'value' ]) ? $param[ 'value' ] : '';
            $model->default = isset($param[ 'default' ]) ? $param[ 'default' ] : '';
            $model->type = isset($param[ 'type' ]) ? $param[ 'type' ] : 'string';
            $model->save();

            $this->data[ $model->param ] = $model->value === '' ? $model->default : $model->value;
        }
    }

    protected function removeParameter( $key )
    {
        if (!empty($key)) {
            if ($model = $this->model->findByAttributes( array( 'param' => $key ) )) {
                $model->delete();
            }
        }
    }
}