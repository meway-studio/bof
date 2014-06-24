<?php
/**
 * NoBetTips class file.
 * @author egoss <dev@egoss.ru>
 */

Yii::import( 'application.modules.tip.models.*' );

class NoBetTips extends CWidget
{
    const ACTIVE_NULL = 0;
    const ACTIVE_TRUE = 1;
    const ACTIVE_FALSE = 2;
    const ACTIVE_SOON = 3;
    const ACTIVE_STAT = 5;
    public $tipster = null;
    public $active = null;
    public $items = null;
    public $limit = 3;
    public $offset = 0;
    public $view = 'active';
    public $inRunning = false;
    protected $model;

    public function init()
    {

        $this->offset = (int)$this->offset;

        $model = NbTips::model()->published()->with( 'tipster' );
        $model = $this->tipster ? $model->byTipster( $this->tipster ) : $model;

        SWITCH ($this->active) {
            CASE self::ACTIVE_STAT:
                $model = $model->onStatPage();
                break;
            CASE self::ACTIVE_TRUE:
                $model = $model->active();
                break;
            CASE self::ACTIVE_FALSE:
                $model = $model->last();
                break;
            CASE self::ACTIVE_SOON:
                $model = $model->soon();
                break;
        }



        $model = $model->inRunning($this->inRunning ? true : false);

        if ($this->offset > 0) {
            $model = $model->setOffset( $this->offset );
        }

        if ($this->items != null) {
            $this->model = $this->items;
        } else {
            $this->model = $model->findAll( array( 'limit' => $this->limit, 'order' => 't.event_date DESC' ) );
        }
    }

    public function run()
    {
        if ($this->model) {
            $this->render( $this->view, array( 'model' => $this->model, 'tipster' => $this->tipster ) );
        }
        //else
        //	echo 'No result found.';
    }
}