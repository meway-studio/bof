<?php 
	
	Yii::import('ext.redactor.redactor');
	
	Yii::app()->clientScript->registerScriptFile('/js/tag-it.min.js');
	Yii::app()->clientScript->registerCssFile('/css/jquery.tagit.css');
	Yii::app()->clientScript->registerScript('tag-it', '$(document).ready(function(){$(".form_email_list").tagit();})');
	
	$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'mail-task-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block"><?php echo Yii::t('tips', 'Поля с {s} обязательны для заполнения.', array('{s}'=>'<span class="required">*</span>')); ?></p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownList($model,'status', $model->statusList, array('class'=>'span5')); ?>

	<?php echo $form->dropDownList($model,'type', $model->typeList, array('class'=>'span5')); ?>
	
	<?php echo $form->textFieldRow($model,'subject',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'emails',array('class'=>'span8 form_email_list')); ?>
	
	<div>
		<?php echo $form->labelEx($model,'content'); ?>
		<?php $this->widget('redactor', array(
			'model'     => $model,
			'language'  => Yii::app()->language,
			'attribute' => 'content',
			
			'plugins'   => array(
				'fontcolor',
				'fontcolor',
				'fontfamily',
			)
		)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('tips', 'Создать') : Yii::t('tips', 'Сохранить'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>
