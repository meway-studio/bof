<?php
/* @var $this OrderController */
/* @var $model CatalogOrder */

$this->breadcrumbs = array(
    'Заказы' => array( 'index' ),
    "Редактирование заказа #{$model->id}",
);

$this->menu = array(
    array( 'label' => 'Управление заказами', 'url' => array( 'admin' ) ),
    array(
        'label'       => 'Удалить заказ',
        'url'         => '#',
        'linkOptions' => array(
            'submit'  => array( 'delete', 'id' => $model->id ),
            'confirm' => 'Вы уверены что хотите удалить этот заказ?'
        )
    ),
);
?>

    <h1>Редактирование заказа #<?php echo $model->id; ?></h1>
<?php $this->renderPartial( '_form', array( 'model' => $model ) ); ?>