<?php
/* @var $this EntityController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Eav Entities',
);

$this->menu=array(
	array('label'=>'Create EavEntity', 'url'=>array('create')),
	array('label'=>'Manage EavEntity', 'url'=>array('admin')),
);
?>

<h1>Eav Entities</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
