<div class="site-width">
	<div class="active-tips">
		
		<div class="title">
			<span class="bold"><?php echo Yii::t('tips', 'Ставка дня');?></span>
			<span> <?php echo Yii::t('tips', 'Советы') ;?></span>
		</div>
		
		<?php foreach($model AS $data):?>
			<?php $this->render('_tip', array('data'=>$data));?>
		<?php endforeach;?>
		
	</div>
</div>