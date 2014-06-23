<div class="my-account">
	<div class="site-width">
		<div class="page-title">
			<span class="title"><span><?php echo Yii::t('user', 'Мои')?></span><?php echo Yii::t('user', 'Покупки')?></span>
			<span class="text">
				<?php echo Yii::t('user', 'Betonfootball предназначен для пользователя. Поэтому если у вас есть какие-то вопросы, касающиеся работы нашего сайта или вам нужна помощь, в пользование нашими услугами, не стесняйтесь обращаться к нам, используя форму обратной связи, и мы ответим очень быстро.')?>	
			</span>
		</div>
		<div class="personal">
			<div class="avatar">
				<?php $this->widget('application.modules.tip.widgets.Expiries.Expiries');?>
			</div>
			<div class="information">
				<span><?php echo Yii::t('user', 'История покупок')?></span>
				<div class="last-purchase">

					<table cellpadding="5" cellspacing="0">
						<tbody>
							<tr class="name">
								<td>ID</td>
								<td><?php echo Yii::t('user', 'Дата')?></td>
								<td><?php echo Yii::t('user', 'Покупка')?></td>
								<td><?php echo Yii::t('user', 'Стоимость')?></td>
								<td><?php echo Yii::t('user', 'Статус')?></td>
							</tr>

							<?php $this->widget('zii.widgets.CListView', array(
							    'dataProvider' => $model,
							    'itemView'     => '_purchase_row',
							    'template'     => '{items}',
							)); ?>

						</tbody>
					</table>

					<?php $this->widget('CLinkPager', array(
						'pages' => $model->pagination,
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
	</div>
</div>