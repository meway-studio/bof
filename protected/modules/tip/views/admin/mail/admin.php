<?php
/* @var $this MailController */
/* @var $model MailTask */

$this->breadcrumbs=array(
	Yii::t('tips', 'Рассылка')=>array('admin'),
	Yii::t('tips', 'Управление'),
);

$this->menu=array(
	array('label'=>Yii::t('tips', 'Добавить рассылку'), 'url'=>array('create')),
);

?>

<h3><?php echo Yii::t('tips', 'Управление рассылкой'); ?></h3>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'mail-task-grid',
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
			'name'    => 'type',
			'filter'  => $model->typeList,
			'value'   => '$data->typeName',
		),
		array(
			'name'    => 'create_date',
			'value'   => '$data->formatCreateDate',
		),
		array(
			'name'    => 'update_date',
			'value'   => '$data->formatUpdateDate',
		),
		'subject',
		'all',
		'success',
		'errors',
		array(
			'class'    => 'bootstrap.widgets.TbButtonColumn',
			'template' => '{update} {delete}',
		),
	),
)); ?>
