<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'elements-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($element); ?>

		<?php echo $form->labelEx($element,'name'); ?>
		<?php echo $form->textField($element,'name'); ?>
		<?php echo $form->error($element,'name'); ?>



		<?php echo $form->labelEx($element,'label'); ?>
		<?php echo $form->textField($element,'label'); ?>
		<?php echo $form->error($element,'label'); ?>



		<?php echo $form->labelEx($element,'hint'); ?>
		<?php echo $form->textField($element,'hint'); ?>
		<?php echo $form->error($element,'hint'); ?>



		<?php echo $form->labelEx($element,'type'); ?>
		<?php echo $form->dropDownList($element,'type',$element->TypeList); ?>
		<?php echo $form->error($element,'type'); ?>


	<?php if($element->NeedItems):?>

		<?php echo $form->labelEx($element,'items'); ?>
		<?php echo $form->textArea($element,'items'); ?>
		<?php echo $form->error($element,'items'); ?>

	<?php endif;?>
	

<?php $this->endWidget(); ?>