<?php
$this->breadcrumbs=array(
	Yii::t('tips', 'Советы')
);

$this->menu=array(
	array('label'=>Yii::t('tips', 'Создать совет'),'url'=>array('create')),
);
?>

<h3><?php echo Yii::t('tips', 'Управление советами'); ?></h3>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'           => 'tips-grid',
	'dataProvider' => $model->search(),
	'filter'       => $model,
	'columns' => array(
		array(
			'name'   => 'id',
			'value'  => '$data->id',
			'htmlOptions'=>array('style'=>'width:25px;'),
		),
		array(
			'name'    => 'cover',
			'type'    => 'raw',
			'filter'  => false,
			'value'   => 'CHtml::image($data->CoverOriginal, "", array("width"=>"25px;"))',
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
			'name'    => 'price',
			'type'    => 'raw',
			'value'   => '$data->formatPrice',
		),
		array(
			'name'    => 'create_date',
			'filter'  => false,
			'value'   => '$data->format_create_date',
		),
		array(
			'name'    => 'event_date',
			'filter'  => false,
			'value'   => '$data->format_event_date',
		),
		array(
			'name'    => 'tipster_id',
			'type'    => 'raw',
			'value'   => 'CHtml::link($data->tipster->FullName, array("/admin/user/default/view", "id"=>$data->tipster_id))',
		),
		'club_1',
		'club_2',
		array(
			'name'    => 'tip_result',
			'filter'  => $model->TipResultList,
			'value'   => '$data->TipResultName',
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
