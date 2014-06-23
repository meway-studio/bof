<div class="prolong">
	<div style="color: #603913; font-size: 18px; text-transform: uppercase; text-align: left;">
		<?php echo Yii::t('themes', 'Истекает срок действия подписки:'); ?>
	</div>
	<div style="color: #e9573f; font-size: 14px; text-align: left;margin: 10px 0px;text-align: center;">
		<img style="display: inline-block; margin: 0px 5px 0px 0px;vertical-align: bottom;" src="/themes/classic/css/images/prolong.png">
		<?php echo $model->ExpDays; ?> <?php echo Yii::t('themes', ' дней'); ?>
	</div>
	<?php echo CHtml::link(Yii::t('themes', 'Продлить'), array('/tip/default/subscription') ,array('class'=>'yellow'));?>
</div>