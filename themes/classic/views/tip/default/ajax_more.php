<?
	Yii::import('application.modules.tip.widgets.PreviousTips.PreviousTips');
	
	$this->widget('PreviousTips', array(
		'limit'   => 7,
		'active'  => PreviousTips::ACTIVE_FALSE,
		'free'    => PreviousTips::FREE_NULL,
		'view'    => 'last',
		'offset'  => $offset,
		'tipster' => $tipster,
        'order'   => 't.event_date DESC',
	));
	
	//echo CHtml::link('Show 7 more Tips', array('/tip/default/ajaxmore', 'offset'=>($offset+7)));
?>