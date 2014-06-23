<div class="auth">
	<div class="site-width">
		<ul>
			<li class="active"><?php echo CHtml::link(Yii::t('themes', 'Войти'), array(Yii::app()->user->loginUrl));?></li>
			<li><?php echo CHtml::link(Yii::t('themes', 'Зарегистрироваться'), array('/user/default/signup'));?></li>
			<li><?php echo CHtml::link(Yii::t('themes', 'Забыли пароль?'), array('/user/default/forgot'));?></li>
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
				<?php $form=$this->beginWidget('CActiveForm', array(
				    'id'=>'login-form',
				    'enableAjaxValidation'=>false,
				)); ?>
					<?php echo $form->errorSummary($model); ?>
					<div style="background-color: #fff;">
						<span style="margin: 0px; width: auto;">
							<img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/menu/log.png">
							<?php echo $form->textField($model,'username', array('class'=>'log','placeholder'=>Yii::t('themes', 'Введите Ваш Email'))); ?>
						</span>

						<span style="margin: 0px; width: auto;">
							<img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/menu/pas.png">
							<?php echo $form->passwordField($model,'password', array('class'=>'pas','placeholder'=>Yii::t('themes', 'Пароль'))); ?>
						</span>

						<?php echo CHtml::submitButton(Yii::t('themes', 'Войти'), array('class'=>'login-but')); ?>

					</div>
				<?php $this->endWidget(); ?>
			</div>
		</div>
	</div>
</div>