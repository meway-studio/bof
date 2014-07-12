<?php
/**
 * @var $form TbActiveForm
 */
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
        'id'                   => 'banner-form',
        'enableAjaxValidation' => false,
        'htmlOptions'          => array( 'enctype' => 'multipart/form-data' ),
    )
); ?>

<p class="help-block"></p>

<?php echo $form->errorSummary( $model ); ?>
<?php echo $form->textFieldRow( $model, 'title', array( 'class' => 'span5', 'maxlength' => 255 ) ); ?>
<p>
    <?php echo CHtml::image( $model->getImageUrl( '1180x180' ) ); ?>
    <?php echo $form->fileFieldRow(
        $model,
        'image',
        array( 'class' => 'span5', 'maxlength' => 40, 'prepend' => '<i class="icon-upload"></i>' )
    ); ?>
</p>
<?php echo $form->dropDownListRow( $model, 'show', $model->getShowData() ); ?>
<?php echo $form->textFieldRow( $model, 'url', array( 'class' => 'span5', 'maxlength' => 255 ) ); ?>
<?php echo $form->textFieldRow( $model, 'sort', array( 'class' => 'span1', 'maxlength' => 10 ) ); ?>
<?php echo $form->dropDownListRow(
    $model,
    'active',
    array(
        Yii::t( 'banner', 'Нет' ),
        Yii::t( 'banner', 'Да' ),
    )
); ?>
<div class="form-actions">
    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'buttonType' => 'submit',
            'type'       => 'primary',
            'label'      => $model->isNewRecord ? Yii::t( 'bootstrap', 'Создать.' ) : Yii::t( 'bootstrap', 'Сохранить.' ),
        )
    ); ?>
</div>
<?php $this->endWidget(); ?>
