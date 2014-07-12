<?php
$this->breadcrumbs=array(
	'Catalog Orders'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CatalogOrder','url'=>array('index')),
	array('label'=>'Manage CatalogOrder','url'=>array('admin')),
);
?>

<h1>Create CatalogOrder</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>