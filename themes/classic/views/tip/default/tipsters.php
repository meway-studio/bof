<div class="site-width">

	<div class="stats-all-time">
		<div class="title">
			<span class="bold"><?php echo Yii::t('themes', 'Статистика'); ?></span>
			<!--<span> <?php echo Yii::t('themes', 'За все время'); ?></span>-->
		</div>
		<div class="profile">

			<div class="tipster-inf">
				<div class="top">
					<div style="overflow: hidden;">
						<div style="display: inline-block; position: relative;">
							<img class="image" src="/themes/classic/css/images/menu/no_avatar.png" alt="">
							<img class="img_pattern" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/tips/img_pattern_fff.png">
						</div>
						<div class="some-inf">
							<span><?php echo Yii::t('themes', 'Общий'); ?></span>
							<span class="big"><?php echo $bof['profit'];?></span>
							<span><?php echo Yii::t('themes', 'Прибыль'); ?></span>
							<span><?php echo Yii::t('themes', 'ROI (Доход)'); ?><span> <?php echo $bof['yield'];?>%</span></span>
						</div>
					</div>
					<span class="name"><?php echo $bof['name'];?></span>
					<span class="status"><?php echo $bof['rank'];?></span>
					<span class="devis"><?php echo $bof['comment'];?></span>
					<div class="some-inf-bottom">
						<a class="stats" href="<?php echo Yii::app()->createUrl('/tip/default/allstat');?>">
							<span class="pixel active"></span>
							<span><?php echo Yii::t('tips', 'Статистика'); ?></span>
						</a>
						<a class="tips" href="<?php echo Yii::app()->createUrl('/tip/default/list'); ?>">
							<span class="pixel active"></span>
							<span class="how-mutch"><?php echo $bof['activeCount'];?></span>
							<span><?php echo Yii::t('themes', 'Советы'); ?></span>
						</a>
						<a class="subscribe" href="<?php echo Yii::app()->createUrl('/tip/default/subscription'); ?>" style="margin-right: 0px;">
							<span class="pixel active"></span>
							<span><?php echo Yii::t('themes', 'Подписки'); ?></span>
						</a>
					</div>
				</div>
				<div class="bottom">
					<span><?php echo $bof['tips'];?><span><?php echo Yii::t('themes', 'Количество советов'); ?></span></span>
					<span><?php echo round($bof['winrate'],0);?>%<span><?php echo Yii::t('themes', 'Количество побед'); ?></span></span>
					<span style="margin-right: 0;"><?php echo $bof['odds'];?><span><?php echo Yii::t('themes', 'Средний коэффициент'); ?></span></span>
				</div>
			</div>

		<?php foreach($model AS $data):?>
			<div class="tipster-inf">
				<div class="top">
					<div style="overflow: hidden;">
						<div style="display: inline-block; position: relative;">
							<?php echo CHtml::image($data->photoOriginal, '', array('class'=>'image'));?>
							<img class="img_pattern" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/tips/img_pattern_fff.png">
						</div> 
						<div class="some-inf">
							<span><?php echo Yii::t('themes', 'Общая прибыль'); ?></span>
							<span class="big"><?php echo $data->tipster->profit;?></span>
							<span><?php echo Yii::t('themes', 'Прибыль'); ?></span>
							<span><?php echo Yii::t('themes', 'ROI (Доход)'); ?><span> <?php echo $data->tipster->yield;?>%</span></span>
						</div>
					</div>
					<span class="name"><?php echo $data->FullName;?></span>
					<span class="status"><?php echo $data->tipster->rank;?></span>
					<span class="devis"><?php echo $data->tipster->comment;?></span>
					<div class="some-inf-bottom">
						<a class="stats" href="<?php echo Yii::app()->createUrl('/tip/default/stat', array('id'=>$data->id) );?>">
							<span class="pixel active"></span>
							<span><?php echo Yii::t('tips', 'Статистика'); ?></span>
						</a>
						<a class="tips" href="<?php echo Yii::app()->createUrl('/tip/default/list', array('tipster'=>$data->id) );?>">
							<span class="pixel active"></span>
							<span class="how-mutch"><?php echo $data->tipster->activeCount;?></span>
							<span><?php echo Yii::t('themes', 'Советы'); ?></span>
						</a>
						<a class="subscribe" href="<?php echo Yii::app()->createUrl('/tip/default/subscription');?>" style="margin-right: 0px;">
							<span class="pixel active"></span>
							<span><?php echo Yii::t('themes', 'Подписки'); ?></span>
						</a>
					</div>
				</div>
				<div class="bottom">
					<span><?php echo $data->tipster->tips;?><span><?php echo Yii::t('themes', 'Количество советов'); ?></span></span>
					<span><?php echo $data->tipster->winrate;?><span><?php echo Yii::t('themes', 'Количество побед'); ?></span></span>
					<span style="margin-right: 0;"><?php echo $data->tipster->odds;?><span><?php echo Yii::t('themes', 'Средний коэффициент'); ?></span></span>
				</div>
			</div>
		<?php endforeach;?>
		</div>
	</div>

</div>