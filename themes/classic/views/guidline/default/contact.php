<div class="site-width">

	<div class="contact-form" itemscope itemtype="http://schema.org/Organization">
		<div class="title">
			<span class="bold"><?php echo Yii::app()->config->get('CONTACT_HEADER');?></span>
			<span></span>
			<span class="text"><?php echo Yii::app()->config->get('CONTACT_TEXT');?></span>
		</div>
		<div class="hello">
			<span class="say-hi"><?php echo Yii::app()->config->get('CONTACT_TITLE');?></span>
			<div class="line"></div>
			<div class="phone">
				<span><?php echo Yii::t('themes', 'Телефон'); ?><span itemprop="telephone"><?php echo Yii::app()->config->get('CONTACT_PHONE');?></span></span>
			</div>
			<div class="line"></div>
			<div class="mail">
				<span><?php echo Yii::t('themes', 'Email'); ?><span itemprop="email"><?php echo Yii::app()->config->get('CONTACT_EMAIL_1');?></span><span itemprop="email"><?php echo Yii::app()->config->get('CONTACT_EMAIL_2');?></span><span itemprop="email">info@betonfootball.eu</span></span>
			</div>
			<div class="line"></div>
			<div class="skype">
				<span><?php echo Yii::t('themes', 'Скайп'); ?><span><?php echo Yii::app()->config->get('CONTACT_SKYPE');?></span></span>
			</div>
			<div class="line"></div>
		</div>

		<div class="help">
				
			<?php if(Yii::app()->user->hasFlash('GuidlineMessagesSuccess')):?>

				<div class="submitted">
					<span><?php echo Yii::app()->user->getFlash('GuidlineMessagesSuccess'); ?></span>
					<?php echo CHtml::link(Yii::t('GuidlineMessages', 'Еще раз'), array('contacts')); ?>
				</div>

			<?php elseif(Yii::app()->user->hasFlash('GuidlineMessagesFailure')):?>

				<div class="error">
					<span><?php echo Yii::app()->user->getFlash('GuidlineMessagesFailure'); ?></span>
					<?php echo CHtml::link(Yii::t('GuidlineMessages', 'Попробуйте еще раз'), array('contacts')); ?>
				</div>

			<?php else: ?>

				
				<?php $form=$this->beginWidget('CActiveForm', array(
				    'id'                   => 'guidline-form',
				    'enableAjaxValidation' => false,
				    //'action'               => Yii::app()->createUrl('/guidline/default/contacts')
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
	</div>

</div>
