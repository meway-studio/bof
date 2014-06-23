<?php
$this->breadcrumbs=array(
	Yii::t('tips', 'Покупка')
);
?>

<h3><?php echo Yii::t('tips', 'Управление покупками'); ?></h3>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'           => 'purchase-grid',
	'dataProvider' => $model->search(),
	'filter'       => $model,
	'columns' => array(
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
			'name'    => 'price',
			'type'    => 'raw',
			'value'   => '$data->price',
		),
		array(
			'name'    => 'create_date',
			'value'   => '$data->formatCreateDate',
		),
		array(
			'name'    => 'user_id',
			'type'    => 'raw',
			'value'   => 'CHtml::link($data->UserFullStr, array("/admin/user/default/view", "id"=>$data->user_id))',
		),
		array(
			'class'    => 'bootstrap.widgets.TbButtonColumn',
			'template' => '{view} {delete}',
			'buttons'  => array(
				'view' => array(
					'url' => 'Yii::app()->createUrl("/tip/admin/default/PurchaseDetail", array("id"=>$data->id))', 
				),
				'delete' => array(
					'url' => 'Yii::app()->createUrl("/tip/admin/default/purchaseDelete", array("id"=>$data->id))', 
				),
			),
		),
	),
)); ?>
