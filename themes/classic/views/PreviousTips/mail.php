
<table cellpadding="5" cellspacing="0" style="background: #FFF;width: 590px;border: 1px solid #E6E9ED;border-bottom: 2px solid #E6E9ED;">
	<tbody>
		<tr class="name" style="font-weight: bold;font-size: 17px;color: #1A1A1A;height: 50px;line-height: 29px;">
			<td class="event" style="border-bottom: 1px solid #E6E9ED;padding: 10px 0px 10px 24px;text-align: left;"><?php echo Yii::t('tips', 'Событие');?></td>
			<td class="selection" style="border-bottom: 1px solid #E6E9ED;padding: 10px 0px 10px 24px;text-align: center;"><?php echo Yii::t('tips', 'Выбор');?></td>
			<td class="odds" style="border-bottom: 1px solid #E6E9ED;padding: 10px 0px 10px 24px;text-align: center;"><?php echo Yii::t('tips', 'Шансы');?>**</td>
			<td class="stake" style="border-bottom: 1px solid #E6E9ED;padding: 10px 0px 10px 24px;text-align: center;"><?php echo Yii::t('tips', 'Ставка');?>*</td>
			<td class="result" style="border-bottom: 1px solid #E6E9ED;padding: 10px 0px 10px 24px;text-align: center;"><?php echo Yii::t('tips', 'Предварительный просмотр');?></td>
		</tr>
		<?php foreach($model AS $data):?>
		<tr class="rows" style="font-size: 14px;color: #434A54;">
			<td class="event" style="border-bottom: 1px solid #E6E9ED;padding: 10px 0px 10px 24px;text-align: left;">
				<span><?php echo CHtml::link($data->club_1.' vs '.$data->club_2, Yii::app()->createAbsoluteUrl('/tip/default/view', array('id'=>$data->id)),array("style"=>"color: #434A54;cursor: pointer;text-decoration: none;border-bottom: 1px solid #E6E9ED;"));?></span>
			</td>
			<td class="selection" style="border-bottom: 1px solid #E6E9ED;padding: 10px 0px 10px 24px;text-align: center;">
				<p style="margin: 0px;margin-right: 10px;display: inline-block;line-height: 22px;float: left;"><?php echo $data->BetOnClub;?></p>
				<span style="color: #FFF;background-color: #FFCE54;width: 47px;height: 22px;line-height: 22px;display: inline-block;float: right;border-radius: 3px;text-align: center;"><?php echo $data->selection_num;?></span>
			</td>
			<td class="odds" style="border-bottom: 1px solid #E6E9ED;padding: 10px 0px 10px 24px;text-align: center;"><?php echo $data->odds;?></td>
			<td class="stake" style="border-bottom: 1px solid #E6E9ED;padding: 10px 0px 10px 24px;text-align: center;"><?php echo $data->stake;?></td>
			<td class="result" style="border-bottom: 1px solid #E6E9ED;padding: 10px 0px 10px 24px;text-align: center;"><?php echo CHtml::link(Yii::t('tips', 'Читать').' '.$data->tipster->FullName, Yii::app()->createAbsoluteUrl('/tip/default/view',  array('id'=>$data->id)));?></td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
<p style="font-size: 11px;">*Stake = Confidence from 1 to10&nbsp;&nbsp;&nbsp;&nbsp;**at BetFair, or we use SBO, Bet365, Pinnacle.<p>
<p style="font-size: 14px;">Pay your attention to hot predictions that may appeared on the website before matches. Don't miss it!<p>