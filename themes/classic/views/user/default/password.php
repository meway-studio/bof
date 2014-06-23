<div class="my-account">
	<div class="site-width">

		<div class="page-title">
			<span class="title"><span><?php echo Yii::t('themes', 'Изменить'); ?></span><?php echo Yii::t('themes', 'Пароль'); ?></span>
			<span class="text">
				Betonfootball is designed for you, the user. Therefore if you have any questions regarding anything on our site or you need help using any of our services, don't hesitate to contact us using the support form below and we will reply as soon as possible.
				<br />
				<?php if(Yii::app()->user->hasFlash('passwordSuccess')):?>
					<span class="success"><?php echo Yii::app()->user->getFlash('passwordSuccess');?></span>
				<?php elseif(Yii::app()->user->hasFlash('passwordFailure')): ?>
					<span class="error"><?php echo Yii::app()->user->getFlash('passwordFailure');?></span>
				<?php endif; ?>
			</span>
		</div>

		<div class="personal">
			<div class="information">
				<span><?php echo Yii::t('themes', 'Изменить пароль'); ?></span>

			<?php if($user->confirm==1): ?>

				<?php $form=$this->beginWidget('CActiveForm', array(
				    'id'=>'user-password-form',
				    'enableAjaxValidation'=>false,
				)); ?>

					 <?php echo $form->errorSummary($model); ?>

					<span class="password">
						<?php echo $form->passwordField($model,'temp_password', array('size'=>38,'placeholder'=>Yii::t('themes', 'Новый пароль'))); ?>
					</span>
					
					<span class="password">
						<?php echo $form->passwordField($model,'password', array('size'=>38,'placeholder'=>Yii::t('themes', 'Старый пароль'))); ?>
					</span>
					
					<?php echo CHtml::submitButton(Yii::t('tips', 'Сохранить'), array('class'=>'updateprofile-but')); ?>

				<?php $this->endWidget(); ?>

			<?php else: ?>
				<span><?php echo Yii::t('themes', 'Вы должны подтвердить Ваш адрес электронной почты'); ?></span>
			<?php endif; ?>

			</div>
		</div>

	</div>
</div>