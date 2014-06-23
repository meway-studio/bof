<?php
/* @var $this EntityController */
/* @var $model EavEntity */

$this->breadcrumbs=array(
	'Eav Entities'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List EavEntity', 'url'=>array('index')),
	array('label'=>'Create EavEntity', 'url'=>array('create')),
	array('label'=>'View EavEntity', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage EavEntity', 'url'=>array('admin')),
);
?>

<h1>Update EavEntity <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>