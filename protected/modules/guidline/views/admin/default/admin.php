<?php
$this->breadcrumbs=array(
	Yii::t('GuidlineContent', 'Гайдлайн сообщения')=>array('admin'),
);

?>

<h3><?php Yii::t('GuidlineContent', 'Гайдлайн сообщения'); ?></h3>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'guidline-messages-grid',
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
		array(
			'name'    => 'create_ip',
			'value'   => '$data->ip',
			'filter'  => false,
		),
		array(
			'name'    => 'user_id',
			'value'   => '$data->byUser',
			'type'    => 'raw',
			'filter'  => false,
		),
		'email',
		array(
			'name'    => 'question',
			'value'   => '$data->ShortQuestion',
		),
		array(
			'class'    => 'bootstrap.widgets.TbButtonColumn',
			'template' => '{view} {delete}',
		),
	),
)); ?>
