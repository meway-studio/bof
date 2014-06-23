<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - ' . Yii::t('themes', 'Ошибка');
$this->breadcrumbs=array(
	Yii::t('themes', 'Ошибка'),
);
?>
<div class="error404">
	<div class="site-width">
		<div style="width: 500px;float: right;">
			<h2 style="font-size: 120px;color:#f1473b;font-weight: 100;margin: 100px 0px 0px 0px;text-align: center;"><?php echo $code; ?></h2>
			<div style="font-size: 54px;color:#fff;font-weight: 300;text-align: center;line-height: 120px;"><?php echo Yii::t('themes', 'ЗДРАВСТВУЙ, МОЙ ДРУГ'); ?></div>
			<!--<div style="font-size: 110px;color:#4b89dc;font-weight: 500;text-align: center;line-height: 100px;"><?php echo Yii::t('themes', 'ВЫ'); ?></div>-->
			<div style="font-size: 54px;color:#4b89dc;font-weight: 300;text-align: center;line-height: 50px;"><?php echo Yii::t('themes', 'МЕНЯ ИЩЕТЕ?'); ?></div>
			<div style="font-size: 90px;color:#fff;font-weight: 500;text-align: center;"><?php echo Yii::t('themes', 'В САМОМ ДЕЛЕ?'); ?></div>
			<a href="/" style="display: block;font-size: 20px;color:#fff;font-weight: 300; text-align: center; line-height: 72px;text-decoration: none;border: 7px solid #fff;"><?php echo Yii::t('themes', 'Нет, Спасибо... Вернитесь обратно на сайт <b>BetonFootball</b>'); ?></a>
			<br/>
			<br/>
			<br/>
			<br/>
		</div>
	</div>
</div>