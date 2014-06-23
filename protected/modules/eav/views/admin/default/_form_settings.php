<h4>Параметры формы</h4>
		<div class="form">

		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'forms-_form-form',
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array('class'=>'form-horizontal'),
		)); ?>
				
				<div class="control-group">
					<?php echo $form->labelEx($model,'title',array('class'=>'control-label')); ?>
					<div class="controls">
						<?php echo $form->textField($model,'title'); ?>
						<?php echo $form->error($model,'title'); ?>
					</div>
				</div>
				
				<div class="control-group">
					<?php echo $form->labelEx($model,'description',array('class'=>'control-label')); ?>
					<div class="controls">
						<?php echo $form->textArea($model,'description',array('class'=>'redactor')); ?>
						<?php echo $form->error($model,'description'); ?>
					</div>
				</div>
				
				<div class="control-group">
					<?php echo $form->labelEx($model,'button',array('class'=>'control-label')); ?>
					<div class="controls">
						<?php echo $form->textField($model,'button'); ?>
						<?php echo $form->error($model,'button'); ?>
					</div>
				</div>
				
				<div class="control-group">
					<?php echo $form->labelEx($model,'email',array('class'=>'control-label')); ?>
					<div class="controls">
						<?php echo $form->textField($model,'email',array('class'=>'form_email_list')); ?>
						<?php echo $form->error($model,'email'); ?>
					</div>
				</div>
				
				<div class="control-group">
					<?php echo $form->labelEx($model,'success_msg',array('class'=>'control-label')); ?>
					<div class="controls">
						<?php echo $form->textField($model,'success_msg'); ?>
						<?php echo $form->error($model,'success_msg'); ?>
					</div>
				</div>
				
				<div class="control-group">
					<?php echo $form->labelEx($model,'failure_msg',array('class'=>'control-label')); ?>
					<div class="controls">
						<?php echo $form->textField($model,'failure_msg'); ?>
						<?php echo $form->error($model,'failure_msg'); ?>
					</div>
				</div>
				
				<div class="control-group">
					<?php echo $form->labelEx($model,'advanced',array('class'=>'control-label')); ?>
					<div class="controls">
						<?php echo $form->textArea($model,'advanced',array('class'=>'redactor')); ?>
						<?php echo $form->error($model,'advanced'); ?>
					</div>
				</div>
				
				<div class="control-group">
					<?php echo $form->labelEx($model,'html_form_id',array('class'=>'control-label')); ?>
					<div class="controls">
						<?php echo $form->textField($model,'html_form_id'); ?>
						<?php echo $form->error($model,'html_form_id'); ?>
					</div>
				</div>
				
				<div class="control-group">
					<div class="controls">
						<label class="checkbox">
							<?php echo $form->checkBox($model,'enableClientValidation'); ?><?php echo $form->labelEx($model,'enableClientValidation'); ?>
						</label>
						<?php echo $form->error($model,'enableClientValidation'); ?>
					</div>
				</div>
				
				<div class="control-group">
					<div class="controls">
						<label class="checkbox">
							<?php echo $form->checkBox($model,'enableAjaxValidation'); ?><?php echo $form->labelEx($model,'enableAjaxValidation'); ?>
						</label>
						<?php echo $form->error($model,'enableAjaxValidation'); ?>
					</div>
				</div>
				
				<div class="control-group">
					<div class="controls">
						<label class="checkbox">
							<?php echo $form->checkBox($model,'validateOnSubmit'); ?><?php echo $form->labelEx($model,'validateOnSubmit'); ?>
						</label>
						<?php echo $form->error($model,'validateOnSubmit'); ?>
					</div>
				</div>
				
				<div class="control-group">
					<?php echo $form->labelEx($model,'enctype',array('class'=>'control-label')); ?>
					<div class="controls">
						<?php echo $form->dropDownList($model,'enctype',$model->EnctypeList); ?>
						<?php echo $form->error($model,'enctype'); ?>
					</div>
				</div>
				
				<div class="control-group">
					<div class="controls">
						<label class="checkbox">
							<?php echo $form->checkBox($model,'captcha'); ?><?php echo $form->labelEx($model,'captcha'); ?>
						</label>
					</div>
				</div>
				
				<div class="form-actions navbar navbar-fixed-bottom">
					<?php echo CHtml::submitButton('Отправить',array('class'=>'btn btn-primary')); ?>
				</div>

		<?php $this->endWidget(); ?>

		</div><!-- form -->