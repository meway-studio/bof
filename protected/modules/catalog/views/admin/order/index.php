<?php
/* @var $this OrderController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Catalog Orders',
);

$this->menu=array(
	array('label'=>'Создать заказ', 'url'=>array('create')),
	array('label'=>'Управление заказами', 'url'=>array('admin')),
);
?>

<h1>Catalog Orders</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
