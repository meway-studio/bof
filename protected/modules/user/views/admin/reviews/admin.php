<?php
$this->breadcrumbs=array(
	Yii::t('user', 'Просмотр')=>array('admin'),
	Yii::t('user', 'Добавить')=>array('create'),
	Yii::t('user', 'Управление'),
);

$this->menu=array(
	array('label'=>Yii::t('user', 'Добавить отзыв'),'url'=>array('create')),
);

?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'reviews-grid',
	'dataProvider'=>$model->search(),
	'filter'      =>$model,
	'columns'=>array(
		array(
			'name'   => 'id',
			'value'  => '$data->id',
			'htmlOptions'=>array('style'=>'width:25px;'),
		),
		array(
			'name'   => 'sort',
			'value'  => '$data->sort',
			'htmlOptions'=>array('style'=>'width:25px;'),
		),
		array(
			'name'   => 'status',
			'filter' => $model->statusList,
			'value'  => '$data->statusName',
		),
		array(
			'name'   => 'user_id',
			'value'  => '$data->user_name',
		),
		array(
			'name'   => 'content',
			'value'  => '$data->shortContent',
		),
		array(
			'class'    => 'bootstrap.widgets.TbButtonColumn',
			'template' => '{update} {delete}',
		),
	),
)); ?>
