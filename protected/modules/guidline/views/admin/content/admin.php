<?php

Yii::import('ext.redactor.redactor');

$this->breadcrumbs=array(
	Yii::t('GuidlineContent', 'Золотые правила')=>array('admin'),
	Yii::t('GuidlineContent', 'Создать')=>array('create'),
	Yii::t('GuidlineContent', 'Управление'),
);

$this->menu=array(
	array('label'=>Yii::t('GuidlineContent', 'Создать Золотое Правило'),'url'=>array('create')),
);
?>

<h3><?php Yii::t('GuidlineContent', 'Обновление основного контента'); ?></h3>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'guidline-content-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($index); ?>

	<?php //echo $form->textAreaRow($index,'content',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<?php $this->widget('redactor', array(
		'model'     => $index,
		'language'  => Yii::app()->language,
		'attribute' => 'content',
		
		'plugins'   => array(
			'fontcolor',
			'fontcolor',
			'fontfamily',
			'clips',
		),
	)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$index->isNewRecord ? Yii::t('GuidlineContent', 'Создать') : Yii::t('GuidlineContent', 'Сохранить'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>

<h3><?php Yii::t('GuidlineContent', 'Управление Гайдлайн контентом'); ?></h3>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'guidline-content-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'   => 'id',
			'value'  => '$data->id',
			'htmlOptions'=>array('style'=>'width:25px;'),
		),
		array(
			'name'   => 'sort',
			'value'  => '$data->sort',
			'filter' => false,
			'htmlOptions'=>array('style'=>'width:25px;'),
		),
		array(
			'name'    => 'status',
			'filter'  => $model->statusList,
			'value'   => '$data->statusName',
		),
		array(
			'name'  => 'content',
			'value' => '$data->shortContent',
		),
		array(
			'class'    => 'bootstrap.widgets.TbButtonColumn',
			'template' => '{update} {delete}',
		),
	),
)); ?>