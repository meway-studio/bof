<?php $form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
        'id'                   => 'category-form',
        'enableAjaxValidation' => false,
        'htmlOptions'          => array( 'enctype' => 'multipart/form-data' ),
    )
); ?>

<p class="help-block">
    <?= Yii::t( 'CatalogModule.admin.category.main', '<span class="required">*</span> Поля, обязательные для заполнения.' ) ?>
</p>
<br/>
<?php echo $form->errorSummary( $model ); ?>

<p>
    <?php echo $form->textFieldRow( $model, 'title', array( 'class' => 'span4', 'maxlength' => 255 ) ); ?>
</p>

<p>
    <?php echo $form->textFieldRow( $model, 'name', array( 'class' => 'span4', 'maxlength' => 100 ) ); ?>
</p>

<div class="form-actions">
    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'buttonType' => 'submit',
            'type'       => 'primary',
            'label'      => $model->isNewRecord ? Yii::t( 'CatalogModule.admin.category.main', 'Добавить' ) : Yii::t(
                    'CatalogModule.admin.catalog',
                    Yii::t( 'CatalogModule.admin.category.main', 'Сохранить' )
                ),
        )
    ); ?>
</div>

<?php $this->endWidget(); ?>
