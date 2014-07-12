<?php
$this->breadcrumbs=array(
	'Catalog Orders'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CatalogOrder','url'=>array('index')),
	array('label'=>'Create CatalogOrder','url'=>array('create')),
	array('label'=>'Update CatalogOrder','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete CatalogOrder','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CatalogOrder','url'=>array('admin')),
);
?>

<h1>View CatalogOrder #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'create_date',
		'update_date',
		'user_name',
		'user_email',
		'user_address',
		'user_phone',
		'comment',
		'delivery',
		'status',
	),
)); ?>
