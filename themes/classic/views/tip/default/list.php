<div class="site-width">
	<div class="active-tips">
		
		<div class="title">
			<span> <?php echo Yii::t('tips', 'Советы list') ;?></span>
			<span class="bold">
				<?php if($active==null):?>
					<?php echo $user!=null ? $user->FullName : Yii::t('tips', 'Все');?>
				<?php else:?>
					<?php echo $active==1 ? Yii::t('tips', 'Активные') : Yii::t('tips', 'Прошедшие') ;?>
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