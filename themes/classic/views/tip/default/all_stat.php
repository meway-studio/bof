<div class="site-width">

	<div class="profiles">
		<div class="title">
			<?php echo Yii::t('themes', '{name} <span> Профайл</span>', array('{name}'=>'<span class="bold">'.$bof['name'].'</span>')); ?>
		</div>
		<div class="profile">
			<div class="tipster-inf">
				<div class="top">
					<div style="display: inline-block; position: relative;">
						<img class="image" src="/themes/classic/css/images/menu/no_avatar.png" alt="">
						<img class="img_pattern" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/tips/img_pattern.png">
					</div>
					<div class="some-inf">
						<span><?php echo Yii::t('themes', 'Общая прибыль'); ?></span>
						<span class="big"> <?php echo $bof['profit'];?></span>
						<span><?php echo Yii::t('themes', 'Прибыль'); ?></span>
						<span><?php echo Yii::t('themes', 'ROI (Доход)'); ?><span> <?php echo $bof['yield'];?>%</span></span>
					</div>
					<span class="name"><?php echo $bof['name'];?></span>
					<span class="status"><?php echo $bof['rank'];?></span>
					<span class="devis"><?php echo $bof['comment'];?></span>
					<div class="some-inf-bottom">
						<a class="stats" href="<?php echo Yii::app()->createUrl('/tip/default/allstat');?>">
							<span class="pixel active"></span>
							<span><?php echo Yii::t('tips', 'Статистика'); ?></span>
						</a>
						<a class="tips" href="<?php echo Yii::app()->createUrl('/tip/default/list');?>">
							<span class="pixel active"></span>
							<span class="how-mutch">0</span>
							<span><?php echo Yii::t('themes', 'Советы'); ?></span>
						</a>
						<a class="subscribe" href="<?php echo Yii::app()->createUrl('/tip/default/subscription');?>" style="margin-right: 0px;">
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
			<div class="analysis">
			
				<div class="a-top">
					<?php echo Yii::t('themes', '<span>Анализ производительности<span>Общая совокупная прибыль</span></span>{units}', array('{units}'=>'<br /><br /><span style="font-size: 10px;margin: 0 0 5px 15px;">Units</span>')); ?>
					<?php /*
					<div class="period">
						<a href="#">Daily</a>
						<a class="active" href="#">Monthly</a>
					</div>
					*/ ?>
					<?php
						Yii::import('ext.chart.Chart');
						$this->widget('Chart', array(
							'id'       => 'tipsterChart',
							'width'    => 700,
							'height'   => 210,
							'labels'   => $chart['months'],
							'datasets' => array(
								array(
									'strokeColor' => 'rgba(154,205,102,1)',
									'fillColor'   => 'rgba(154,205,102,0.5)',
									'data' => $chart['profit']
								)
							),
						));
					?>
				</div>
				
				<div class="a-bottom">
					<table cellpadding="5" cellspacing="0">
						<tbody>
							<tr class="name">
								<td><?php echo Yii::t('themes', 'Месяц'); ?></td>
								<td><?php echo Yii::t('tips', 'Прибыль'); ?></td>
								<td><?php echo Yii::t('tips', 'ROI (Доход)'); ?></td>
								<!--td>Bank (last/new)</td-->
								<td><?php echo Yii::t('tips', 'Количество советов'); ?></td>
							</tr>
							<?php
							$this->widget('zii.widgets.CListView', array(
								'dataProvider' => $dataProvider,
								'itemView'     => '_month_tr_all',
								'template'     => '{items}',
							));
							?>
						</tbody>
					</table>
					
				</div>
				
			</div>
			<?php $this->widget('CLinkPager', array(
					'pages' => $dataProvider->pagination,
					'header'         => '<span></span>',
					'prevPageLabel'  => '&larr;',
					'firstPageLabel' => '&larr;',
					'nextPageLabel'  => '&rarr;',
					'lastPageLabel'  => '&rarr;',
					'htmlOptions'    => array('style'=>'float:right;margin-right: 8px;'),
				));?>
				
		</div>
	</div>

</div>

<?php
	Yii::import('application.modules.tip.widgets.PreviousTips.PreviousTips');
?>

<?php
	$this->widget('PreviousTips', array(
		'limit'   => 3,
		'active'  => PreviousTips::ACTIVE_TRUE,
		'free'    => PreviousTips::FREE_NULL,
		'view'    => 'active',
	));
?>

<?php
	$this->widget('PreviousTips', array(
		'limit'   => 7,
		'active'  => PreviousTips::ACTIVE_FALSE,
		'free'    => PreviousTips::FREE_NULL,
		'view'    => 'last',
		'order'   => 't.event_date DESC',
	));
?>

<div class="site-width" style="text-align:center;margin-bottom:35px;">
	<?php echo CHtml::link(Yii::t('themes', 'Показать еще 7 советов'), array('/tip/default/ajaxmore'), array('class'=>'btn-blue', 'id'=>'show7moretips')); //, 'tipster'=>'bof' ?>
</div>