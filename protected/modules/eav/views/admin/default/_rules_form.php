<div id="elementValidator_<?php echo $rules->id;?>">

<b>Bалидатор</b>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>"elements-options-form-{$rules->id}",
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($rules); ?>

		
		<?php if($rules->isNewRecord):?>
			<?php echo $form->dropDownList($rules,'['.$rules->id.']validator',$rules->ValidatorList); ?>
		<?php else:?>
			<span class="validatorName"><?php echo $rules->ValidatorName;?></span>
		<?php endif;?>
		
		<?php echo $form->error($rules,'['.$rules->id.']validator'); ?>
		<?php echo $form->hiddenField($rules,'['.$rules->id.']id'); ?>
	
	<div class="buttons">

		<?php //echo CHtml::activeDropDownList($rules,'key',$rules->ValidatorParams); ?>
		<?php echo CHtml::link('Добавить',array('form/createValidatorParams','id'=>$rules->id),array('class'=>'createValidatorParams btn btn-success btn-mini','data-block'=>"ValidatorParams_{$rules->id}")); ?>

		<?php echo CHtml::link(
				'Удалить',
				array('form/deleteValidator','id'=>$rules->id),
				array('class'=>($rules->isNewRecord ? 'deleteValidatorForm btn btn-danger btn-mini' : 'deleteValidator btn btn-danger btn-mini'),'data-block'=>"elementValidator_{$rules->id}")
			);?>
	</div>
	
<?php $this->endWidget(); ?>

<div id="ValidatorParams_<?php echo $rules->id;?>">

	<?php if($rules->params!=array()):?>
		<b>Параметры валидатора</b>
		<?php foreach($rules->params AS $i=>$params):?>
			<?php $this->renderPartial('_params_form',array('params'=>$params,'rules'=>$rules));?>
		<?php endforeach;?>
	<?php endif;?>

	<hr />
</div>

</div>
