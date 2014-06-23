<div style="border-bottom: 2px solid #fff;padding-bottom: 30px;">
	<div class="site-width">
		<div class="track-record">
			<div class="title">
				<span class="bold"><?php echo Yii::app()->config->get('TRACK_RECORD_TITLE');?></span>
				<span class="top"><?php echo Yii::app()->config->get('TRACK_RECORD_TEXT');?></span>
			</div>
			
			<div class="bottom">
				<div class="box">
					<img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/record/icon1.png">
					<span class="title"><?php echo Yii::t('themes', '{n} год|{n} года|{n} лет|{n} лет', $data['years']); ?></span>
					<span class="info"><?php echo Yii::t('themes', 'Назад мы начали'); ?></span>
				</div>
				<div class="box">
					<img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/record/icon2.png">
					<span class="title"><?php echo Yii::t('themes', '{n} автор|{n} автора|{n} авторов|{n} авторов', $data['tipsters_count']); ?></span>
					<span class="info"><?php echo Yii::t('themes', 'С большим опытом'); ?></span>
				</div>
				<div class="box">
					<img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/record/icon3.png">
					<span class="title"><?php echo $data['tips_count'];?></span>
					<span class="info"><?php echo Yii::t('themes', 'Приведенных советов'); ?></span>
				</div>
				<div class="box">
					<img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/record/icon4.png">
					<span class="title"><?php echo $data['all_winrate'];?>%</span>
					<span class="info"><?php echo Yii::t('themes', 'Общий доход (ROI)'); ?></span>
				</div>
				<div class="box">
					<img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/record/icon5.png">
					<span class="title"><?php echo $data['all_profit'];?></span>
					<span class="info"><?php echo Yii::t('themes', 'Общая прибыль (единица)'); ?></span>
				</div>
			</div>
		</div>
	</div>
</div>
<?php /*
<div style="border-bottom: 2px solid #fff;padding-bottom: 30px;">
	<div class="site-width">
		<div class="track-record">
			<div class="title">
				<span class="bold"><?php echo Yii::app()->config->get('TRACK_RECORD_TITLE');?></span>
				<span class="top"><?php echo Yii::app()->config->get('TRACK_RECORD_TEXT');?></span>
			</div>
			
			<div class="bottom">
				<div class="box">
					<img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/record/icon1.png">
					<span class="title"><?php echo Yii::app()->config->get('TRACK_RECORD_YEAR');?> Years</span>
					<span class="info">Since We Started</span>
				</div>
				<div class="box">
					<img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/record/icon2.png">
					<span class="title"><?php echo Yii::app()->config->get('TRACK_RECORD_TIPSTERS');?> Tipsters</span>
					<span class="info">With experience of thirteen</span>
				</div>
				<div class="box">
					<img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/record/icon3.png">
					<span class="title"><?php echo Yii::app()->config->get('TRACK_RECORD_TIPS_GIVER');?></span>
					<span class="info">Tips all given</span>
				</div>
				<div class="box">
					<img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/record/icon4.png">
					<span class="title"><?php echo Yii::app()->config->get('TRACK_RECORD_TIPS_COME');?></span>
					<span class="info">Of our tips come true</span>
				</div>
				<div class="box">
					<img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/record/icon5.png">
					<span class="title">&euro; <?php echo Yii::app()->config->get('TRACK_RECORD_MEMBERS');?></span>
					<span class="info">Total Members Winnings</span>
				</div>
			</div>
		</div>
	</div>
</div>
*/ ?>