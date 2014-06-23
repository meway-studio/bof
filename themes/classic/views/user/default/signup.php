<div class="auth">
	<div class="site-width">
		<ul>
			<li><?php echo CHtml::link(Yii::t('themes', 'Войти'), array(Yii::app()->user->loginUrl));?></li>
			<li class="active"><?php echo CHtml::link(Yii::t('themes', 'Зарегистрироваться'), array('/user/default/signup'));?></li>
			<li><?php echo CHtml::link(Yii::t('themes', 'Забыли пароль?'), array('/user/default/forgot'));?></li>
		</ul>
		<div class="connect">

			<div class="autorization">


				<?php $form=$this->beginWidget('CActiveForm', array(
				    'id'=>'user-update-form',
					'htmlOptions'=>array("style"=>"width: 482px;"),
				    'enableAjaxValidation'=>false,
				)); ?>
				<?php if(Yii::app()->user->hasFlash('signupSuccess')):?>
					<span class="success" style="padding: 6px 0px 6px 75px;width: 460px;height: auto;margin: 10px 60px 10px 0px;display: inline-block;"><?php echo Yii::app()->user->getFlash('signupSuccess');?></span>
				<?php elseif(Yii::app()->user->hasFlash('signupFailure')): ?>
					<!--span class="error"><?php echo Yii::app()->user->getFlash('signupFailure');?></span-->
				<?php endif; ?>

					<?php echo $form->errorSummary($model); ?>

					<span class="name">
						<img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/menu/log.png">
						<?php echo $form->textField($model,'firstname', array('size'=>38,'placeholder'=>Yii::t('themes', 'Имя'))); ?>
					</span>
					<span class="mail">
						<img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/menu/dog.png">
						<?php echo $form->textField($model,'email', array('size'=>38,'placeholder'=>Yii::t('themes', 'Email'))); ?>
					</span>
					<?php /*
					<span class="phone">
						<img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/menu/phon.png">
						<?php echo $form->textField($model,'phone', array('size'=>38,'placeholder'=>'Phone')); ?>
					</span>
					*/ ?>
					<span class="password">
						<img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/menu/pas.png">
						<?php echo $form->passwordField($model,'password', array('size'=>38,'placeholder'=>Yii::t('themes', 'Пароль'))); ?>
					</span>
					<?php echo CHtml::submitButton(Yii::t('themes', 'Зарегистрироваться'), array('class'=>'signup-but')); ?>
				<?php $this->endWidget(); ?>
			</div>
		</div>
	</div>
</div>