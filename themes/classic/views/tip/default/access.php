<?php
	Yii::import('application.modules.tip.widgets.PlansSubscriptions.PlansSubscriptions');
	Yii::import('application.modules.tip.widgets.TrackRecord.TrackRecord');
?>

<center>
<?php echo CHtml::link(Yii::t('tips', 'Оплатить этот типс'), array('/tip/default/paytip', 'id'=>$model->id), array('class'=>'button green'));?>
<br />или<br />
<?php echo Yii::t('tips', 'Оформить подписку');?>
</center>

<?php
	$this->widget('PlansSubscriptions');
?>

<?php
	$this->widget('TrackRecord');
?>
