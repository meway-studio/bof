<?php
/* @var $this EntityController */
/* @var $model EavEntity */

$this->breadcrumbs=array(
	'Eav Entities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List EavEntity', 'url'=>array('index')),
	array('label'=>'Manage EavEntity', 'url'=>array('admin')),
);
?>

<h1>Create EavEntity</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>