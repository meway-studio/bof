<?php
/* @var $this SettingsFormController */
/* @var $model SettingsForm */
/* @var $form CActiveForm */

$this->breadcrumbs = array(
    Yii::t( 'settings', 'Настройки' )
);

Yii::import( 'ext.redactor.redactor' );
Yii::app()->clientScript->registerScript( 'tabs', '$("#tabs").tabs({});' );
?>

<?php if (Yii::app()->user->hasFlash( 'updateSuccess' )): ?>
    <div class="flash-success"><?php echo Yii::app()->user->getFlash( 'updateSuccess' ); ?></div>
<?php elseif (Yii::app()->user->hasFlash( 'updateFailure' )): ?>
    <div class="flash-error"><?php echo Yii::app()->user->getFlash( 'updateFailure' ); ?></div>
<?php endif; ?>

<div class="form" id="tabs">

    <ul>
        <li><a href="#tabs-1"><?php echo Yii::t( 'settings', 'План подписки' ); ?></a></li>
        <li><a href="#tabs-2"><?php echo Yii::t( 'settings', 'TRACK RECORD' ); ?></a></li>
        <li><a href="#tabs-3"><?php echo Yii::t( 'settings', 'Опросы' ); ?></a></li>
        <li><a href="#tabs-4"><?php echo Yii::t( 'settings', 'Общие настройки' ); ?></a></li>
        <li><a href="#tabs-5"><?php echo Yii::t( 'settings', 'Настройки контактов' ); ?></a></li>
    </ul>

    <?php $form = $this->beginWidget(
        'CActiveForm',
        array(
            'id'                   => 'settings-form-settings-form',
            'enableAjaxValidation' => false,
        )
    ); ?>

    <?php echo $form->errorSummary( $model ); ?>

    <div id="tabs-1">

        <?php echo $form->labelEx( $model, 'SUBSCRIPTION_TITLE' ); ?>
        <?php echo $form->textField( $model, 'SUBSCRIPTION_TITLE' ); ?>
        <?php echo $form->error( $model, 'SUBSCRIPTION_TITLE' ); ?>

        <?php echo $form->labelEx( $model, 'SUBSCRIPTION_TEXT' ); ?>
        <?php echo $form->textArea( $model, 'SUBSCRIPTION_TEXT' ); ?>
        <?php echo $form->error( $model, 'SUBSCRIPTION_TEXT' ); ?>

        <?php echo $form->labelEx( $model, 'SUBSCRIPTION_WEEKEND_TEXT' ); ?>
        <?php echo $form->textField( $model, 'SUBSCRIPTION_WEEKEND_TEXT' ); ?>
        <?php echo $form->error( $model, 'SUBSCRIPTION_WEEKEND_TEXT' ); ?>

        <?php echo $form->labelEx( $model, 'SUBSCRIPTION_WEEKEND_PRICE' ); ?>
        <?php echo $form->textField( $model, 'SUBSCRIPTION_WEEKEND_PRICE' ); ?>
        <?php echo $form->error( $model, 'SUBSCRIPTION_WEEKEND_PRICE' ); ?>

        <?php echo $form->labelEx( $model, 'SUBSCRIPTION_WEEKEND_PRICE_SAVE' ); ?>
        <?php echo $form->textField( $model, 'SUBSCRIPTION_WEEKEND_PRICE_SAVE' ); ?>
        <?php echo $form->error( $model, 'SUBSCRIPTION_WEEKEND_PRICE_SAVE' ); ?>

        <?php echo $form->labelEx( $model, 'SUBSCRIPTION_MONTH_TEXT' ); ?>
        <?php echo $form->textField( $model, 'SUBSCRIPTION_MONTH_TEXT' ); ?>
        <?php echo $form->error( $model, 'SUBSCRIPTION_MONTH_TEXT' ); ?>

        <?php echo $form->labelEx( $model, 'SUBSCRIPTION_MONTH_PRICE' ); ?>
        <?php echo $form->textField( $model, 'SUBSCRIPTION_MONTH_PRICE' ); ?>
        <?php echo $form->error( $model, 'SUBSCRIPTION_MONTH_PRICE' ); ?>

        <?php echo $form->labelEx( $model, 'SUBSCRIPTION_MONTH_PRICE_SAVE' ); ?>
        <?php echo $form->textField( $model, 'SUBSCRIPTION_MONTH_PRICE_SAVE' ); ?>
        <?php echo $form->error( $model, 'SUBSCRIPTION_MONTH_PRICE_SAVE' ); ?>

        <?php echo $form->labelEx( $model, 'SUBSCRIPTION_3MONTH_TEXT' ); ?>
        <?php echo $form->textField( $model, 'SUBSCRIPTION_3MONTH_TEXT' ); ?>
        <?php echo $form->error( $model, 'SUBSCRIPTION_3MONTH_TEXT' ); ?>

        <?php echo $form->labelEx( $model, 'SUBSCRIPTION_3MONTH_PRICE' ); ?>
        <?php echo $form->textField( $model, 'SUBSCRIPTION_3MONTH_PRICE' ); ?>
        <?php echo $form->error( $model, 'SUBSCRIPTION_3MONTH_PRICE' ); ?>

        <?php echo $form->labelEx( $model, 'SUBSCRIPTION_3MONTH_PRICE_SAVE' ); ?>
        <?php echo $form->textField( $model, 'SUBSCRIPTION_3MONTH_PRICE_SAVE' ); ?>
        <?php echo $form->error( $model, 'SUBSCRIPTION_3MONTH_PRICE_SAVE' ); ?>

        <?php echo $form->labelEx( $model, 'SUBSCRIPTION_SEASON_TEXT' ); ?>
        <?php echo $form->textField( $model, 'SUBSCRIPTION_SEASON_TEXT' ); ?>
        <?php echo $form->error( $model, 'SUBSCRIPTION_SEASON_TEXT' ); ?>

        <?php echo $form->labelEx( $model, 'SUBSCRIPTION_SEASON_PRICE' ); ?>
        <?php echo $form->textField( $model, 'SUBSCRIPTION_SEASON_PRICE' ); ?>
        <?php echo $form->error( $model, 'SUBSCRIPTION_SEASON_PRICE' ); ?>

        <?php echo $form->labelEx( $model, 'SUBSCRIPTION_SEASON_PRICE_SAVE' ); ?>
        <?php echo $form->textField( $model, 'SUBSCRIPTION_SEASON_PRICE_SAVE' ); ?>
        <?php echo $form->error( $model, 'SUBSCRIPTION_SEASON_PRICE_SAVE' ); ?>

        <?php echo $form->labelEx( $model, 'ACCOUNT_QIWI' ); ?>
        <?php echo $form->textField( $model, 'ACCOUNT_QIWI' ); ?>
        <?php echo $form->error( $model, 'ACCOUNT_QIWI' ); ?>

        <?php echo $form->labelEx( $model, 'ACCOUNT_MB' ); ?>
        <?php echo $form->textField( $model, 'ACCOUNT_MB' ); ?>
        <?php echo $form->error( $model, 'ACCOUNT_MB' ); ?>

        <?php echo $form->labelEx( $model, 'ACCOUNT_PAYPALL' ); ?>
        <?php echo $form->textField( $model, 'ACCOUNT_PAYPALL' ); ?>
        <?php echo $form->error( $model, 'ACCOUNT_PAYPALL' ); ?>

    </div>

    <div id="tabs-2">

        <?php echo $form->labelEx( $model, 'TRACK_RECORD_TITLE' ); ?>
        <?php echo $form->textField( $model, 'TRACK_RECORD_TITLE' ); ?>
        <?php echo $form->error( $model, 'TRACK_RECORD_TITLE' ); ?>

        <?php echo $form->labelEx( $model, 'TRACK_RECORD_TEXT' ); ?>
        <?php echo $form->textArea( $model, 'TRACK_RECORD_TEXT' ); ?>
        <?php echo $form->error( $model, 'TRACK_RECORD_TEXT' ); ?>

        <?php echo $form->labelEx( $model, 'TRACK_RECORD_YEAR' ); ?>
        <?php echo $form->textField( $model, 'TRACK_RECORD_YEAR' ); ?>
        <?php echo $form->error( $model, 'TRACK_RECORD_YEAR' ); ?>

        <?php echo $form->labelEx( $model, 'TRACK_RECORD_TIPSTERS' ); ?>
        <?php echo $form->textField( $model, 'TRACK_RECORD_TIPSTERS' ); ?>
        <?php echo $form->error( $model, 'TRACK_RECORD_TIPSTERS' ); ?>

        <?php echo $form->labelEx( $model, 'TRACK_RECORD_TIPS_GIVER' ); ?>
        <?php echo $form->textField( $model, 'TRACK_RECORD_TIPS_GIVER' ); ?>
        <?php echo $form->error( $model, 'TRACK_RECORD_TIPS_GIVER' ); ?>

        <?php echo $form->labelEx( $model, 'TRACK_RECORD_TIPS_COME' ); ?>
        <?php echo $form->textField( $model, 'TRACK_RECORD_TIPS_COME' ); ?>
        <?php echo $form->error( $model, 'TRACK_RECORD_TIPS_COME' ); ?>

        <?php echo $form->labelEx( $model, 'TRACK_RECORD_MEMBERS' ); ?>
        <?php echo $form->textField( $model, 'TRACK_RECORD_MEMBERS' ); ?>
        <?php echo $form->error( $model, 'TRACK_RECORD_MEMBERS' ); ?>

    </div>

    <div id="tabs-3">

        <?php echo $form->labelEx( $model, 'POLLS_TITLE' ); ?>
        <?php echo $form->textField( $model, 'POLLS_TITLE' ); ?>
        <?php echo $form->error( $model, 'POLLS_TITLE' ); ?>

        <?php echo $form->labelEx( $model, 'POLLS_TEXT' ); ?>
        <?php echo $form->textArea( $model, 'POLLS_TEXT' ); ?>
        <?php echo $form->error( $model, 'POLLS_TEXT' ); ?>

        <?php echo $form->labelEx( $model, 'POLLS_CODE' ); ?>
        <?php echo $form->textArea( $model, 'POLLS_CODE' ); ?>
        <?php echo $form->error( $model, 'POLLS_CODE' ); ?>

    </div>

    <div id="tabs-4">

        <?php echo $form->labelEx( $model, 'SITENAME' ); ?>
        <?php echo $form->textField( $model, 'SITENAME' ); ?>
        <?php echo $form->error( $model, 'SITENAME' ); ?>

        <?php echo $form->labelEx( $model, 'COPYRIGHT' ); ?>
        <?php echo $form->textField( $model, 'COPYRIGHT' ); ?>
        <?php echo $form->error( $model, 'COPYRIGHT' ); ?>

        <?php echo $form->labelEx( $model, 'FOOTER_TEXT' ); ?>
        <?php echo $form->textArea( $model, 'FOOTER_TEXT' ); ?>
        <?php echo $form->error( $model, 'FOOTER_TEXT' ); ?>

        <?php echo $form->labelEx( $model, 'DEFAULT_TITLE' ); ?>
        <?php echo $form->textField( $model, 'DEFAULT_TITLE' ); ?>
        <?php echo $form->error( $model, 'DEFAULT_TITLE' ); ?>

        <?php echo $form->labelEx( $model, 'DEFAULT_META_K' ); ?>
        <?php echo $form->textField( $model, 'DEFAULT_META_K' ); ?>
        <?php echo $form->error( $model, 'DEFAULT_META_K' ); ?>

        <?php echo $form->labelEx( $model, 'DEFAULT_META_D' ); ?>
        <?php echo $form->textField( $model, 'DEFAULT_META_D' ); ?>
        <?php echo $form->error( $model, 'DEFAULT_META_D' ); ?>

        <?php echo $form->labelEx( $model, 'ACCOUNT_TEXT' ); ?>
        <?php echo $form->textArea( $model, 'ACCOUNT_TEXT' ); ?>
        <?php echo $form->error( $model, 'ACCOUNT_TEXT' ); ?>

        <?php echo $form->labelEx( $model, 'MASTERCLASS_EMAIL' ); ?>
        <?php echo $form->textField( $model, 'MASTERCLASS_EMAIL' ); ?>
        <?php echo $form->error( $model, 'MASTERCLASS_EMAIL' ); ?>
    </div>

    <div id="tabs-5">

        <?php echo $form->labelEx( $model, 'CONTACT_TITLE' ); ?>
        <?php echo $form->textField( $model, 'CONTACT_TITLE' ); ?>
        <?php echo $form->error( $model, 'CONTACT_TITLE' ); ?>

        <?php echo $form->labelEx( $model, 'CONTACT_HEADER' ); ?>
        <?php echo $form->textField( $model, 'CONTACT_HEADER' ); ?>
        <?php echo $form->error( $model, 'CONTACT_HEADER' ); ?>

        <?php echo $form->labelEx( $model, 'CONTACT_TEXT' ); ?>
        <?php echo $form->textArea( $model, 'CONTACT_TEXT' ); ?>
        <?php echo $form->error( $model, 'CONTACT_TEXT' ); ?>

        <?php echo $form->labelEx( $model, 'CONTACT_META_K' ); ?>
        <?php echo $form->textField( $model, 'CONTACT_META_K' ); ?>
        <?php echo $form->error( $model, 'CONTACT_META_K' ); ?>

        <?php echo $form->labelEx( $model, 'CONTACT_META_D' ); ?>
        <?php echo $form->textField( $model, 'CONTACT_META_D' ); ?>
        <?php echo $form->error( $model, 'CONTACT_META_D' ); ?>

        <?php echo $form->labelEx( $model, 'CONTACT_MESSAGE_SUCCESS' ); ?>
        <?php echo $form->textField( $model, 'CONTACT_MESSAGE_SUCCESS' ); ?>
        <?php echo $form->error( $model, 'CONTACT_MESSAGE_SUCCESS' ); ?>

        <?php echo $form->labelEx( $model, 'CONTACT_MESSAGE_FAILURE' ); ?>
        <?php echo $form->textField( $model, 'CONTACT_MESSAGE_FAILURE' ); ?>
        <?php echo $form->error( $model, 'CONTACT_MESSAGE_FAILURE' ); ?>

        <?php echo $form->labelEx( $model, 'CONTACT_PHONE' ); ?>
        <?php echo $form->textField( $model, 'CONTACT_PHONE' ); ?>
        <?php echo $form->error( $model, 'CONTACT_PHONE' ); ?>

        <?php echo $form->labelEx( $model, 'CONTACT_EMAIL_1' ); ?>
        <?php echo $form->textField( $model, 'CONTACT_EMAIL_1' ); ?>
        <?php echo $form->error( $model, 'CONTACT_EMAIL_1' ); ?>

        <?php echo $form->labelEx( $model, 'CONTACT_EMAIL_2' ); ?>
        <?php echo $form->textField( $model, 'CONTACT_EMAIL_2' ); ?>
        <?php echo $form->error( $model, 'CONTACT_EMAIL_2' ); ?>

        <?php echo $form->labelEx( $model, 'CONTACT_SKYPE' ); ?>
        <?php echo $form->textField( $model, 'CONTACT_SKYPE' ); ?>
        <?php echo $form->error( $model, 'CONTACT_SKYPE' ); ?>

    </div>

    <div class="form-actions">
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'buttonType' => 'submit',
                'type'       => 'primary',
                'label'      => Yii::t( 'settings', 'Сохранить' ),
            )
        ); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->