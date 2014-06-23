<div class="basket auth">
	<div class="site-width">
<?php if($status==null):?>
	<h3 style="color: #fff"><?php echo Yii::t('themes', 'Неверный запрашиваемый ключ'); ?></h3>
	
<?php elseif($status==true):?>
	<h3 style="color: #fff"><?php echo Yii::t('themes', 'Вы успешно отписались от рассылки'); ?></h3>
	
<?php elseif($status==false):?>
	<h3 style="color: #fff"><?php echo Yii::t('themes', 'Произошла ошибка. Попробуйте еще раз попозже.'); ?></h3>
	
<?php endif;?>
</div>
</div>

<?php

	Yii::import('application.modules.tip.widgets.PlansSubscriptions.PlansSubscriptions');
	$this->widget('PlansSubscriptions');
	
?>