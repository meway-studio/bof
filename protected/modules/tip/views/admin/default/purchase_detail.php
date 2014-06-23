<?php
$this->breadcrumbs=array(
	Yii::t('tips', 'Покупки')=>array('/tip/admin/default/purchase'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('tips', 'Управление покупками'),'url'=>array('admin')),
);
?>

<h3><?php echo Yii::t('tips', 'Просмотр покупки #{id}', array('{id}'=>'<em>'.$model->id.'</em>')); ?></h3>

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
			'value' => $model->price,
		),
		array(
			'name'  => 'create_date',
			'value' => $model->formatCreateDate,
		),
		array(
			'name'  => 'update_date',
			'value' => $model->formatUpdateDate,
		),
		array(
			'name'  => 'description',
			'type'  => 'raw',
			'value' => $model->Description,
		),
		array(
			'name'  => 'user',
			'type'  => 'raw',
			'value' => CHtml::link($model->user->FullName." (".$model->user->email.")", array('/user/admin/default/view', 'id'=>$model->user_id)),
		),
	),
));


if($model->type == Purchase::TYPE_ONCE){
	echo '<h3>'.Yii::t('tips', 'Заказы').'</h3>';
	echo '<ul>';
	foreach($model->tips AS $item){
		echo '<li>'.CHtml::link($item->tips->title, array('/tip/admin/default/view', 'id'=>$item->tips_id), array() )."'</li>";
	}
	echo '</ul>';
}

echo '<br />';

if($model->status == Purchase::STATUS_NEW){
	echo CHtml::link(Yii::t('tips', 'Принять'),  array('/tip/admin/default/purchaseDetail','id'=>$model->id, 'action'=>'yes'),  array('class'=>'btn btn-success'));
	echo '&nbsp;';
	echo CHtml::link(Yii::t('tips', 'Отклонить'), array('/tip/admin/default/purchaseDetail','id'=>$model->id, 'action'=>'no'), array('class'=>'btn btn-danger'));
}

echo '<hr />';
?>
