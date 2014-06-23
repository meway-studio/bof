<?php
	Yii::import('application.modules.tip.widgets.PlansSubscriptions.PlansSubscriptions');
	Yii::import('application.modules.tip.widgets.TrackRecord.TrackRecord');
?>

<center>
<?php echo CHtml::tag('h3', array('class'=>'price'), Yii::t('tips', 'Стоимость типса {price}', array('{price}'=>$model->formatPrice)));?>

<?php if($status==null):?>

	<?php echo CHtml::link(Yii::t('tips', 'Подтверждаю оплату'), array('/tip/default/paytip', 'id'=>$model->id, 'success'=>true), array('class'=>'button green'));?>
	<br />или<br />
	<?php echo CHtml::link(Yii::t('tips', 'Отказываюсь от оплаты'), array('/tip/default/index'), array('class'=>'button green'));?>
	</center>

<?php elseif($status==false):?>
	<?php echo CHtml::tag('h3', array('class'=>'price'), Yii::t('tips', 'Покупка не удалась'));?>
<?php else:?>
	<?php echo CHtml::link(Yii::t('tips', 'Покупка прошла успешно. Перейти к типсу'), array('/tip/default/view', 'id'=>$model->id), array('class'=>'button green'));?>
<?php endif?>

<?php
	$this->widget('PlansSubscriptions');
?>

<?php
	$this->widget('TrackRecord');
?>
