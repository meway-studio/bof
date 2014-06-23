<?php
/* @var $this FormsController */
/* @var $model Forms */
/* @var $form CActiveForm */
?>

<div id="accordion">

<h4>Параметры формы</h4>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'forms-_form-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title'); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description'); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'button'); ?>
		<?php echo $form->textField($model,'button'); ?>
		<?php echo $form->error($model,'button'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'success_msg'); ?>
		<?php echo $form->textField($model,'success_msg'); ?>
		<?php echo $form->error($model,'success_msg'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'failure_msg'); ?>
		<?php echo $form->textField($model,'failure_msg'); ?>
		<?php echo $form->error($model,'failure_msg'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php foreach($model->elements AS $i=>$element):?>

	<h4>Элемент #<?php echo $element->id;?>: <?php echo $element->name;?></h4>
	<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'elements-_form-form',
		'enableAjaxValidation'=>false,
	)); ?>

		<?php echo $form->errorSummary($element); ?>

		<div class="row">
			<?php echo $form->labelEx($element,'['.$i.']name'); ?>
			<?php echo $form->textField($element,'['.$i.']name'); ?>
			<?php echo $form->error($element,'['.$i.']name'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($element,'['.$i.']label'); ?>
			<?php echo $form->textField($element,'['.$i.']label'); ?>
			<?php echo $form->error($element,'['.$i.']label'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($element,'['.$i.']hint'); ?>
			<?php echo $form->textField($element,'['.$i.']hint'); ?>
			<?php echo $form->error($element,'['.$i.']hint'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($element,'['.$i.']type'); ?>
			<?php echo $form->dropDownList($element,'['.$i.']type',$element->TypeList); ?>
			<?php echo $form->error($element,'['.$i.']type'); ?>
		</div>

	<?php $this->endWidget(); ?>
	
	<b>Опции Элмента</b>
	
	<?php foreach($element->options AS $i=>$option):?>
		<div class="portlet-decoration">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'elements-options-_form-form',
			'enableAjaxValidation'=>false,
		)); ?>

			<?php echo $form->errorSummary($option); ?>

			<div class="row">
				<?php echo $form->labelEx($option,'['.$i.']key'); ?>
				<?php echo $form->textField($option,'['.$i.']key'); ?>
				<?php echo $form->error($option,'['.$i.']key'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($option,'['.$i.']value'); ?>
				<?php echo $form->textField($option,'['.$i.']value'); ?>
				<?php echo $form->error($option,'['.$i.']value'); ?>
			</div>

		<?php $this->endWidget(); ?>
		</div>
		<hr />
	<?php endforeach;?>
	
	<b>Правила валидации</b>
	
	<?php foreach($element->rules AS $i=>$rules):?>
	
		<div class="portlet-decoration">
		<b>Bалидатор</b>
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'elements-options-_form-form',
			'enableAjaxValidation'=>false,
		)); ?>

			<?php echo $form->errorSummary($rules); ?>

			<div class="row">
				<?php echo $form->labelEx($rules,'['.$i.']validator'); ?>
				<?php echo $form->dropDownList($rules,'['.$i.']validator',$rules->ValidatorList); ?>
				<?php echo $form->error($rules,'['.$i.']validator'); ?>
			</div>

		<?php $this->endWidget(); ?>
		
		<b>Параметры валидатора</b>
		<?php foreach($rules->params AS $i=>$params):?>
			
			<?php $form=$this->beginWidget('CActiveForm', array(
				'id'=>'elements-options-_form-form',
				'enableAjaxValidation'=>false,
			)); ?>

				<?php echo $form->errorSummary($params); ?>

				<div class="row">
					<?php echo $form->labelEx($params,'['.$i.']key'); ?>
					<?php echo $form->dropDownList($params,'['.$i.']key',$params->ValidatorParams); ?>
					<?php echo $form->error($params,'['.$i.']key'); ?>
				</div>

				<div class="row">
					<?php echo $form->labelEx($params,'['.$i.']value'); ?>
					<?php echo $form->textField($params,'['.$i.']value'); ?>
					<?php echo $form->error($params,'['.$i.']value'); ?>
				</div>

			<?php $this->endWidget(); ?>
			<hr />
		<?php endforeach;?>
		</div>
	<?php endforeach;?>
	
	</div><!-- form -->
<?php endforeach;?>

</div>