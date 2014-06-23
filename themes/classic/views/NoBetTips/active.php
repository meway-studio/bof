<div class="site-width">
	<div class="active-tips">
		
		<div class="title">
			<span class="bold"><?php echo Yii::t('tips', 'Советы без');?></span>
			<span> <?php echo Yii::t('tips', 'ставок') ;?></span>
		<?php 
			//if(Yii::app()->user->AccessView)
			//	echo CHtml::link('See all tips in a single table', array('/tip/default/SingleTable'), array('class'=>'top'));
		?>
		</div>
		
		
		<?php foreach($model AS $data):?>
			<?php $this->render('_nb_tip', array('data'=>$data));?>
		<?php endforeach;?>
		
	</div>
</div>