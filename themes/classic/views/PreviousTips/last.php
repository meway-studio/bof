<div class="site-width">
	<div class="last-tips">
		<div class="title">
			<span class="bold"><?php echo Yii::t('tips', 'Последние 7');?></span>
			<span> <?php echo Yii::t('tips', 'советов');?></span>
			<?php //echo CHtml::link(Yii::t('tips', 'View all last tips'),array('/tip/default/list', 'active'=>0, 'tipster'=>$tipster),array('class'=>'top'));?>
			<?php 

			if($tipster==null)
				echo CHtml::link(Yii::t('tips', 'Смотреть все последние советы'),Yii::app()->createUrl('/tip/default/list', array('active'=>0)),array('class'=>'top'));
			else
				echo CHtml::link(Yii::t('tips', 'Смотреть все последние советы'),Yii::app()->createUrl('/tip/default/list', array('active'=>0, 'tipster'=>$tipster)),array('class'=>'top'));

			?>
		</div>
		<table cellpadding="5" cellspacing="0">
			<tbody>
				<tr class="name">
					<td class="event"><?php echo Yii::t('tips', 'Событие');?></td>
					<td class="date"><?php echo Yii::t('tips', 'Дата');?></td>
					<td class="tipster"><?php echo Yii::t('tips', 'Автор');?></td>
					<td class="selection"><?php echo Yii::t('tips', 'Выбор');?></td>
					<td class="odds"><?php echo Yii::t('tips', 'Шансы');?></td>
					<td class="stake"><?php echo Yii::t('tips', 'Ставка');?></td>
					<td class="profit"><?php echo Yii::t('tips', 'Прибыль');?></td>
					<td class="result"><?php echo Yii::t('tips', 'Результат');?></td>
					<td class="score"><?php echo Yii::t('tips', 'Оценка');?></td>
				</tr>
				<?php foreach($model AS $data):?>
				<tr class="rows">
					<td class="event">
						<?php echo CHtml::tag('i', array('class'=>'flag '.$data->flag_1), '');?>
						<?php ?>
						<span><?php echo CHtml::link($data->club_1.' vs '.$data->club_2, array('/tip/default/view', 'id'=>$data->id));?></span>
					</td>
					<td class="date"><?php echo $data->format_event_date_only;?></td>
					<td class="tipster"><?php echo CHtml::link($data->tipster->FullName, array('/tip/default/stat', 'id'=>$data->tipster_id));?></td>
					<td class="selection"><p><?php echo $data->BetOnClub;?></p><span><?php echo $data->SelectionNum;?></span></td>
					<td class="odds"><?php echo $data->odds;?></td>
					<td class="stake"><?php echo $data->stake;?></td>
					<td class="profit"><?php echo $data->TipProfitSpanTag;?></td>
					<?php if(Yii::app()->user->isAdmin):?>
						<td class="result"><?php echo CHtml::dropDownList('Tip[tip_result]['.$data->id.']', $data->tip_result, Tips::resultList(), array('class'=>'adminInput'));?></td>
						<td class="score"><?php echo CHtml::textField('Tip[match_result]['.$data->id.']', $data->match_result, array('class'=>'adminInput'));?></td>
						 
					<?php else:?>
						<td class="result"><?php echo $data->TipResultSpanTag;?></td>
						<td class="score"><span class="scoreInput"><?php echo $data->match_result;?></span></td>
					<?php endif;?>
				</tr>
				<?php endforeach;?>
			</tbody>
		</table>
		<?php if(Yii::app()->user->isAdmin):?>
			<div style="text-align: right;">
				<button id="adminUpdateTipsBtn" class="btn-blue"><?php echo Yii::t('tips', 'Сохранить');?></button>
				<?php Yii::app()->clientScript->registerScript('adminInput', '$(document).ready(function(){
					$("#adminUpdateTipsBtn").click(function(){
						console.log(this);
						var data = $(".adminInput").serialize();
						$.post("'.Yii::app()->createUrl('/tip/admin/default/adminInput').'", data, function(data){
							
							for(i in data){
								
								if(data[i].status==true){
									$().toastmessage("showSuccessToast", data[i].message+": "+data[i].title);
								}else{
									$().toastmessage("showWarningToast", data[i].message+": "+data[i].title);
								}
							}

						}, "json");
					});
				});');?>
			</div>
			<br/>
		<?php endif;?>
	</div>
</div>