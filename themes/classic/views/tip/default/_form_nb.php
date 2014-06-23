<?php
/* @var $this TipsController */
/* @var $model Tips */
/* @var $form CActiveForm */

Yii::import('ext.chosen.chosen');
Yii::import('ext.redactor.redactor');
Yii::import('ext.msDropdown.msDropdown');
Yii::import('ext.blueimp.FileUploadWidget');
?>

	<br/>
	<div class="tip_form_block_header"><?php echo Yii::t('themes', '<b>Добавить</b> без ставок на совет'); ?></div>
	<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'tips-create-form',
		'enableAjaxValidation'=>false,
	)); ?>

		<?php echo $form->errorSummary($model); ?>
		<div class="tip_form_filter">
		
			<div class="row">
				<?php echo $form->labelEx($model,'status',array("class"=>"label")); ?>
				<?php echo $form->radioButtonList($model,'status', $model->statusList); ?>
				<?php echo $form->error($model,'status'); ?>
				
			</div>
		</div>
		<div>
			<div class="tip_form_block" style="float: none; width: auto;">
				<div class="tip_form_block_header"><?php echo Yii::t('themes', 'Подробнее о матче'); ?></div>
				
				<div class="row" style="">
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
				
				<div class="row" id="timePicker" style="margin-right: 50px;">
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
				
				<div class="row" style="margin-right: 46px;">
					<?php echo $form->labelEx($model,'league'); ?>
					<?php echo $form->textField($model,'league',array("style"=>"width: 476px;")); ?>
				</div>
				<div class="row">
					<?php echo $form->labelEx($model,'club_2'); ?>
					<?php echo $form->textField($model,'club_2', array('class'=>'bet-on-club')); ?>
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
			</div>
	
		</div>

		<div class="tip_form_block" style="width: auto;float: none;overflow: hidden;">	
			<div class="tip_form_block_header" style="padding-left: 215px;"><?php echo Yii::t('themes', 'Предварительный просмотр игры'); ?></div>
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
													$('#NbTips_cover').val(data.result.cover.filename);
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

			</div>
		</div>
		<div style="overflow: hidden;">
			<div class="row tip_buttons" style="float: none; width: auto; margin-left: 0px;">
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
