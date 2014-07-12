<?php
/* @var $this OrderController */
/* @var $model CatalogOrder */

$this->breadcrumbs = array(
    'Заказы',
);

Yii::app()->clientScript->registerScript(
    'search',
    "
   $('.search-button').click(function(){
       $('.search-form').toggle();
       return false;
   });
   $('.search-form form').submit(function(){
       $('#catalog-order-grid').yiiGridView('update', {
           data: $(this).serialize()
       });
       return false;
   });
   "
);
?>
<div class="row">
    <?php
    /**
     * @var CActiveDataProvider $dataProvider
     */
    $this->widget(
        'bootstrap.widgets.TbGridView',
        array(
            'id'              => 'catalog-orders-grid',
            'dataProvider'    => $model->eavSearch(),
            'filter'          => $model,
            'summaryCssClass' => '',
            'summaryText'     => '<p><h2>Управление заказами [ {start} - {end} из {count} ]</h2></p>',
            'columns'         => array(
                array(
                    'name'        => 'id',
                    'value'       => '$data->id',
                    'htmlOptions' => array( 'style' => 'width:50px;' ),
                ),
                array(
                    'name'        => 'create_date',
                    'value'       => '$data->create_date',
                    'htmlOptions' => array( 'style' => 'width:150px;' ),
                ),
                array(
                    'header' => 'Имя',
                    'name' => 'user_name',
                ),
                array(
                    'header' => 'E-mail',
                    'name' => 'user_email',
                ),
                array(
                    'header' => 'Адрес',
                    'name' => 'user_address',
                ),
                array(
                    'class'   => 'bootstrap.widgets.TbButtonColumn',
                    'buttons' => array(
                        'view'   => null,
                        'update' => array(
                            'url' => 'Yii::app()->createUrl("catalog/admin/order/update", array("id"=>$data->id))',
                        ),
                        'delete' => array(
                            'url' => 'Yii::app()->createUrl("catalog/admin/order/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            ),
        )
    ); ?>
</div>