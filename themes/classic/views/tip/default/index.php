<?php
	
	Yii::import('application.modules.tip.widgets.PreviousTips.*');
	Yii::import('application.modules.tip.widgets.PlansSubscriptions.PlansSubscriptions');
	Yii::import('application.modules.tip.widgets.TrackRecord.TrackRecord');
	Yii::import('application.modules.user.widgets.reviews.reviewsWidget');
?>

<?php
	$this->widget('NoBetTips', array(
		'limit'   => 5,
		'active'  => NoBetTips::ACTIVE_TRUE,
	));
?>

<?php
/*
if(Yii::app()->user->isAdmin){
	echo 'This block displays only the administrator';
	$this->widget('PreviousTips', array(
		'limit'   => 5,
		'status'  => PreviousTips::STATUS_DRAFT,
		'active'  => PreviousTips::ACTIVE_NULL,
		'free'    => PreviousTips::FREE_NULL,
		'view'    => 'active',
	));
}
*/
?>

<?php
	$this->widget('PreviousTips', array(
		'limit'   => 5,
		'active'  => PreviousTips::ACTIVE_BOD,
		'free'    => PreviousTips::FREE_NULL,
		'view'    => 'bod',
	));
?>

<?php
	$this->widget('PreviousTips', array(
		'limit'   => 50,
		'active'  => PreviousTips::ACTIVE_SOON,
		'free'    => PreviousTips::FREE_NULL,
		'view'    => 'soon',
	));
?>

<?php
	$this->widget('PreviousTips', array(
		'limit'   => 50,
		'active'  => PreviousTips::ACTIVE_TRUE,
		'free'    => PreviousTips::FREE_NULL,
		'view'    => 'active',
	));
?>

<?php
	$this->widget('PreviousTips', array(
		'limit'   => 7,
		'active'  => PreviousTips::ACTIVE_FALSE,
		'free'    => PreviousTips::FREE_NULL,
		'order'   => 't.event_date DESC',
		'view'    => 'last',
	));
?>

<div class="site-width" style="text-align:center;margin-bottom:35px;">
	<?php echo CHtml::link(Yii::t('themes', 'Показать еще 7 советов'), array('/tip/default/ajaxmore'), array('class'=>'btn-blue', 'id'=>'show7moretips'));?>
</div>

<?php
	$this->widget('PlansSubscriptions');
?>


<?php
	$this->widget('TrackRecord');
?>


<?php
	$this->widget('reviewsWidget');
?>