<?php
/* @var $this EntityController */
/* @var $model EavEntity */

$this->breadcrumbs=array(
	'Eav Entities'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List EavEntity', 'url'=>array('index')),
	array('label'=>'Create EavEntity', 'url'=>array('create')),
	array('label'=>'Update EavEntity', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete EavEntity', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage EavEntity', 'url'=>array('admin')),
);
?>

<h1>View EavEntity #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'create_date',
		'update_date',
		'type',
		'name',
		'optimize',
	),
)); ?>
