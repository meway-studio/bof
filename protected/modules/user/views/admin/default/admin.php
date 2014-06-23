<?php
$this->breadcrumbs=array( 
    Yii::t('user', 'Пользователи')
);

$this->menu=array( 
    //array('label'=>'Create User','url'=>array('create')), 
); 

?> 

<h3><?php echo Yii::t('user', 'Управление пользователями'); ?></h3>

<?php $this->widget('bootstrap.widgets.TbGridView',array( 
    'id'=>'user-grid', 
    'dataProvider'=>$model->search(), 
    'filter'=>$model, 
    'columns'=>array( 
		array(
			'name'   => 'id',
			'value'  => '$data->id',
			'htmlOptions'=>array('style'=>'width:25px;'),
		),
		array(
			'name'   => 'photo',
			'type'   => 'raw',
			'filter' => false,
			'value'  => 'CHtml::image($data->PhotoThumb, "", array("width"=>25))',
		),
		array(
			'name'   => 'status',
			'filter' => $model->statusList,
			'value'  => '$data->statusName',
		),
		array(
			'name'   => 'role',
			'filter' => $model->roleList,
			'value'  => '$data->roleName',
		),
		array(
			'name'   => 'create_date',
			'filter' => false,
			'value'  => '$data->formatCreateDate',
		),
        'email',
		array(
			'name'   => 'expiration_date',
			//'filter' => false,
			'value'  => '$data->ExpDays',
		),
        'firstname',
        array( 
            'class'=>'bootstrap.widgets.TbButtonColumn', 
        ), 
    ), 
)); ?> 