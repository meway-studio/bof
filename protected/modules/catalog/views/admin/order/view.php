<?php
/* @var $this OrderController */
/* @var $model CatalogOrder */

$this->breadcrumbs = array(
    'Catalog Orders' => array( 'index' ),
    $model->id,
);

$this->menu = array(
    array( 'label' => 'Заказы', 'url' => array( 'index' ) ),
    array( 'label' => 'Создать заказ', 'url' => array( 'create' ) ),
    array( 'label' => 'Редактировать заказ', 'url' => array( 'update', 'id' => $model->id ) ),
    array(
        'label'       => 'Delete CatalogOrder',
        'url'         => '#',
        'linkOptions' => array(
            'submit'  => array( 'delete', 'id' => $model->id ),
            'confirm' => 'Are you sure you want to delete this item?'
        )
    ),
    array( 'label' => 'Manage CatalogOrder', 'url' => array( 'admin' ) ),
);
?>

<h1>View CatalogOrder #<?php echo $model->id; ?></h1>

<?php

$this->renderPartial( '_form', array( 'model' => $model ) );

$orderElement = new CatalogOrderElement();
$orderElement->order_id = $model->id;

$this->widget(
    'bootstrap.widgets.TbGridView',
    array(
        'id'           => 'catalog-element-grid',
        'dataProvider' => $orderElement->search(),
        'filter'       => $orderElement,
        'columns'      => array(
            array(
                'name'        => 'id',
                'value'       => '$data->id',
                'htmlOptions' => array( 'style' => 'width:25px;' ),
            ),
            'create_date',
            array(
                'header' => 'Наименование',
                'name'   => 'element.title',
                'value'  => '$data->element->title',
            ),
            'quantity',
            array(
                'class'   => 'bootstrap.widgets.TbButtonColumn',
                'buttons' => array(
                    'view'   => array(
                        'url' => '$data->getUrl()',
                    ),
                    'update' => array(
                        'url' => 'Yii::app()->createUrl("catalog/admin/element/update", array("id"=>$data->id))',
                    ),
                    'delete' => array(
                        'url' => 'Yii::app()->createUrl("catalog/admin/element/delete", array("id"=>$data->id))',
                    ),
                ),
            ),
        ),
    )
); ?>
