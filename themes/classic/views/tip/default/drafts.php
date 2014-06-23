<div class="site-width">
	<div class="active-tips">
		
		<div class="title">
			<span class="bold">
				<?php echo Yii::t('themes', 'Мой'); ?>
			</span>
			<span> <?php echo Yii::t('tips', 'Черновик') ;?></span>
		</div>
		
		<h3><?php echo Yii::t('themes', 'Советы'); ?></h3>
		
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider' => $dataProvider1,
			'itemView'     => '_tip',
			'template'=>'{items} {pager}',
			'pager' => array(
				'header'=>'<span></span>',
				'prevPageLabel'=>'&larr;',
				'firstPageLabel'=>'&larr;',
				'nextPageLabel'=>'&rarr;',
				'lastPageLabel'=>'&rarr;',
			),
		)); ?>
		
		<h3><?php echo Yii::t('themes', 'Советы без ставок'); ?></h3>
		
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider' => $dataProvider2,
			'itemView'     => '_nb_tip',
			'template'=>'{items} {pager}',
			'pager' => array(
				'header'=>'<span></span>',
				'prevPageLabel'=>'&larr;',
				'firstPageLabel'=>'&larr;',
				'nextPageLabel'=>'&rarr;',
				'lastPageLabel'=>'&rarr;',
			),
		)); ?>
		
	</div>
</div>