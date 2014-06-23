<?php
$this->breadcrumbs=array(
	Yii::t('tips', 'Советы')=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>Yii::t('tips', 'Создать совет'),'url'=>array('create')),
	array('label'=>Yii::t('tips', 'Обновить совет'),'url'=>array('update','id'=>$model->id)),
	array('label'=>Yii::t('tips', 'Удалить совет'),'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>Yii::t('tips', 'Вы уверены, что хотите удалить этот совет?'))),
	array('label'=>Yii::t('tips', 'Управление советами'),'url'=>array('admin')),
);
?>

<h3><?php echo Yii::t('tips', 'Просмотр совета {title}', array('{title}'=>'<em>'.$model->title.'</em>')); ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'name'  => 'status',
			'value' => $model->statusName,
		),
		array(
			'name'  => 'type',
			'value' => $model->typeName,
		),
		array(
			'name'  => 'price',
			'type'  => 'raw',
			'value' => $model->formatPrice,
		),
		array(
			'name'  => 'create_date',
			'value' => $model->format_create_date,
		),
		array(
			'name'  => 'update_date',
			'value' => $model->format_update_date,
		),
		array(
			'name'  => 'event_date',
			'value' => $model->format_event_date,
		),
		array(
			'name'  => 'tipster_id',
			'type'  => 'raw',
			'value' => CHtml::link($model->tipster->FullName, array('/user/admin/default/view', 'id'=>$model->tipster_id)),
		),
		array(
			'name'  => 'club_1',
			'type'  => 'raw',
			'value' => $model->club_1.$model->ImgFlag1,
		),
		array(
			'name'  => 'club_2',
			'type'  => 'raw',
			'value' => $model->club_2.$model->ImgFlag2,
		),
		array(
			'name'  => 'bet_on',
			'value' => $model->BetOnClub,
		),
		'league',
		'selection',
		'selection_num',
		'odds',
		'stake',
		'profit',
		array(
			'name'  => 'tip_result',
			'type'  => 'raw',
			'value' => $model->TipResultSpanTag,
		),
		'match_result',
		array(
			'name'  => 'cover',
			'type'  => 'raw',
			'value' => CHtml::image($model->coverOriginal),
		),
		
		'meta_k',
		'meta_d',
		
		'description',
		array(
			'name'  => 'content',
			'type'  => 'raw',
			'value' => $model->content,
		),
	),
)); ?>
