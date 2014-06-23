<?php
		Yii::app()->clientScript->registerMetaTag(Yii::app()->config->get('META_K_PAGE_ABOUT'), 'keywords');
		Yii::app()->clientScript->registerMetaTag(Yii::app()->config->get('META_D_PAGE_ABOUT'), 'description');
		$this->pageTitle = 'About BOF';
?>
<div class="about-slide"></div>
<div id="q1"></div>
<?php //Yii::app()->user->id; ?>
<div class="site-width">
	<div class="about-us">
		<div class="about-left">
			<div class="title">
				<?php echo Yii::t('themes', '<span class="bold">О</span> <span>БОФ</span> '); ?>
			</div>
			<div class="about-menu">
				<a href="#q1"><?php echo Yii::t('themes', 'Наша команда'); ?></a>
				<a href="#q2"><?php echo Yii::t('themes', 'История БОФ'); ?></a>
				<?php echo CHtml::link(Yii::t('themes', 'Стать партнером'), array('/guidline/default/contacts'));?>
			</div>
			<span class="blue-text"><?php echo Yii::t('themes', 'Ничего<br>больше<br><span>просто<br>ставки<br>на футбол</span>'); ?></span>
		</div>
		<div id="q1" class="questions">
			<div class="question">
				<span class="q-name"><?php echo Yii::t('themes', 'Кто мы?'); ?></span>
				<span class="q-caps"><?php echo Yii::t('themes', 'МЫ КОМАНДА ПРОФЕССИОНАЛОВ, КОТОРЫЕ ЧУВСТВУЮТ СТРАСТЬ К ФУТБОЛУ, КАК И ТЫ!'); ?><br/></span>
				<span id="q2" class="q-little"><?php echo Yii::t('themes', 'МЫ НЕ ТОЛЬКО БОЛЕЛЬЩИКИ, НАБЛЮДАЮЩИЕ ЗА СВОИМИ ЛЮБИМЫМИ КОМАНДАМИ, НО И ТЕ, КТО ОЧАРОВАНЫ КРАСОТОЙ ВЛАДЕНИИ МЯЧОМ, ТАКТИКОЙ, СТАТИСТИКОЙ, АТМОСФЕРОЙ КОНКУРЕНЦИИ ВО ВРЕМЯ ИГРЫ С ДРУГИМИ КОМАНДАМИ - КАК И ТЫ!'); ?></span>
				<span class="q-little">There is a truth saying that if we earn our living by what we like, we are free to consider ourselves happy.<br/><br/>
				The BetOnFootball family can fairly call itself happy because we do not only like the business we do but moreover we live in the world of football, talk about it with friends and wait impatiently for another sports event, just like you!
				</span>
			</div>
			<div class="question">
				<span class="q-name"><?php echo Yii::t('themes', 'Для чего?'); ?></span>
				<span class="q-caps">WE’RE SURE THAT FOOTBALL ISN’T JUST A GAME BUT A WHOLE SCIENCE. IF ONE WISHES TO ACHIEVE SCIENTIFIC BREAKTHROUGHS AND ENJOY CIVILIZATION GOODS HE HAS TO ANALYZE CONSTANTLY THE DATA, GET NEW INFORMATION AND LINE UP THE RESULT IN STRINGS OF LOGIC.</span>
				<span class="q-little">Like doctors who study their patient’s life history and prescribe relevant tests and analyses to diagnose him or her, we spend a lot of time watching all the games of all the teams we suggest betting on. We monitor players’ injures, transfers, information in mass-media, statistics and the whole information realm round a match. If you don’t want to spend time studying all the issues mentioned above, you’d better put yourself in hands of professionals! Cause we want to earn money just the way you do, that’s why we analyze responsibly every match.<br/><br/>
				We choose thoroughly our tipsters. The most vivid example is our top tipster Mantis. All new forecasters join us only after being evaluated by Mantis.<br/><br/>
				Our football betting experience numbers 12 years already. We’ve put our passion for football and hunger for betting profits in this project.
				</span>
				<span class="q-caps">TODAY WE’RE READY TO SHARE OUR KNOWLEDGE WITH YOU AND THE REST OF THE WORLD.</span>
				<span class="q-romb">If you really love football, just the way we do…</span>
				<span class="q-romb">If you really want to know more than others, just the way we do…</span>
				<span class="q-romb">If you really want to earn good money doing things you like, just the way we do…</span>
				<span class="q-romb">If you really want to enjoy results of your bets, just the way we do…</span>
				<span class="q-little">Then join now the BetOnFootball family and start earning on your bets more than you’ve ever done before. And tomorrow you will afford yourself what you have long dreamed of.<br/><br/>
				Start winning today together with us. We gather only the best of you here in our family – the same people like you!
				</span>
			</div>
		</div>
	</div>
</div>
