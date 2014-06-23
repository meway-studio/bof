<div class="information tipster">
	<span><?php echo Yii::t('themes', 'Иноформация об авторе'); ?></span>
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'tipster-update-form',
		'enableAjaxValidation'=>false,
	)); ?>

		<?php echo $form->errorSummary($model); ?>

		<span class="name">
			<?php echo $form->textField($model,'rank', array('size'=>38)); ?>
		</span>
		
		<span class="name">
			<?php echo $form->textField($model,'comment', array('size'=>38)); ?>
		</span>

	<?php echo CHtml::submitButton(Yii::t('themes', 'Изменить'), array('class'=>'updateprofile-but')); ?>
	<?php $this->endWidget(); ?>
</div>