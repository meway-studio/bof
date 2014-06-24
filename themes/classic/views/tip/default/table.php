<div class="site-width">
	<div class="last-tips">
		<div class="title">
			<span class="bold"><?php echo Yii::t('tips', 'Все активные');?></span>
			<span> <?php echo Yii::t('tips', 'Все активные Советы');?></span>
			<?php //echo CHtml::link(Yii::t('tips', 'View all last tips'),array('/tip/default/list','active'=>0),array('class'=>'top'));?>
		</div>
		<table cellpadding="5" cellspacing="0">
			<tbody>
				<tr class="name">
					<td class="event"><?php echo Yii::t('tips', 'Событие');?></td>
					<td class="date"><?php echo Yii::t('tips', 'Дата');?></td>
					<td class="tipster"><?php echo Yii::t('tips', 'Автор');?></td>
					<td class="selection"><?php echo Yii::t('tips', 'Выбор');?></td>
					<td class="odds"><?php echo Yii::t('tips', 'Шансы');?></td>
					<td class="stake"><?php echo Yii::t('tips', 'Ставка');?></td>
					<td class="stake"><?php echo Yii::t('tips', 'Подробнее');?></td>
				</tr>
				<?php
					$this->widget('zii.widgets.CListView', array(
						'dataProvider' => $dataProvider,
						'itemView'     => '_table',
						'template'=>'{pager}<br />{items} {pager}',
						'afterAjaxUpdate' => 'function(id,data){scroll(0,150);}',
						'pager' => array(
							'header'=>'<span></span>',
							'prevPageLabel'=>'&larr;',
							'firstPageLabel'=>'&larr;',
							'nextPageLabel'=>'&rarr;',
							'lastPageLabel'=>'&rarr;',
						),
					));
				?>
			</tbody>
		</table>
		
	</div>
</div>