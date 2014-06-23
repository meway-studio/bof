<div id="elementOption_<?php echo $option->id?>">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'elements-options-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'form-inline'),
)); ?>

	<?php echo $form->errorSummary($option); ?>


		<?php // echo $form->labelEx($option,'['.$option->id.']key'); ?>
		<?php echo $form->textField($option,'['.$option->id.']key',array('placeholder'=>$option->getAttributeLabel('id'))); ?>
		<?php echo $form->error($option,'['.$option->id.']key'); ?>



		<?php // echo $form->labelEx($option,'['.$option->id.']value'); ?>
		<?php echo $form->textField($option,'['.$option->id.']value',array('placeholder'=>$option->getAttributeLabel('value'))); ?>
		<?php echo $form->error($option,'['.$option->id.']value'); ?>


		<?php echo CHtml::link('Удалить опцию',array('form/deleteElementOption','id'=>$option->id),array('class'=>'deleteElementOption btn btn-danger btn-mini','data-block'=>"elementOption_$option->id")); ?>


<?php $this->endWidget(); ?>
</div>
