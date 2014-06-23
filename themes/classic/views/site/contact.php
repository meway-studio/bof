<div class="site-width">

	<div class="contact-form">
		<div class="title">
			<span class="bold"><?php echo Yii::app()->config->get('CONTACT_HEADER');?></span>
			<span></span>
			<span class="text"><?php echo Yii::app()->config->get('CONTACT_TEXT');?></span>
		</div>
		<div class="hello">
			<span class="say-hi"><?php echo Yii::app()->config->get('CONTACT_TITLE');?></span>
			<div class="line"></div>
			<div class="phone">
				<span><?php echo Yii::t('themes', 'Телефон'); ?><span><?php echo Yii::app()->config->get('CONTACT_PHONE');?></span></span>
			</div>
			<div class="line"></div>
			<div class="mail">
				<span><?php echo Yii::t('themes', 'Электронная почта'); ?><span><?php echo Yii::app()->config->get('CONTACT_EMAIL_1');?></span><span><?php echo Yii::app()->config->get('CONTACT_EMAIL_2');?></span><span>info@betonfootball.eu</span></span>
			</div>
			<div class="line"></div>
			<div class="skype">
				<span><?php echo Yii::t('themes', 'Скайп'); ?><span><?php echo Yii::app()->config->get('CONTACT_SKYPE');?></span></span>
			</div>
			<div class="line"></div>
		</div>
		<div class="help">
			<form>
				<span class="say-hi"></span>
				<input class="question" size="38" value="<?php echo Yii::t('themes', 'Вопрос'); ?>">
				<textarea class="details"><?php echo Yii::t('themes', 'Подробнее'); ?></textarea>
				<input class="name warn-name" size="38" value="<?php echo Yii::t('themes', 'Имя'); ?>">
				<span class="oops"><?php echo Yii::t('themes', 'Ой, произошла ошибка.'); ?></span>
				<input class="mail" size="38" value="<?php echo Yii::t('themes', 'Ваш E-mail'); ?>">
				<input class="submit" type="submit" value="<?php echo Yii::t('themes', 'Отправить'); ?>">
			</form>
			<div class="error">
				<span><?php echo Yii::t('themes', 'Ошибка. Попробуйте еще раз.'); ?></span>
				<a href="#"><?php echo Yii::t('themes', 'Попробуйте еще раз'); ?></a>
			</div>
			<div class="submitted">
				<span><?php echo Yii::t('themes', 'Сообщение отправлено. Спасибо!'); ?></span>
				<a href="#"><?php echo Yii::t('themes', 'Отправить еще'); ?></a>
			</div>
		</div>
	</div>

</div>