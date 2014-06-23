<div id="elementValidatorParams_<?php echo $params->id;?>">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'elements-options-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'form-inline'),
)); ?>

	<?php echo $form->errorSummary($params); ?>

		<?php //echo $form->labelEx($params,'['.$params->id.']key'); ?>
		<?php echo $form->dropDownList($params,'['.$params->id.']key',$params->ValidatorParams); ?>
		<?php echo $form->error($params,'['.$params->id.']key'); ?>

		<?php //echo $form->labelEx($params,'['.$params->id.']value'); ?>
		<?php echo $form->textField($params,'['.$params->id.']value',array('placeholder'=>$params->getAttributeLabel('value'))); ?>
		<?php echo $form->error($params,'['.$params->id.']value'); ?>

		<?php echo CHtml::link('Удалить',array('form/deleteValidatorParams','id'=>$params->id),array('class'=>'deleteValidatorParams btn btn-danger btn-mini','data-block'=>"elementValidatorParams_{$params->id}")); ?>
		<?php //echo CHtml::link('Add params',array('forms/createValidatorParams','id'=>$rules->id),array('class'=>'createValidatorParams')); ?>

	
<?php $this->endWidget(); ?>
</div>
