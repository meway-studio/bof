<div class="my-account">
	<div class="site-width">

		<div class="page-title">
			<span class="title"><span><?php echo Yii::t('themes', 'Подтвердить'); ?></span>email</span>
			<span class="text">Betonfootball is designed for you, the user. Therefore if you have any questions regarding anything on our site or you need help using any of our services, don't hesitate to contact us using the support form below and we will reply as soon as possible.</span>
		</div>

		<div class="personal">
			<div class="information">
				<span><?php echo Yii::t('themes', 'Подтвердить email'); ?></span>

				<?php if(Yii::app()->user->hasFlash('confirmSuccess')):?>
					<span class="success"><?php echo Yii::app()->user->getFlash('confirmSuccess');?></span>
				<?php elseif(Yii::app()->user->hasFlash('confirmFailure')): ?>
					<span class="error"><?php echo Yii::app()->user->getFlash('confirmFailure');?></span>
				<?php endif; ?>

			</div>
		</div>

	</div>
</div>