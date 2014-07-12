<?php
$this->breadcrumbs=array(
	'Banners',
);

$this->menu=array(
	array('label'=>'Create Banner','url'=>array('create')),
	array('label'=>'Manage Banner','url'=>array('admin')),
);
?>

<h1>Banners</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
