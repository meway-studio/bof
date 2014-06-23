<div class="site-width">
	<?php foreach($tipsters as $tipster):?>
		<div class="tipster-inf">
			<div class="top">
				<img src="css/images/stats/profile_avat.png">
				<div class="some-inf">
					<span class="big">+5842</span>
					<span><?php echo Yii::t('themes', 'Прибыль')?></span>
					<span><?php echo Yii::t('themes', 'Доход')?><span> 13.64%</span></span>
				</div>
				<span class="name">Mantis</span>
				<span class="status"><?php echo Yii::t('themes', 'Главный автор BOF')?></span>
				<span class="devis">Any player is inherently a hot-tempered person, that’s why it’s important to keep your head.</span>
				<div class="some-inf-bottom">
					<a class="stats" href="#">
						<span class="pixel"></span>
						<span><?php echo Yii::t('themes', 'Статистика')?></span>
					</a>
					<a class="tips" href="">
						<span class="pixel"></span>
						<span class="how-mutch">1</span>
						<span><?php echo Yii::t('themes', 'Советов')?></span>
					</a>
					<a class="articles" href="#" style="margin-right: 0px;">
						<span class="pixel"></span>
						<span><?php echo Yii::t('themes', 'Статей')?></span>
					</a>
				</div>
			</div>
			<div class="bottom">
				<span>358<span><?php echo Yii::t('themes', 'Количество советов')?></span></span>
				<span>53%<span><?php echo Yii::t('themes', 'Количество побед')?> %</span></span>
				<span style="margin-right: 0;">2.38<span><?php echo Yii::t('themes', 'Средний коэффициент')?></span></span>
			</div>
		</div>
	<?php endforeach;?> 
</div>