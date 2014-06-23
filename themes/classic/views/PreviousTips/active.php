<div class="site-width">
	<div class="active-tips">
		
		<div class="title">
			<span class="bold"><?php echo Yii::t('tips', '{n} Активный|{n} Активных|{n} Активных|{n} Активных', count($model));?></span>
			<span> <?php echo Yii::t('tips', 'Совет|Совета|Советов|Совета', count($model));?></span>
		<?php 
			if(Yii::app()->user->AccessView)
				echo CHtml::link(Yii::t('tips', 'Смотреть все советы в одной таблице'), array('/tip/default/SingleTable'), array('class'=>'top'));
		?>
		</div>
		
		
		<?php foreach($model AS $data):?>
			<?php $this->render('_tip', array('data'=>$data));?>
		<?php endforeach;?>
		
	</div>
</div>