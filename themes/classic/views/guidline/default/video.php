<?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>

<div class="site-width">
	<div class="guidline-us">
		<div class="guidline-left">
			<div class="title">
				<?php echo Yii::t('themes', '<span class="bold">Видео</span> <span>Советы</span> '); ?>
			</div>

			<div class="guidline-menu">
				
			</div>

		</div>
		<div class="questions">

			<div class="question">
				<h3><?php echo Yii::t('themes', 'Дорогой, Гость!'); ?></h3>
			</div>
			<p>
				<?php echo Yii::t('themes', 'Мы сделали пилотный видео­ролик и хотим узнать Ваше мнение: вы бы хотели смотреть на регулярной основе подобные ролики с бесплатными прогнозами «Ставка дня»? Если да, то напишите нам несколько слов о том, что Вам понравилось в нем, что не понравилось, на что, по вашему, следует обратить особое внимание и т.д. Мы готовы делать по 8 роликов в месяц, слово за вами…<br/><br/>Жмите лайк если понравился ролик, тем самым Вы поддержите идею, и мы  сможем воплотить ее в реальность с большей степенью вероятности.'); ?>
			</p>
			<iframe width="580" height="390" src="//www.youtube.com/embed/5X2Y1cCv_gU" frameborder="0" allowfullscreen></iframe>
			<div class="video_descr">
				<h3><?php echo Yii::t('themes', 'Пилотный выпуск видео советов BetonFootball'); ?></h3>
				<p class="grey_text">
					
				</p>
			</div>
			
			<!-- Start Form -->
				<div id="support" class="help">

				<?php if(Yii::app()->user->hasFlash('GuidlineMessagesSuccess')):?>

					<div class="submitted">
						<span><?php echo Yii::app()->user->getFlash('GuidlineMessagesSuccess'); ?></span>
						<?php echo CHtml::link(Yii::t('GuidlineMessages', 'Еще раз'), array('/guidline/default/video')); ?>
					</div>

				<?php elseif(Yii::app()->user->hasFlash('GuidlineMessagesFailure')):?>

					<div class="error">
						<span><?php echo Yii::app()->user->getFlash('GuidlineMessagesFailure'); ?></span>
						<?php echo CHtml::link(Yii::t('GuidlineMessages', 'Попробуйте еще раз'), array('index')); ?>
					</div>

				<?php else: ?>

					
					<?php $form=$this->beginWidget('CActiveForm', array(
					    'id'                   => 'guidline-form',
					    'enableAjaxValidation' => false,
					    //'action'               => Yii::app()->createAbsoluteUrl('guidline/default/index').'#support',
					)); ?>

						<span class="say-hi"><?php echo Yii::t('themes', 'Как мы можем Вам помочь?'); ?></span>
					    <?php //echo $form->errorSummary($model); ?>

						<?php //echo $form->labelEx($model,'question'); ?>
						<?php echo $form->textField($model,'question', array('class'=>'question', 'placeholder'=>Yii::t('themes', 'Вопрос'))); ?>
						<?php echo $form->error($model,'question', array('class'=>'oops')); ?>
		
						<?php //echo $form->labelEx($model,'details'); ?>
						<?php echo $form->textArea($model,'details', array('class'=>'details', 'placeholder'=>Yii::t('themes', 'Подробнее'))); ?>
						<?php echo $form->error($model,'details', array('class'=>'oops')); ?>
		
						<?php //echo $form->labelEx($model,'name'); ?>
						<?php echo $form->textField($model,'name', array('class'=>'name', 'placeholder'=>Yii::t('themes', 'Имя'))); ?>
						<?php echo $form->error($model,'name', array('class'=>'oops')); ?>
		
						<?php //echo $form->labelEx($model,'email'); ?>
						<?php echo $form->textField($model,'email', array('class'=>'mail', 'placeholder'=>Yii::t('themes', 'Ваш электронный адрес'))); ?>
						<?php echo $form->error($model,'email', array('class'=>'oops')); ?>
						    
						     <?php if(CCaptcha::checkRequirements()): ?>
							    <div class="row">
								    <div>
									    <div class="code_img">					
										    <?php $this->widget('CCaptcha', array(
											    'clickableImage'    => true,
											    'showRefreshButton' => false,
											    'imageOptions'      => array('style'=>'vertical-align: middle;')
										    )); ?>
									    </div>
									    <?php echo $form->textField($model,'verifyCode', array('class'=>'code','placeholder'=>Yii::t('themes', 'Пожалуйста, введите буквы, изображенные на картинке выше'))); ?>
								    </div>
								    <?php echo $form->error($model,'verifyCode'); ?>
							    </div>
						    <?php endif; ?>
		
						<input class="submit" type="submit" value="<?php echo Yii::t('themes', 'Отправить'); ?>">

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