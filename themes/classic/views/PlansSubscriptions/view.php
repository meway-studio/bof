<div class="plans" style="<?php echo $style; ?>">
	<div class="site-width">
		<div class="title">
			<span class="bold"><?php echo Yii::app()->config->get('SUBSCRIPTION_TITLE');?></span>
			<span class="top"><?php echo Yii::app()->config->get('SUBSCRIPTION_TEXT');?></span>
		</div>
		<div class="frame-box">
		
		<a href="<?php echo Yii::app()->createAbsoluteUrl('/tip/default/buysubscription', array('term'=>'weekend'));?>">
			<div class="frame weekend">
				<div>
					<span class="plans-name"><?php echo Yii::t('themes', 'Неделя') ?></span>
					<span class="plans-count one"><?php echo Yii::t('themes', 'евро') ?> <?php echo $data['WEEKEND'];?></span>
					<span class="plans-save"><?php echo Yii::app()->config->get('SUBSCRIPTION_WEEKEND_PRICE_SAVE');?></span>
					<span class="plans-info"><?php echo Yii::app()->config->get('SUBSCRIPTION_WEEKEND_TEXT');?></span>
				</div>
				<a class="plans-button" href="<?php echo Yii::app()->createAbsoluteUrl('/tip/default/buysubscription', array('term'=>'weekend'));?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo Yii::t('themes', 'Купить') ?></a>
			</div>
		</a>
		
		<a href="<?php echo Yii::app()->createAbsoluteUrl('/tip/default/buysubscription', array('term'=>'month'));?>">
			<div class="frame">
				<div>
					<span class="plans-name"><?php echo Yii::t('themes', 'Месяц') ?></span>
					<span class="plans-count two"><?php echo Yii::t('themes', 'евро') ?> <?php echo $data['MONTH'];?></span>
					<span class="plans-save"><?php echo Yii::app()->config->get('SUBSCRIPTION_MONTH_PRICE_SAVE');?></span>
					<span class="plans-info"><?php echo Yii::app()->config->get('SUBSCRIPTION_MONTH_TEXT');?></span>
				</div>
				<a class="plans-button" href="<?php echo Yii::app()->createAbsoluteUrl('/tip/default/buysubscription', array('term'=>'month'));?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo Yii::t('themes', 'Купить') ?></a>
			</div>
		</a>
		
		<a href="<?php echo Yii::app()->createAbsoluteUrl('/tip/default/buysubscription', array('term'=>'3month'));?>">
			<div class="frame">
				<div>
					<span class="plans-name"><?php echo Yii::t('themes', '3 месяца') ?></span>
					<span class="plans-count three"><?php echo Yii::t('themes', 'евро') ?> <?php echo $data['3MONTH'];?></span>
					<span class="plans-save"><?php echo Yii::t('themes', 'евро') ?> <?php echo Yii::app()->config->get('SUBSCRIPTION_3MONTH_PRICE_SAVE');?></span>
					<span class="plans-info"><?php echo Yii::app()->config->get('SUBSCRIPTION_3MONTH_TEXT');?></span>
				</div>
				<a class="plans-button" href="<?php echo Yii::app()->createAbsoluteUrl('/tip/default/buysubscription', array('term'=>'3month'));?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo Yii::t('themes', 'Купить') ?></a>
			</div>
		</a>
		
		<a href="<?php echo Yii::app()->createAbsoluteUrl('/tip/default/buysubscription', array('term'=>'season'));?>">
			<div class="frame">
				<div>
					<span class="plans-name"><?php echo Yii::t('themes', 'Сезон') ?></span>
					<span class="plans-count four"><?php echo Yii::t('themes', 'евро') ?> <?php echo $data['SEASON'];?></span>
					<span class="plans-save"><?php echo Yii::t('themes', 'евро') ?> <?php echo Yii::app()->config->get('SUBSCRIPTION_SEASON_PRICE_SAVE');?></span>
					<span class="plans-info"><?php echo Yii::app()->config->get('SUBSCRIPTION_SEASON_TEXT');?></span>
				</div>
				<a class="plans-button" href="<?php echo Yii::app()->createAbsoluteUrl('/tip/default/buysubscription', array('term'=>'season'));?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo Yii::t('themes', 'Купить') ?></a>
			</div>
		</a>
		
		</div>
	</div>
</div>