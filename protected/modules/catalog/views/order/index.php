<?php
$this->breadcrumbs=array(
	'Catalog Orders',
);

$this->menu=array(
	array('label'=>'Create CatalogOrder','url'=>array('create')),
	array('label'=>'Manage CatalogOrder','url'=>array('admin')),
);
?>

<h1>Catalog Orders</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
