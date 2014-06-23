<tr class="rows">
	<td class="event">
		<?php echo CHtml::tag('i', array('class'=>'flag '.$data->flag_1), '');?>
		<?php ?>
		<span><?php echo CHtml::link($data->club_1.' vs '.$data->club_2, array('/tip/default/view', 'id'=>$data->id));?></span>
	</td>
	<td class="date"><?php echo $data->format_event_date;?></td>
	<td class="tipster"><?php echo CHtml::link($data->tipster->FullName, array('/tip/default/stat', 'id'=>$data->tipster_id));?></td>
	<td class="selection"><p><?php echo $data->BetOnClub;?></p><span><?php echo $data->SelectionNum;?></span></td>
	<td class="odds"><?php echo $data->odds;?></td>
	<td class="stake"><?php echo $data->stake;?></td>
	<td class="stake"><?php echo CHtml::link(Yii::t('tips', 'Читать'), array('/tip/default/view', 'id'=>$data->id), array('class'=>'btn-blue'));?></td>
</tr>