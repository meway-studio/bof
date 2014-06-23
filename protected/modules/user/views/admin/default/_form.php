<?php 
	
	Yii::app()->clientScript->registerCss('dp', '.ui-datepicker-trigger {padding: 0 0 10px 5px;}');

	$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block"><?php echo Yii::t('user', 'Поля с {s} обязательны для заполнения.', array('{s}'=>'<span class="required">*</span>')); ?></p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownList($model,'status', $model->statusList, array_merge(array('class'=>'span5'), $model->disabledForManager('status'))); ?>

	<?php echo $form->dropDownList($model,'role', $model->roleList,array_merge(array('class'=>'span5'), $model->disabledForManager('role'))); ?>

	<?php echo $form->textFieldRow($model,'email',array_merge(array('class'=>'span5','maxlength'=>50), $model->disabledForManager('email'))); ?>
	
	<?php echo $form->checkBoxRow($model,'has_spam', $model->disabledForManager('has_spam')); ?>
	
	<?php echo $form->checkBoxRow($model,'fast_notice', $model->disabledForManager('has_spam')); ?>
	
	<?php echo $form->checkBoxRow($model,'confirm', $model->disabledForManager('confirm')); ?>

	<?php echo $form->textFieldRow($model,'phone',array_merge(array('class'=>'span5','maxlength'=>20), $model->disabledForManager('phone'))); ?>

	<?php echo $form->textFieldRow($model,'firstname',array_merge(array('class'=>'span5','maxlength'=>50), $model->disabledForManager('firstname'))); ?>

	<div><?php echo CHtml::image($model->PhotoThumb, "", array("width"=>100)) ?></div>

	<?php if($model->sub!=null AND $model->role == User::ROLE_USER): ?>
	<div>
		<?php echo $form->labelEx($model->sub,'expiration_date'); ?>
		
		<div>
		<?php echo $model->getAttributeLabel('update_exp_date'); //echo $form->labelEx($model,'update_exp_date'); ?>
		<?php echo $form->checkBox($model, 'update_exp_date'); ?>
		</div>

		<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
				'model'      => $model->sub,
				'attribute'  =>'format_expiration_date',
				'options'=>array(
					'showAnim'        => 'fold',
					'showOn'          => 'button',
					'buttonImage'     => 'http://jqueryui.com/resources/demos/datepicker/images/calendar.gif',
					'buttonImageOnly' => true,
				)
			));
			?>

		<?php echo $form->error($model->sub,'expiration_date'); ?>

	</div>
	<?php endif; ?>
	
	<?php if($model->tipster!==null AND $model->role == User::ROLE_TIPSTER): ?>

		<?php echo $form->textFieldRow($model->tipster,'meta_k', array_merge(array('class'=>'span5','maxlength'=>250), $model->disabledForManager('meta_k'))); ?>
		<?php echo $form->textFieldRow($model->tipster,'meta_d', array_merge(array('class'=>'span5','maxlength'=>250), $model->disabledForManager('meta_d'))); ?>
		
		<?php echo $form->textFieldRow($model->tipster,'rank',     array_merge(array('class'=>'span5','maxlength'=>250), $model->disabledForManager('rank'))); ?>
		<?php echo $form->textFieldRow($model->tipster,'comment',  array_merge(array('class'=>'span5','maxlength'=>250), $model->disabledForManager('comment'))); ?>
		<?php echo $form->checkBoxRow($model->tipster, 'editor',  $model->disabledForManager('editor'));?>
		<?php echo $form->textAreaRow($model->tipster,'profile', array_merge(array('rows'=>6, 'cols'=>50, 'class'=>'span8'), $model->disabledForManager('profile'))); ?>

	<?php endif; ?>

	<?php echo $form->textAreaRow($model,'about', array_merge(array('rows'=>6, 'cols'=>50, 'class'=>'span8'), $model->disabledForManager('about'))); ?>
	
	<?php echo CHtml::link( Yii::t('User', 'Добавить отзыв'), array('/user/admin/reviews/addbyuser', 'id'=>$model->id), array_merge(array('class'=>'btn'), $model->disabledForManager('reviews'))); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'       => 'primary',
			'label'      => $model->isNewRecord ? Yii::t('user', 'Создать') : Yii::t('user', 'Сохранить'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>
