<div class="auth">
	<div class="site-width">
		<ul>
			<li><?php echo CHtml::link(Yii::t('themes', 'Войти'), array(Yii::app()->user->loginUrl));?></li>
			<li><?php echo CHtml::link(Yii::t('themes', 'Зарегистрироваться'), array('/user/default/signup'));?></li>
			<li class="active"><?php echo CHtml::link(Yii::t('themes', 'Забыли пароль?'), array('/user/default/forgot'));?></li>
		</ul>
		<div class="connect">
			<div class="social">
				<?php Yii::app()->eauth->renderWidget(array('action'=> Yii::app()->createUrl('/user/default/login'))); ?>
			</div>
			<div class="or">
				<span class="line-middle"></span>
				<span><?php echo Yii::t('themes', 'ИЛИ'); ?></span>
				<span class="line-middle"></span>
			</div>
			<div class="autorization">
				
				<?php if(Yii::app()->user->hasFlash('forgotSuccess')):?>
					<span class="success" style="margin: 20px auto;height: 25px;"><?php echo Yii::app()->user->getFlash('forgotSuccess');?></span>
				<?php elseif(Yii::app()->user->hasFlash('forgotFailure')): ?>
					<!--span class="error"><?php echo Yii::app()->user->getFlash('forgotFailure');?></span-->
				<?php endif; ?>

				<?php $form=$this->beginWidget('CActiveForm', array(
				    'id'=>'user-forgot-form',
				    'enableAjaxValidation'=>false,
				)); ?>

					<?php echo $form->errorSummary($model); ?>
					<div style="background-color: #fff;">
					<span style="margin: 0px;">
						<img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/menu/log.png">
						<?php echo $form->textField($model,'email', array('class'=>'log','placeholder'=>'E-mail')); ?>
					</span>

					<?php echo CHtml::submitButton(Yii::t('themes', 'Напомните'), array('class'=>'login-but')); ?>
					</div>
				<?php $this->endWidget(); ?>
			</div>
		</div>
	</div>
</div>