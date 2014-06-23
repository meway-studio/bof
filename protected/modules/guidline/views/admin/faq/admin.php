<?php
$this->breadcrumbs=array(
	Yii::t('GuidlineContent', 'Категории FAQ')=>array('admin'),
	Yii::t('GuidlineContent', 'Управление'),
);

$this->menu=array(
	array('label'=>Yii::t('GuidlineContent', 'Создать категорию FAQ'),'url'=>array('create')),
);
?>

<h3><?php echo Yii::t('GuidlineContent', 'Управление категориями FAQ'); ?></h3>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'faq-category-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'   => 'id',
			'value'  => '$data->id',
			'htmlOptions'=>array('style'=>'width:25px;'),
		),
		array(
			'name'    => 'status',
			'filter'  => $model->statusList,
			'value'   => '$data->statusName',
		),
		array(
			'name'    => 'create_date',
			'value'   => '$data->formatCreateDate',
			'filter'  => false,
		),
		'sort',
		'title',
		array(
			'class'    => 'bootstrap.widgets.TbButtonColumn',
			'template' => '{update} {delete}',
		),
	),
)); ?>
