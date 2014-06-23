<?php
/* @var $this SettingsFormController */
/* @var $model SettingsForm */
/* @var $form CActiveForm */

Yii::import('ext.redactor.redactor');
Yii::app()->clientScript->registerScript('jquery.ui');
Yii::app()->clientScript->registerScript('tabs', '$(function(){$( "#tabs" ).tabs();});');
?>

<div class="form" id="tabs">

	<ul>
		<li><a href="#tabs-1"><?php echo Yii::t('settings', 'Яблоко сейчас'); ?></a></li>
		<li><a href="#tabs-2"><?php echo Yii::t('settings', 'Это боль'); ?></a></li>
		<li><a href="#tabs-3"><?php echo Yii::t('settings', 'Добро пожаловать в Оклахому'); ?></a></li>
	</ul>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'                   => 'settings-form-settings-form',
    'enableAjaxValidation' => false,
)); ?>

    <?php echo $form->errorSummary($model); ?>
	
	<div id="tabs-1">
		
		<div class="row">
			<?php echo $form->labelEx($model,'SUBSCRIPTION_TITLE'); ?>
			<?php echo $form->textField($model,'SUBSCRIPTION_TITLE'); ?>
			<?php echo $form->error($model,'SUBSCRIPTION_TITLE'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'SUBSCRIPTION_TEXT'); ?>
			<?php echo $form->textField($model,'SUBSCRIPTION_TEXT'); ?>
			<?php echo $form->error($model,'SUBSCRIPTION_TEXT'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'SUBSCRIPTION_WEEKEND_TEXT'); ?>
			<?php echo $form->textField($model,'SUBSCRIPTION_WEEKEND_TEXT'); ?>
			<?php echo $form->error($model,'SUBSCRIPTION_WEEKEND_TEXT'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'SUBSCRIPTION_WEEKEND_PRICE'); ?>
			<?php echo $form->textField($model,'SUBSCRIPTION_WEEKEND_PRICE'); ?>
			<?php echo $form->error($model,'SUBSCRIPTION_WEEKEND_PRICE'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'SUBSCRIPTION_WEEKEND_PRICE_SAVE'); ?>
			<?php echo $form->textField($model,'SUBSCRIPTION_WEEKEND_PRICE_SAVE'); ?>
			<?php echo $form->error($model,'SUBSCRIPTION_WEEKEND_PRICE_SAVE'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'SUBSCRIPTION_MONTH_TEXT'); ?>
			<?php echo $form->textField($model,'SUBSCRIPTION_MONTH_TEXT'); ?>
			<?php echo $form->error($model,'SUBSCRIPTION_MONTH_TEXT'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'SUBSCRIPTION_MONTH_PRICE'); ?>
			<?php echo $form->textField($model,'SUBSCRIPTION_MONTH_PRICE'); ?>
			<?php echo $form->error($model,'SUBSCRIPTION_MONTH_PRICE'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'SUBSCRIPTION_MONTH_PRICE_SAVE'); ?>
			<?php echo $form->textField($model,'SUBSCRIPTION_MONTH_PRICE_SAVE'); ?>
			<?php echo $form->error($model,'SUBSCRIPTION_MONTH_PRICE_SAVE'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'SUBSCRIPTION_3MONTH_TEXT'); ?>
			<?php echo $form->textField($model,'SUBSCRIPTION_3MONTH_TEXT'); ?>
			<?php echo $form->error($model,'SUBSCRIPTION_3MONTH_TEXT'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'SUBSCRIPTION_3MONTH_PRICE'); ?>
			<?php echo $form->textField($model,'SUBSCRIPTION_3MONTH_PRICE'); ?>
			<?php echo $form->error($model,'SUBSCRIPTION_3MONTH_PRICE'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'SUBSCRIPTION_3MONTH_PRICE_SAVE'); ?>
			<?php echo $form->textField($model,'SUBSCRIPTION_3MONTH_PRICE_SAVE'); ?>
			<?php echo $form->error($model,'SUBSCRIPTION_3MONTH_PRICE_SAVE'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'SUBSCRIPTION_SEASON_TEXT'); ?>
			<?php echo $form->textField($model,'SUBSCRIPTION_SEASON_TEXT'); ?>
			<?php echo $form->error($model,'SUBSCRIPTION_SEASON_TEXT'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'SUBSCRIPTION_SEASON_PRICE'); ?>
			<?php echo $form->textField($model,'SUBSCRIPTION_SEASON_PRICE'); ?>
			<?php echo $form->error($model,'SUBSCRIPTION_SEASON_PRICE'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'SUBSCRIPTION_SEASON_PRICE_SAVE'); ?>
			<?php echo $form->textField($model,'SUBSCRIPTION_SEASON_PRICE_SAVE'); ?>
			<?php echo $form->error($model,'SUBSCRIPTION_SEASON_PRICE_SAVE'); ?>
		</div>
		
	</div>
	
	<div id="tabs-2">

		<div class="row">
			<?php echo $form->labelEx($model,'TRACK_RECORD_TITLE'); ?>
			<?php echo $form->textField($model,'TRACK_RECORD_TITLE'); ?>
			<?php echo $form->error($model,'TRACK_RECORD_TITLE'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'TRACK_RECORD_TEXT'); ?>
			<?php echo $form->textField($model,'TRACK_RECORD_TEXT'); ?>
			<?php echo $form->error($model,'TRACK_RECORD_TEXT'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'TRACK_RECORD_YEAR'); ?>
			<?php echo $form->textField($model,'TRACK_RECORD_YEAR'); ?>
			<?php echo $form->error($model,'TRACK_RECORD_YEAR'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'TRACK_RECORD_TIPSTERS'); ?>
			<?php echo $form->textField($model,'TRACK_RECORD_TIPSTERS'); ?>
			<?php echo $form->error($model,'TRACK_RECORD_TIPSTERS'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'TRACK_RECORD_TIPS_GIVER'); ?>
			<?php echo $form->textField($model,'TRACK_RECORD_TIPS_GIVER'); ?>
			<?php echo $form->error($model,'TRACK_RECORD_TIPS_GIVER'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'TRACK_RECORD_TIPS_COME'); ?>
			<?php echo $form->textField($model,'TRACK_RECORD_TIPS_COME'); ?>
			<?php echo $form->error($model,'TRACK_RECORD_TIPS_COME'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'TRACK_RECORD_MEMBERS'); ?>
			<?php echo $form->textField($model,'TRACK_RECORD_MEMBERS'); ?>
			<?php echo $form->error($model,'TRACK_RECORD_MEMBERS'); ?>
		</div>
		
	</div>

	<div id="tabs-3">
	
		<div class="row">
			<?php echo $form->labelEx($model,'SITENAME'); ?>
			<?php echo $form->textField($model,'SITENAME'); ?>
			<?php echo $form->error($model,'SITENAME'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'COPYRIGHT'); ?>
			<?php echo $form->textField($model,'COPYRIGHT'); ?>
			<?php echo $form->error($model,'COPYRIGHT'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'FOOTER_TEXT'); ?>
			<?php echo $form->textField($model,'FOOTER_TEXT'); ?>
			<?php echo $form->error($model,'FOOTER_TEXT'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'DEFAULT_TITLE'); ?>
			<?php echo $form->textField($model,'DEFAULT_TITLE'); ?>
			<?php echo $form->error($model,'DEFAULT_TITLE'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'DEFAULT_META_K'); ?>
			<?php echo $form->textField($model,'DEFAULT_META_K'); ?>
			<?php echo $form->error($model,'DEFAULT_META_K'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'DEFAULT_META_D'); ?>
			<?php echo $form->textField($model,'DEFAULT_META_D'); ?>
			<?php echo $form->error($model,'DEFAULT_META_D'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'ACCOUNT_TEXT'); ?>
			<?php echo $form->textField($model,'ACCOUNT_TEXT'); ?>
			<?php echo $form->error($model,'ACCOUNT_TEXT'); ?>
		</div>
		
	</div>
	
	<div id="tabs-4">

		<div class="row">
			<?php echo $form->labelEx($model,'CONTACT_TITLE'); ?>
			<?php echo $form->textField($model,'CONTACT_TITLE'); ?>
			<?php echo $form->error($model,'CONTACT_TITLE'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'CONTACT_HEADER'); ?>
			<?php echo $form->textField($model,'CONTACT_HEADER'); ?>
			<?php echo $form->error($model,'CONTACT_HEADER'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'CONTACT_TEXT'); ?>
			<?php echo $form->textField($model,'CONTACT_TEXT'); ?>
			<?php echo $form->error($model,'CONTACT_TEXT'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'CONTACT_META_K'); ?>
			<?php echo $form->textField($model,'CONTACT_META_K'); ?>
			<?php echo $form->error($model,'CONTACT_META_K'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'CONTACT_META_D'); ?>
			<?php echo $form->textField($model,'CONTACT_META_D'); ?>
			<?php echo $form->error($model,'CONTACT_META_D'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'CONTACT_MESSAGE_SUCCESS'); ?>
			<?php echo $form->textField($model,'CONTACT_MESSAGE_SUCCESS'); ?>
			<?php echo $form->error($model,'CONTACT_MESSAGE_SUCCESS'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'CONTACT_MESSAGE_FAILURE'); ?>
			<?php echo $form->textField($model,'CONTACT_MESSAGE_FAILURE'); ?>
			<?php echo $form->error($model,'CONTACT_MESSAGE_FAILURE'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'CONTACT_PHONE'); ?>
			<?php echo $form->textField($model,'CONTACT_PHONE'); ?>
			<?php echo $form->error($model,'CONTACT_PHONE'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'CONTACT_EMAIL_1'); ?>
			<?php echo $form->textField($model,'CONTACT_EMAIL_1'); ?>
			<?php echo $form->error($model,'CONTACT_EMAIL_1'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'CONTACT_EMAIL_2'); ?>
			<?php echo $form->textField($model,'CONTACT_EMAIL_2'); ?>
			<?php echo $form->error($model,'CONTACT_EMAIL_2'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'CONTACT_SKYPE'); ?>
			<?php echo $form->textField($model,'CONTACT_SKYPE'); ?>
			<?php echo $form->error($model,'CONTACT_SKYPE'); ?>
		</div>
		
	</div>


    <div class="row buttons">
        <?php echo CHtml::submitButton(Yii::t('settings', 'Сохранить')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->