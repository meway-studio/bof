<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'guidline-content-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block"><?php Yii::t('GuidlineContent', 'Поля с {s} обязательны для заполнения.', array('{s}' => '<span class="required">*</span>')); ?></p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownList($model,'status', $model->statusList, array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'sort',array('class'=>'span5')); ?>

	<?php echo $form->textAreaRow($model,'content',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? Yii::t('GuidlineContent', 'Создать') : Yii::t('GuidlineContent', 'Сохранить'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>
