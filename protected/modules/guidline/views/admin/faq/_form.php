<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'faq-category-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block"><?php echo Yii::t('GuidlineContent', 'Поля с {s} обязательны для заполнения.', array('{s}'=>'<span class="required">*</span>')); ?></p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'status', $model->statusList,array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'sort',array('class'=>'span2')); ?>

	<?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>250)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('GuidlineContent', 'Создать') : Yii::t('GuidlineContent', 'Сохранить'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>
