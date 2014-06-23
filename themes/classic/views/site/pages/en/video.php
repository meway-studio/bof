<?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>

<div class="site-width">
	<div class="guidline-us">
		<div class="guidline-left">
			<div class="title">
				<span class="bold">Video</span>
				<span> Tips</span>
			</div>

			<div class="guidline-menu">
				
			</div>

		</div>
		<div class="questions">

			<div class="question">
				<h3>Dear guest!</h3>
			</div>
			<p>
				We made a video clip and we want to know your opinion: would you like to see these videos with free predictions «Bet of the day» regularly? If you say yes, write to us what do you think about it, what you don’t like, on what we should pay special attention, in your opinion. We are ready to do 8 clips per month, it is for you to decide it. 
				<br/><br/>
				Click Like if you liked the clip and supported this idea entirely.
			</p>
			<iframe width="580" height="390" src="//www.youtube.com/embed/5X2Y1cCv_gU" frameborder="0" allowfullscreen></iframe>
			<div class="video_descr">
				<h3>Pilot release video tips BetonFootball</h3>
				<p class="grey_text">
					
				</p>
			</div>
			
			<!-- Start Form -->
				<div id="support" class="help">
				<?php 
				Yii::import('application.modules.guidline.models.GuidlineMessages');
				$model = new GuidlineMessages; ?>
				<?php if(Yii::app()->user->hasFlash('GuidlineMessagesSuccess')):?>

					<div class="submitted">
						<span><?php echo Yii::app()->user->getFlash('GuidlineMessagesSuccess'); ?></span>
						<?php echo CHtml::link(Yii::t('GuidlineMessages', 'Once more'), array('index')); ?>
					</div>

				<?php elseif(Yii::app()->user->hasFlash('GuidlineMessagesFailure')):?>

					<div class="error">
						<span><?php echo Yii::app()->user->getFlash('GuidlineMessagesFailure'); ?></span>
						<?php echo CHtml::link(Yii::t('GuidlineMessages', 'Try again'), array('index')); ?>
					</div>

				<?php else: ?>

					
					<?php $form=$this->beginWidget('CActiveForm', array(
					    'id'                   => 'guidline-form',
					    'enableAjaxValidation' => false,
					    'action'               => Yii::app()->createAbsoluteUrl('guidline/default/index').'#support',
					)); ?>

						<span class="say-hi">How can we help you?</span>
					    <?php //echo $form->errorSummary($model); ?>

					    <?php //echo $form->labelEx($model,'question'); ?>
					    <?php echo $form->textField($model,'question', array('class'=>'question', 'placeholder'=>'Question')); ?>
					    <?php echo $form->error($model,'question', array('class'=>'oops')); ?>

					    <?php //echo $form->labelEx($model,'details'); ?>
					    <?php echo $form->textArea($model,'details', array('class'=>'details', 'placeholder'=>'Details')); ?>
					    <?php echo $form->error($model,'details', array('class'=>'oops')); ?>

					    <?php //echo $form->labelEx($model,'name'); ?>
					    <?php echo $form->textField($model,'name', array('class'=>'name', 'placeholder'=>'Name')); ?>
					    <?php echo $form->error($model,'name', array('class'=>'oops')); ?>

					    <?php //echo $form->labelEx($model,'email'); ?>
					    <?php echo $form->textField($model,'email', array('class'=>'mail', 'placeholder'=>'Your email addres')); ?>
					    <?php echo $form->error($model,'email', array('class'=>'oops')); ?>

					    <?php //if(CCaptcha::checkRequirements()): ?>
						<div class="row">
							<div>
							<?php $this->widget('CCaptcha', array(
								'clickableImage'    => true,
								'showRefreshButton' => false,
								'imageOptions'      => array('style'=>'vertical-align: middle;')
							)); ?>
							<?php echo $form->textField($model,'verifyCode', array('style'=>'width: 513px;display: inline-block;height: 100px;font-size: 60px;color: #8CC153;')); ?>
							</div>
							<div class="hint" style="text-align: right;">Please enter the letters as they are shown in the image above.</div>
							<?php echo $form->error($model,'verifyCode'); ?>
						</div>
						<?php //endif; ?>

					    <input class="submit" type="submit" value="Submit">

					<?php $this->endWidget(); ?>

				<?php endif; ?>
				
				</div>
				<!-- End Form -->
		</div>
	</div>
</div>

<script>
	$(function() {
		$( "#accordion" ).accordion({heightStyle: "content"});
	});
</script>