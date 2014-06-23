<div class="my-account">
	<div class="site-width">

		<div class="page-title">
			<span class="title"><span><?php echo Yii::t('themes', 'Изменить'); ?></span><?php echo Yii::t('themes', 'пароль'); ?></span>
			<span class="text">
				Betonfootball is designed for you, the user. Therefore if you have any questions regarding anything on our site or you need help using any of our services, don't hesitate to contact us using the support form below and we will reply as soon as possible.
				<br />
				<?php if(Yii::app()->user->hasFlash('restoreSuccess')):?>
					<span class="success"><?php echo Yii::app()->user->getFlash('restoreSuccess');?></span>
				<?php elseif(Yii::app()->user->hasFlash('restoreFailure')): ?>
					<span class="error"><?php echo Yii::app()->user->getFlash('restoreFailure');?></span>
				<?php endif; ?>
			</span>
		</div>

		<div class="personal">
			<div class="information">
				<span><?php echo Yii::t('themes', 'Изменить пароль'); ?></span>

				<?php $form=$this->beginWidget('CActiveForm', array(
				    'id'=>'user-password-form',
				    'enableAjaxValidation'=>false,
				)); ?>

					 <?php echo $form->errorSummary($model); ?>

					<span class="password">
						<?php echo $form->passwordField($model,'password', array('size'=>38,'placeholder'=>Yii::t('themes', 'Новый пароль'))); ?>
					</span>
					
					<?php echo CHtml::submitButton(Yii::t('themes', 'Изменить'),array("class"=>"updateprofile-but")); ?>

				<?php $this->endWidget(); ?>

			</div>
		</div>

	</div>
</div>