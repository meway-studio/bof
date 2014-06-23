<?php
$this->breadcrumbs=array(
	Yii::t('GuidlineContent', 'Гайдлайн сообщения')=>array('admin'),
	$model->question,
);
?>

<h3><?php echo Yii::t('GuidlineContent', 'Просмотр гайдлайн сообщений #{ques}', array('{ques}'=>$model->question)); ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'name'  => 'status',
			'value' => $model->statusName,
		),
		array(
			'name'  => 'create_date',
			'value' => $model->formatCreateDate,
		),
		array(
			'name'  => 'create_ip',
			'value' => $model->ip,
		),
		array(
			'name'  => 'name',
			'value' => $model->byUser,
			'type'  => 'raw',
		),
		'email',
		'question',
		'details',
	),
)); ?>
