<div class="left">
	<?php echo CHtml::image($weather['weatherIconUrl'], '', array('class'=>'top', 'width'=>30)); ?>
	<div class="bottom weather">
		<span class="bold"><?php echo @$weather['temp_C'];?></span>&deg;<span class="bold">C</span>
	</div>
</div>
<div class="right">
	<span class="top"><?php echo Yii::t('themes', 'Погода'); ?></span>
	<a href="#" class="bottom city bold"><?php echo @$location['city'];?></a>
</div>