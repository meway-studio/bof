<?php
/**
 * @var $form TbActiveForm
 */
//CVarDumper::dump($model, 100, 1);
$form = $this->beginWidget(
    'bootstrap.widgets.TbActiveForm',
    array(
        'id'                   => 'category-form',
        'enableAjaxValidation' => false,
        'htmlOptions'          => array( 'enctype' => 'multipart/form-data' ),
    )
); ?>

<p class="help-block">
    <?= Yii::t( 'CatalogModule.admin.main', '<span class="required">*</span> Поля, обязательные для заполнения.' ) ?>
</p>

<br/>

<?php echo $form->errorSummary( $model ); ?>

<p>
    <?php echo CHtml::image( $model->getImageUrl( '150x150' ) ); ?>
    <?php echo $form->fileFieldRow(
        $model,
        'image',
        array( 'class' => 'span5', 'maxlength' => 40, 'prepend' => '<i class="icon-upload"></i>' )
    ); ?>
</p>

<p>
    <?php echo $form->textFieldRow( $model, 'title', array( 'class' => 'span4', 'maxlength' => 255 ) ); ?>
</p>

<p>
    <?php echo $form->textFieldRow( $model, 'name', array( 'class' => 'span4', 'maxlength' => 100 ) ); ?>
</p>

<p>
    <?php echo $form->labelEx( new CatalogEvent(), 'start_date' ); ?>
    <?php Yii::import( 'ext.datetimepicker.CJuiDateTimePicker' );
    $this->widget(
        'CJuiDateTimePicker',
        array(
            'model'     => $model, //Model object
            'attribute' => 'start_date', //attribute name
            'mode'      => 'datetime', //use "time","date" or "datetime" (default)
            'options'   => array(
                'dateFormat' => 'yy-mm-dd',
                'timeFormat' => 'hh:mm:ss',
                // @todo: Привести к виду LocaleExtensions::getJQueryDateFormat(Yii::app()->getModule('user')->birth_date_format)
            ),
        )
    );
    ?>
</p>

<p>
    <?php echo $form->labelEx( new CatalogEvent(), 'finish_date' ); ?>
    <?php Yii::import( 'ext.datetimepicker.CJuiDateTimePicker' );
    $this->widget(
        'CJuiDateTimePicker',
        array(
            'model'     => $model, //Model object
            'attribute' => 'finish_date', //attribute name
            'mode'      => 'datetime', //use "time","date" or "datetime" (default)
            'options'   => array(
                'dateFormat' => 'yy-mm-dd',
                'timeFormat' => 'hh:mm:ss',
            ),
        )
    );
    ?>
</p>

<p>
    <?php echo $form->labelEx( $model, 'create_date' ); ?>
    <?php Yii::import( 'ext.datetimepicker.CJuiDateTimePicker' );
    $this->widget(
        'CJuiDateTimePicker',
        array(
            'model'     => $model, //Model object
            'attribute' => 'create_date', //attribute name
            'mode'      => 'datetime', //use "time","date" or "datetime" (default)
            'options'   => array(
                'dateFormat' => 'yy-mm-dd',
                'timeFormat' => 'hh:mm:ss',
            ),
        )
    );
    ?>
</p>

<p>
    <?php echo $form->labelEx( $model, 'publish_date' ); ?>
    <?php Yii::import( 'ext.datetimepicker.CJuiDateTimePicker' );
    $this->widget(
        'CJuiDateTimePicker',
        array(
            'model'     => $model, //Model object
            'attribute' => 'publish_date', //attribute name
            'mode'      => 'datetime', //use "time","date" or "datetime" (default)
            'options'   => array(
                'dateFormat' => 'yy-mm-dd',
                'timeFormat' => 'hh:mm:ss',
            ),
        )
    );
    ?>
</p>

<p>
    <?php echo $form->labelEx( $model, 'short_description' ); ?>
    <?php $this->widget(
        'ext.redactor.redactor',
        array(
            'model'     => $model,
            'language'  => Yii::app()->language,
            'attribute' => 'short_description',
            'settings'  => array(
                //'imageUpload' => Yii::app()->createUrl( '/tip/default/redactor' ),
                'minHeight' => 150,
            ),
            'plugins'   => array(
                'fontcolor',
                'fontfamily',
            ),

        )
    ); ?>
</p>

<p>
    <?php echo $form->labelEx( $model, 'full_description' ); ?>
    <?php $this->widget(
        'ext.redactor.redactor',
        array(
            'model'     => $model,
            'language'  => Yii::app()->language,
            'attribute' => 'full_description',
            'settings'  => array(
                'imageUpload' => Yii::app()->createUrl( '/tip/default/redactor' ),
                'minHeight'   => 150,
            ),
            'plugins'   => array(
                'fontcolor',
                'fontfamily',
            ),

        )
    ); ?>
</p>

<p>
    <?= $form->dropDownListRow( $model, 'draft', array( 'Нет', 'Да' ), array( 'class' => 'span5' ) ); ?>
</p>

<p>
    <?= $form->dropDownListRow( $model, 'published', array( 'Нет', 'Да' ), array( 'class' => 'span5' ) ); ?>
</p>

<p>
    <?= $form->dropDownListRow( $model, 'active', array( 'Нет', 'Да' ), array( 'class' => 'span5' ) ); ?>
</p>

<?= $form->hiddenField( $model, 'category_id' ) ?>

<div class="form-actions">
    <?php $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'buttonType' => 'submit',
            'type'       => 'primary',
            'label'      => $model->isNewRecord ? Yii::t( 'CatalogModule.admin.catalog', 'Добавить' ) : Yii::t(
                    'CatalogModule.admin.catalog',
                    'Сохранить'
                ),
        )
    ); ?>
</div>

<?php $this->endWidget(); ?>
