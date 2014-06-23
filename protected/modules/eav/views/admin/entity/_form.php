<?php
/* @var $this EntityController */
/* @var $model EavEntity */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget(
        'CActiveForm',
        array(
            'id' => 'eav-entity-form',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // There is a call to performAjaxValidation() commented in generated controller code.
            // See class documentation of CActiveForm for details on this.
            'enableAjaxValidation' => false,
        )
    ); ?>

    <p class="note">Fields with
        <span class="required">*</span>
        are required.
    </p>

    <?php echo $form->errorSummary( $model ); ?>

    <div class="row">
        <?php echo $form->labelEx( $model, 'type' ); ?>
        <?php echo $form->dropDownList( $model, 'type', array('model' => 'Модель', 'form' => 'Форма') ); ?>
        <?php echo $form->error( $model, 'type' ); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx( $model, 'name' ); ?>
        <?php echo $form->textField( $model, 'name', array( 'size' => 50, 'maxlength' => 50 ) ); ?>
        <?php echo $form->error( $model, 'name' ); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx( $model, 'optimize' ); ?>
        <?php echo $form->checkBox( $model, 'optimize' ); ?>
        <?php echo $form->error( $model, 'optimize' ); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton( $model->isNewRecord ? 'Create' : 'Save' ); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->