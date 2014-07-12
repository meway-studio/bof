<?php
$this->breadcrumbs=array(
	'Catalog Orders'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CatalogOrder','url'=>array('index')),
	array('label'=>'Create CatalogOrder','url'=>array('create')),
	array('label'=>'View CatalogOrder','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage CatalogOrder','url'=>array('admin')),
);
?>

<h1>Update CatalogOrder <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>