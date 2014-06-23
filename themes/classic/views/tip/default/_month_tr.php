<tr class="rows">
	<td><?php echo $data->statDate; ?></td>
	<td><span class="<?php echo $data->profit>0 ? 'green' : 'red';?>"><?php echo $data->profit;?></span></td>
	<td><?php echo $data->yield;?>%</td>
	<!--<td><?php echo $data->tipscount;?></td>-->
	<td>
		<span class="stats won"><?php echo Yii::t('tips', '{n} прошел|{n} прошло|{n} прошло|{n} прошло', $data->count_won); ?></span>
		<span class="stats lost"><?php echo Yii::t('tips', '{n} не прошел|{n} не прошло|{n} не прошло|{n} не прошло', $data->count_lost); ?></span>
		<span class="stats void"><?php echo Yii::t('tips', '{n} расход|{n} расхода|{n} расходов|{n} расходов', $data->count_void); ?></span>
	</td>
</tr>