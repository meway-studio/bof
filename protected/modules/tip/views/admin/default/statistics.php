<?php
$this->breadcrumbs=array(
	Yii::t('tips', 'Советы')=>array('index'),
	Yii::t('tips', 'Вычисление статистики'),
);
?>

<input type="text" class="dp" name="Date[from]" id="from" />
<br />
<input type="text" class="dp" name="Date[to]"   id="to" />

<table class="detail-view table table-striped table-condensed" id="statistics"><tbody>
<tr class="odd"><th><?php echo Yii::t('tips', 'Все'); ?></th><td id="count_all"></td></tr>
<tr class="odd"><th><?php echo Yii::t('tips', 'Выиграли'); ?></th><td id="count_won"></td></tr>
<tr class="even"><th><?php echo Yii::t('tips', 'Потерял'); ?></th><td id="count_lost"></td></tr>
<tr class="odd"><th><?php echo Yii::t('tips', 'Пустые'); ?></th><td id="count_void"></td></tr>
<tr class="even"><th><?php echo Yii::t('tips', 'Прибыль'); ?></th><td id="profit_all"></td></tr>
<tr class="odd"><th><?php echo Yii::t('tips', 'Доход'); ?></th><td id="yield_all"></td></tr>
<tr class="even"><th><?php echo Yii::t('tips', 'Ставка'); ?></th><td id="stake_all"></td></tr>
</tbody></table>

<div class="form-actions">
	<button class="btn btn-primary" type="button" id="calculate"><?php echo Yii::t('tips', 'Вычислить'); ?></button>
</div>

<script type="text/javascript">

	$('.dp').datepicker({'showAnim':'fold','showOn':'button','buttonImage':'/themes/classic/css/images/calendar_icon.png','buttonImageOnly':true,'dateFormat':'dd-mm-yy'});

	$("#calculate").click(function(){

		var from = $("input.hasDatepicker#from").val();
		var to   = $("input.hasDatepicker#to").val();

		if(from=='' || to=='')
			return false;

		$.post('/admin/tip/default/calc', {from: from, to: to}, function(json){

			for(i in json)
				$("#"+i).text(json[i]);

		}, 'json');

		return false;
	});
</script>

<style type="text/css">
	.ui-datepicker-trigger {
		margin: 0 0 12px 5px;
	}
</style>