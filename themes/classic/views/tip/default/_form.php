<?php
/* @var $this TipsController */
/* @var $model Tips */
/* @var $form CActiveForm */

Yii::import('ext.chosen.chosen');
Yii::import('ext.redactor.redactor');
Yii::import('ext.msDropdown.msDropdown');
Yii::import('ext.blueimp.FileUploadWidget');

Yii::app()->clientScript->registerScript('radio','
function radio_bet_on(id){
	
	if(id==undefined)
		return radio_bet_on(1);
	
	var val = $( "#Tips_club_"+id ).val();

	if(val!="")
		$("label[for=Tips_bet_on_"+(id-1)+"]").text(val);
	
	if(id==1)
		radio_bet_on(2);
}

$(document).ready(function(){

	$(".bet_on_ch").change(function(){
		var selection = $("#Tips_selection");
		var value     = $( "#Tips_club_"+$(this).val() ).val();
		if(selection.val()=="")
			selection.val(value);
	});
	
	radio_bet_on();
	
	$(".bet-on-club").keyup(function(){radio_bet_on();});
	
	$("#changeType").click(function(){
		
	});
	
	$(".tip_detail_partner img").click(function(){
	  $(".tip_detail_partner img").removeClass("selected");
	  $(this).addClass("selected");
	  $("#Tips_bookmaker").val( $(this).data("id") );
	});
	
	var bookmaker_id = $("#Tips_bookmaker").val();
	$(".tip_detail_partner img[data-id="+bookmaker_id+"]").addClass("selected");
	
});
');
?>

	<br/>
	<div class="tip_form_block_header"><?php echo Yii::t('themes', '<b>Добавить</b> совет'); ?></div>
	<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'tips-create-form',
		'enableAjaxValidation'=>false,
	)); ?>

		<?php echo $form->errorSummary($model); ?>
		<div class="tip_form_filter">
		
			<div style="float:right;">
				<?php echo $form->labelEx($model,'bod',array("class"=>"label", 'style'=>'vertical-align: middle;')); ?>
				<?php echo $form->checkBox($model,'bod', array('style'=>'width: 20px;height: 20px;vertical-align: middle;')); ?>
				<?php echo $form->error($model,'bod'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model,'status',array("class"=>"label")); ?>
				<?php echo $form->radioButtonList($model,'status', $model->statusList); ?>
				<?php echo $form->error($model,'status'); ?>

				<div style="margin: 0px 40px;border-left: 1px solid #aab2bd; height: 32px;vertical-align: middle;"></div>
				
				<label class="label"><?php echo Yii::t('tips','Стоимость'); ?></label>
				<div class="tip_form_filter_type" style="display: inline-block;">
					<?php //echo $form->hiddenField($model,'type'); //, array('value'=>0)?>
					<?php echo $form->checkBox($model,'type'); //, array('value'=>0)?>
					<?php /*<!--input value="0" name="Tips[type]" id="Tips_type" checked="checked" type="checkbox"--> */?>
					<?php //echo $form->hiddenField($model,'type', array('id'=>'lol_type')); ?>
					<label for="Tips_type"><?php echo Yii::t('tips','БЕСПЛАТНО'); //  id="changeType"?></label>
					<?php echo $form->error($model,'type'); ?>
				</div>
				
				<?php echo $form->textField($model,'price'); //,array("disabled"=>"disabled") ?>
				<?php echo $form->error($model,'price'); ?>
				
				
				
			</div>
		</div>
		<div style="overflow: hidden;">
			<div class="tip_form_block">
				<div class="tip_form_block_header"><?php echo Yii::t('themes','Подробнее о матче'); ?></div>
				
				<div class="row">
					<?php echo $form->labelEx($model,'format_event_date'); ?>
					<?php $this->widget('zii.widgets.jui.CJuiDatePicker',array(
						'model' => $model,
						'attribute'  =>'format_event_date',
						'options'=>array(
							'showAnim'        => 'fold',
							'showOn'          => 'button',
							'buttonImage'     => '/themes/classic/css/images/calendar_icon.png',
							'buttonImageOnly' => true,
							"dateFormat"      => "dd/mm/yy"
						)
					));
					?>
					<?php echo $form->error($model,'format_event_date'); ?>
				</div>
				
				<div class="row" id="timePicker">
					<div class="row">
						<?php echo $form->labelEx($model,'event_h'); ?>
						<?php echo $form->dropDownList($model,'event_h', $model->EventHValues, array('class'=>'ddl')); ?>
						<?php //echo $form->error($model,'event_h'); ?>
					</div>
					<span>:</span>
					<div class="row">
						<?php echo $form->labelEx($model,'event_m'); ?>
						<?php echo $form->dropDownList($model,'event_m', $model->EventMValues, array('class'=>'ddl')); ?>
						<?php //echo $form->error($model,'event_m'); ?>
					</div>
				</div>

				<div class="row">
					<?php echo $form->labelEx($model,'club_1'); ?>
					<?php echo $form->textField($model,'club_1', array('class'=>'bet-on-club')); ?>
					<?php //echo $form->radioButton($model,'bet_on', array('value'=>1, 'checked'=>($model->bet_on==1))); ?>
					<?php //echo $form->error($model,'club_1'); ?>
				</div>

				<div class="row" style="vertical-align: bottom;">
					<?php $this->widget('msDropdown', array(
						'model'     => $model,
						'attribute' => 'flag_1',
						'htmlOptions' => array(
							'style'=>'width:260px',
						),
					)); ?>
					<?php echo $form->error($model,'flag_1'); ?>
				</div>
				
				<div class="row">
					<?php echo $form->labelEx($model,'club_2'); ?>
					<?php /*$this->widget('chosen', array(
						'model'       => $model,
						'attribute'   => 'club_2',
						'data'        => $model->Teams,
						'htmlOptions' => array(
							'class'=>'bet-on-club',
							'style'=>'width:240px;height:48px;',
						),
					));*/ ?>
					<?php echo $form->textField($model,'club_2', array('class'=>'bet-on-club')); ?>
					<?php //echo $form->error($model,'club_2'); ?>
				</div>

				<div class="row" style="vertical-align: bottom;">
					<?php $this->widget('msDropdown', array(
						'model'     => $model,
						'attribute' => 'flag_2',
						'htmlOptions' => array(
							'style'=>'width:260px',
						),
					)); ?>
					<?php echo $form->error($model,'flag_2'); ?>
				</div>
				<div class="row">
					<?php echo $form->labelEx($model,'league'); ?>
					<?php echo $form->textField($model,'league',array("style"=>"width: 476px;")); ?>
					<?php //echo $form->error($model,'league'); ?>
				</div>
			</div>
			<div class="tip_form_block" style="margin-left: 20px;">
				<div class="tip_form_block_header"><?php echo Yii::t('themes','Подробнее о совете'); ?></div>
				<div class="row">
					<?php echo $form->labelEx($model,'bet_on'); ?>
					<div class="team_choose"><?php echo $form->radioButtonList($model,'bet_on', array(1=>Yii::t('tips', 'Команда 1'), 2=>Yii::t('tips', 'Команда 2')), array('class'=>'bet_on_ch')); ?></div>
					<?php //echo $form->error($model,'bet_on'); ?>
				</div>
				<div class="row tip_detail_partner">
					<label class="required"><?php echo Yii::t('themes','Букмекер'); ?> <span class="required">*</span></label>
					<?php echo CHtml::image(Yii::app()->theme-> baseUrl."/css/images/sb.png","", array('data-id'=>Tips::BOOKMAKER_SBOBET) ); ?>
					<?php echo CHtml::image(Yii::app()->theme-> baseUrl."/css/images/365.png","", array('data-id'=>Tips::BOOKMAKER_BET365) ); ?>
					<?php echo CHtml::image(Yii::app()->theme-> baseUrl."/css/images/pin.png","",array('data-id'=>Tips::BOOKMAKER_PINNACLE)); ?>
					<?php echo CHtml::image(Yii::app()->theme-> baseUrl."/css/images/betfair.png","", array('data-id'=>Tips::BOOKMAKER_BETFAIR) ); ?>
					<?php echo $form->hiddenField($model,'bookmaker'); ?>
				</div>
				<div class="row">
					<?php echo $form->labelEx($model,'selection'); ?>
					<?php echo $form->textField($model,'selection'); ?>
					<?php //echo $form->error($model,'selection'); ?>
				</div>
				
				<div class="row">
					<?php echo $form->labelEx($model,'selectionf'); ?>
					<?php echo $form->textField($model,'selection_num'); ?>
					<?php //echo $form->error($model,'selection_num'); ?>
				</div>

				<div class="row">
					<?php echo $form->labelEx($model,'odds'); ?>
					<?php echo $form->textField($model,'odds'); ?>
					<?php //echo $form->error($model,'odds'); ?>
				</div>

				<div class="row">
					<?php echo $form->labelEx($model,'stake'); ?>
					<?php echo $form->textField($model,'stake'); ?>
					<?php //echo $form->error($model,'stake'); ?>
				</div>
			</div>
	
		</div>

		<div class="tip_form_block" style="width: auto;float: none;overflow: hidden;">	
			<div class="tip_form_block_header" style="padding-left: 215px;"><?php echo Yii::t('themes','Предварительный просмотр игры'); ?></div>
			<div style="width: 180px;float: left;">
				<div class="row">
					<div class="personal">
						<div class="avatar">
							<?php echo CHtml::image($model->coverOriginal, '', array('id'=>'tipCover','style'=>'width: 128px;'));?>
							<span>
								<img src="/themes/classic/css/images/menu/upload.png">
								<?php echo CHtml::link(Yii::t('user', 'Загрузить фото'),"/"); ?>
								<?php $this->widget('FileUploadWidget', array(
										'model'     => $model,
										'attribute' => 'cover',
										'action'    => Yii::app()->createUrl('/tip/default/upload'),
										'options'   => "{
											dataType: 'json',
											add: function (e, data) {
												$('#tipCover').attr('src', '/images/loader.gif');
												data.submit();
											},
											done: function (e, data) {
												if(data.result.status==true){
													$('#tipCover').attr('src', data.result.cover.src);
													$('#Tips_cover').val(data.result.cover.filename);
												}else{
													$('#tipCover').attr('src', 'https://cdn1.iconfinder.com/data/icons/phuzion/PNG/Signs%20%26%20Symbols/Error.png');
												}
											}}",));
									?>								
							</span>	
						</div>
					</div>
					<?php echo $form->error($model,'cover'); ?>
				</div>
			</div>
			<div style="float: left;width: 900px;margin: 0px 0px 0px 35px;">
				
				<div class="row">
					<?php echo $form->labelEx($model,'description'); ?>
					<?php echo $form->textArea($model,'description'); ?>
					<?php //echo $form->error($model,'description'); ?>
				</div>
				<br/>

					<?php echo $form->labelEx($model,'content'); ?>
					<?php $this->widget('redactor', array(
						'model'     => $model,
						'language'  => Yii::app()->language,
						'attribute' => 'content',
						'settings'  => array(
							'imageUpload' => Yii::app()->createUrl('/tip/default/redactor'),
						),
						
						'plugins'   => array(
							'fontcolor',
							'fontcolor',
							'fontfamily',
						),
						
					)); ?>
					<?php //echo $form->error($model,'content'); ?>

			</div>
		</div>
		<div style="overflow: hidden;">
			<div class="tip_result">
				<div class="tip_form_block_header" style="color: #754c24;"><?php echo Yii::t('themes','Результат совета'); ?></div>
				<div class="row">
					<?php echo $form->labelEx($model,'tip_result'); ?>
					<?php echo $form->dropDownList($model,'tip_result', $model->tipResultList, $model->TipResultDisabled); ?>
					<?php //echo $form->error($model,'tip_result'); ?>
				</div>

				<div class="row">
					<?php echo $form->labelEx($model,'match_result'); ?>
					<?php echo $form->textField($model,'match_result'); ?>
					<?php //echo $form->error($model,'match_result'); ?>
				</div>
			</div>

			<div class="row tip_buttons">
				<p><?php echo Yii::t('themes', '{s} Внимание! Заполните корректно все полей и ничего не забывайте!', array('{s}'=>'<span style="color: #e9573f;">*</span>')); ?></p>
				<center>
					<?php echo CHtml::submitButton(Yii::t('tips', $model->isNewRecord ? Yii::t('themes', 'Добавить совет. Даааа!') : Yii::t('themes', 'Обновить совет'))); ?>
				</center>
			</div>
		</div>
		<br/>
		<br/>
	<?php $this->endWidget(); ?>

	</div><!-- form -->
