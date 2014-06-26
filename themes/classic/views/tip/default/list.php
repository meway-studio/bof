<div class="site-width">
	<div class="active-tips">
		
		<div class="title">
			<span>
				<?php if($active==null):?>
					<?php echo $user!=null ? $user->FullName : Yii::t('tips', 'Все советы на весь период');?>
				<?php else:?>
					<?php echo $active==1 ? Yii::t('tips', 'Активные Советы') : Yii::t('tips', 'Все Советы') ;?>
				<?php endif;?>
			</span>
		</div>
		
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider' => $dataProvider,
			'itemView'     => '_tip',
			'template'=>'{pager}<br />{items} {pager}',
			'afterAjaxUpdate' => 'function(id,data){scroll(0,150);}',
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