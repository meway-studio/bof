<div class="social">
	<?php foreach($services as $name => $service): ?>
		<?php echo CHtml::link(Yii::t('themes', 'Соединитесь с {name}', array('{name}'=>'<span>'.$name.'</span>')), $action.'/?service='.$name, array('class' => 'with-'.$service->id)) ?>
	<?php endforeach; ?>
</div>