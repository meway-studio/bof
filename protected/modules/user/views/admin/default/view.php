<?php
$this->breadcrumbs=array(
	Yii::t('user', 'Пользователи')=>array('index'),
	$model->FullName,
);

$this->menu=array(
	array('label'=>Yii::t('user', 'Редактировать пользователя'),'url'=>array('update','id'=>$model->id)),
	array('label'=>Yii::t('user', 'Удалить пользователя'),'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('user', 'Управление пользователями'),'url'=>array('admin')),
);
?>

<h3><?php echo Yii::t('user', 'Просмотр пользователя - {fn}', array('{fn}'=>$model->FullName)); ?></h3>

<?php 

$this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		array(
			'name'  => 'status',
			'value' => $model->statusName,
		),
		array(
			'name'  => 'role',
			'value' => $model->roleName,
		),
		array(
			'name'  => 'confirm',
			'value' => $model->confirmName,
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
			'name'  => 'create_ip',
			'value' => $model->ip,
		),
		'email',
		'phone',
		'hash',
		'money',
		'firstname',
		array(
			'name'   => 'photo',
			'type'   => 'raw',
			'value'  => CHtml::image($model->PhotoThumb, "", array("width"=>100)),
		),
		'about',
	),
)); 

if($model->tipster!==null){

	$this->widget('bootstrap.widgets.TbDetailView',array(
		'data'      =>$model->tipster,
		'attributes'=>array(
			'rank',
			'comment',
		),
	));
}

?>
