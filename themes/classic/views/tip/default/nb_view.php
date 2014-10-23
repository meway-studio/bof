<?php Yii::import('application.modules.tip.widgets.PreviousTips.PreviousTips');?>

<div class="site-width">

<div class="stats-tip">
	<div class="page-title">
		<span class="title"><span><?php echo $model->club_1;?></span>vs <span><?php echo $model->club_2;?></span></span>
	</div>
	<div class="match">
		<?php /*<img src="<?php echo Yii::app()->theme->baseUrl;?>/css/images/tips/flag1.png">*/?><span><?php echo CHtml::tag('i', array('class'=>'flag '.$model->flag_1), '');?> <?php echo $model->league;?></span>
		
		<span class="data"><?php echo $model->format_event_date;?></span>
	</div>

	<div class="briks" style="float: left;">
		<div class="brik">
			<span class="brik-name"><?php echo Yii::t('themes', 'Автор'); ?></span>
			<div class="brik-inf">
				<div style="display: inline-block; position: relative;">
					<?php echo CHtml::image($model->tipster->photoThumb, '', array('width'=>79));?>
					<img width="90" class="img_pattern" src="/themes/classic/css/images/tips/img_pattern.png">
				</div>
				<div class="right">
					<div class="name">
						<span><?php echo $model->tipster->FullName;?></span>
						<?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl."/css/images/menu/fsm.png"), array('/tip/default/stat','id'=>$model->tipster_id));?>
					</div>
					<span class="yeld"><?php echo Yii::t('themes', 'Доход:'); ?> <span><?php echo $model->tipster->tipster->yield;?>%</span></span>
					<span class="small-title"><?php echo Yii::t('themes', 'Последние 7 советов:'); ?></span>
					<span class="stats won"><?php echo Yii::t('tips', '{n} won|{n} won|{n} won|{n} won', $last['won']); ?></span>
					<span class="stats lost"><?php echo Yii::t('tips', '{lost} lost', array('{lost}'=>$last['lost']));?></span>
					<span class="stats void"><?php echo Yii::t('tips', '{n} void|{n} void|{n} void|{n} void', $last['void']); ?></span>
				</div>
			</div>
			<div class="bottom">
				<span><?php echo $model->tipster->tipster->tips;?><span><?php echo Yii::t('themes', 'Кол. советов'); ?></span></span>
				<span><?php echo $model->tipster->tipster->winrate;?>%<span><?php echo Yii::t('themes', 'Количество выигранных'); ?></span></span>
				<span><?php echo $model->tipster->tipster->odds;?><span><?php echo Yii::t('themes', 'Ср. шансы'); ?></span></span>
			</div>
		</div>

	</div>

	<div class="game-preview" style="float: left;margin-top: 50px;margin-left: 20px; width: 765px;">
		<span class="small-title"><?php echo Yii::t('themes', 'Предварительный просмотр игры'); ?></span>
		<div class="social">
		
			<?php echo CHtml::link(
				CHtml::image(Yii::app()->theme->baseUrl.'/css/images/tips/fb.png'),
				Yii::app()->createAbsoluteUrl('/tip/default/NbView', array('id'=>$model->id)),
				array(
					'class'               => 'addthis_button_facebook',
					'addthis:url'         => Yii::app()->createAbsoluteUrl('NbView', array('id'=>$model->id)),
					'addthis:title'       => CHtml::encode($model->club_1.' vs '.$model->club_2),
					'addthis:description' => CHtml::encode($model->preview),
				)
			);?>
			
			<?php echo CHtml::link(
				CHtml::image(Yii::app()->theme->baseUrl.'/css/images/tips/tw.png'),
				Yii::app()->createAbsoluteUrl('/tip/default/NbView', array('id'=>$model->id)),
				array(
					'class'               => 'addthis_button_twitter',
					'addthis:url'         => Yii::app()->createAbsoluteUrl('NbView', array('id'=>$model->id)),
					'addthis:title'       => CHtml::encode($model->club_1.' vs '.$model->club_2),
					'addthis:description' => CHtml::encode($model->preview),
				)
			);?>
		</div>
		<span class="text"><?php echo $model->content; ?></span>
		<span class="data"><?php echo Yii::t('themes', 'Советов опубликовано'); ?> <?php echo $model->format_create_date?></span>
	</div>

    <?php if ($model->comments && Yii::app()->config->get( 'SHOW_COMMENTS' )): ?>
        <div class="game-preview" style="float: left;margin-top: 20px;margin-left: 20px; width: 765px;">
            <span class="small-title" style="margin-bottom: 20px;"><?php echo Yii::t( 'themes', 'Комментарии' ); ?></span>
            <?php $this->widget( 'application.widgets.disqus.Disqus', array( 'shortname' => 'wmsamolet' ) ) ?>
        </div>
    <?php endif ?>

</div>

</div>

<?php
	$this->widget('PreviousTips', array(
		'limit'   => 3,
		'active'  => PreviousTips::ACTIVE_TRUE,
		'free'    => PreviousTips::FREE_NULL,
		'tipster' => $model->tipster_id,
		'view'    => 'active',
	));
?>

<?php
	$this->widget('PreviousTips', array(
		'limit'   => 7,
		'active'  => PreviousTips::ACTIVE_FALSE,
		'free'    => PreviousTips::FREE_NULL,
		'tipster' => $model->tipster_id,
		'view'    => 'last',
	));
?>
<br/>