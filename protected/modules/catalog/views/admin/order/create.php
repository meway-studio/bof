<?php
/* @var $this OrderController */
/* @var $model CatalogOrder */

$this->breadcrumbs = array(
    'Заказы' => array( 'admin' ),
    'Создание заказа',
);

$this->menu = array(
    array( 'label' => 'Управление заказами', 'url' => array( 'admin' ) ),
);
?>

    <h1>Создание зазаказа</h1>

<?php $this->renderPartial( '_form', array( 'model' => $model ) ); ?>