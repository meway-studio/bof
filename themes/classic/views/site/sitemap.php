<?php
		Yii::app()->clientScript->registerMetaTag(Yii::app()->config->get('META_K_PAGE_ABOUT'), 'keywords');
		Yii::app()->clientScript->registerMetaTag(Yii::app()->config->get('META_D_PAGE_ABOUT'), 'description');
		$this->pageTitle = Yii::t('themes', 'Сайтмап');
?>

<div class="site-width">
	<div class="guidline-us">
		<div class="guidline-left">
			<div class="title">
				<?php echo Yii::t('themes', '<span class="bold">Сайт</span> <span>Мап</span>'); ?>
			</div>

			<div class="guidline-menu">
				
			</div>

		</div>
		<div class="questions">
			
			<ul style="border: 0px;">
				<li>
					<?php echo CHtml::link(Yii::t('themes', 'Главная'), array('/'));?>
					<div class="big_hor" style="width: 40px;"></div>
					<ul style="margin-left: 85px;">
						<li>
							<span class="hor"></span><span class="ver"></span><?php echo CHtml::link(Yii::t('themes', 'Авторы'),array('/tip/default/tipsters')); ?>
							<div class="big_hor"></div>
							<ul>
								<li><span class="hor"></span><span class="ver"></span><?php echo CHtml::link(Yii::t('themes', 'Команда БОФ'), array('/tip/default/allstat'));?></li>
							<?php foreach($model AS $item):?>
								<li><span class="hor"></span><span class="ver"></span><?php echo CHtml::link($item->FullName, array('/tip/default/stat', 'id'=>$item->id));?></li>
							<?php endforeach;?>
							</ul>
						</li>
						<li><span class="hor"></span><span class="ver"></span><?php echo CHtml::link(Yii::t('themes', 'О компании'), array('/site/page','view'=>'about')); ?></li>
						<li><span class="hor"></span><span class="ver"></span><?php echo CHtml::link(Yii::t('themes', 'Видео'),array('/guidline/default/video')); ?></li>
						<li>
							<span class="hor"></span><span class="ver"></span><?php echo CHtml::link(Yii::t('themes', 'Гайдлайн'),array('/site/page','view'=>'manual')); ?>
							<div class="big_hor" style="width: 182px;"></div>
							<ul>
								<li><span class="hor"></span><span class="ver"></span><?php echo CHtml::link(Yii::t('themes', 'Как это работает и как это использовать'),array('/site/page','view'=>'how')); ?></li>
								<li><span class="hor"></span><span class="ver"></span><?php echo CHtml::link(Yii::t('themes', 'Руководство пользователя'),array('/site/page','view'=>'manual')); ?></li>
								<li><span class="hor"></span><span class="ver"></span><?php echo CHtml::link(Yii::t('themes', '12 золотых правил'),array('/guidline/default/index')); ?></li>
								<li><span class="hor"></span><span class="ver"></span><?php echo CHtml::link(Yii::t('themes', 'Почему вы выбрали BOF'),array('/site/page','view'=>'choose')); ?></li>
								<li><span class="hor"></span><span class="ver"></span><?php echo CHtml::link(Yii::t('themes', 'Часто задаваемый вопросы'),""); ?></li>
							</ul>
						</li>
						<li><span class="hor"></span><span class="ver"></span><?php echo CHtml::link(Yii::t('themes', 'Контакты'),array('/guidline/default/contacts')); ?></li>
						<li><span class="hor"></span><span class="ver"></span><?php echo CHtml::link(Yii::t('themes', 'План подписки'),array('/tip/default/subscription')); ?></li>
						<li><span class="hor"></span><span class="ver"></span><?php echo CHtml::link(Yii::t('themes', 'ТЕРМИНЫ &amp; УСЛОВИЯ РАБОТЫ'),array('/site/page','view'=>'terms')); ?></li>
						<li><span class="hor"></span><span class="ver"></span><?php echo CHtml::link(Yii::t('themes', 'ПОЛИТИКА КОНФИДЕНЦИАЛЬНОСТИ'),array('/site/page','view'=>'privacy')); ?></li>
						<li><span class="hor"></span><span class="ver"></span><?php echo CHtml::link(Yii::t('themes', 'ПОЛИТИКА ВОЗВРАТА'),array('/site/page','view'=>'refund')); ?></li>
					</ul>
				</li>
			</ul>
			
		</div>
	</div>
</div>
<style>
	.guidline-us a {
		color: #488be2;
	}
	.guidline-us ul {
		border-left: 1px solid #cfd8e6;
	}
	.guidline-us ul li {
		background: none;
		padding: 0px;
	}
	.guidline-us ul ul {
		margin: 0px 0px 0px 300px;
		position: relative;
		top: -19px;
	}
	.hor {
		display: inline-block;
		vertical-align: middle;
		width: 39px;
		height: 1px;
		background: #cfd8e6;
	}
	.big_hor {
		display: inline-block;
		vertical-align: middle;
		width: 187px;
		height: 1px;
		background: #cfd8e6;
	}
	.ver {
		display: inline-block;
		vertical-align: middle;
		width: 1px;
		height: 11px;
		background: #cfd8e6;
		margin-right: 10px;
	}
</style>
