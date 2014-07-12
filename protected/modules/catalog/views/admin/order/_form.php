<?php
/* @var $this OrderController */
/* @var $model CatalogOrder */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget(
        'CActiveForm',
        array(
            'id'                   => 'catalog-order-form',
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

    <p>
        <?php echo $form->labelEx( $model, 'user_id' ); ?>
        <?php echo $form->textField( $model, 'user_id' ); ?>
        <?php echo $form->error( $model, 'user_id' ); ?>
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
        <?php echo $form->labelEx( $model, 'user_name' ); ?>
        <?php echo $form->textField( $model, 'user_name', array( 'size' => 60, 'maxlength' => 100 ) ); ?>
        <?php echo $form->error( $model, 'user_name' ); ?>
    </p>

    <p>
        <?php echo $form->labelEx( $model, 'user_email' ); ?>
        <?php echo $form->textField( $model, 'user_email', array( 'size' => 50, 'maxlength' => 50 ) ); ?>
        <?php echo $form->error( $model, 'user_email' ); ?>
    </p>

    <p>
        <?php echo $form->labelEx( $model, 'user_address' ); ?>
        <?php echo $form->textField( $model, 'user_address', array( 'size' => 60, 'maxlength' => 255 ) ); ?>
        <?php echo $form->error( $model, 'user_address' ); ?>
    </p>

    <p>
        <?php echo $form->labelEx( $model, 'user_phone' ); ?>
        <?php echo $form->textField( $model, 'user_phone', array( 'size' => 60, 'maxlength' => 255 ) ); ?>
        <?php echo $form->error( $model, 'user_phone' ); ?>
    </p>

    <p>
        <?php echo $form->labelEx( $model, 'comment' ); ?>
        <?php echo $form->textArea( $model, 'comment', array( 'rows' => 6, 'cols' => 50 ) ); ?>
        <?php echo $form->error( $model, 'comment' ); ?>
    </p>

    <p>
        <?php echo $form->labelEx( $model, 'delivery' ); ?>
        <?php echo $form->textField( $model, 'delivery' ); ?>
        <?php echo $form->error( $model, 'delivery' ); ?>
    </p>

    <p>
        <?php echo $form->labelEx( $model, 'status' ); ?>
        <?php echo $form->textField( $model, 'status' ); ?>
        <?php echo $form->error( $model, 'status' ); ?>
    </p>

    <?php
    $orderElement = CatalogOrderElement::model();
    $orderElement->order_id = $model->id;
    $orderElement->quantity = null;

    $this->widget(
        'bootstrap.widgets.TbGridView',
        array(
            'id'              => 'catalog-element-grid',
            'dataProvider'    => $orderElement->search(),
            'filter'          => $orderElement,
            'summaryCssClass' => '',
            'summaryText'     => '<p><h4>Позиции заказа [ {start} - {end} из {count} ]</h4></p>',
            'columns'         => array(
                array(
                    'name'        => 'id',
                    'value'       => '$data->id',
                    'htmlOptions' => array( 'style' => 'width:50px;' ),
                ),
                array(
                    'name'        => 'quantity',
                    'value'       => '$data->quantity',
                    'htmlOptions' => array( 'style' => 'width:50px;' ),
                ),
                array(
                    'name'        => 'create_date',
                    'value'       => '$data->create_date',
                    'htmlOptions' => array( 'style' => 'width:150px;' ),
                ),
                array(
                    'header' => 'Наименование',
                    'name'   => 'element_title_search',
                    'value'  => '$data->element->title',
                ),
                array(
                    'class'   => 'bootstrap.widgets.TbButtonColumn',
                    'buttons' => array(
                        'view'   => array(
                            'url' => 'Yii::app()->createUrl("catalog/element/view", array("id" => $data->element_id))',
                        ),
                        'delete' => array(
                            'url' => 'Yii::app()->createUrl("catalog/admin/order/deleteElement", array("id" => $data->id, "element_id" => $data->element_id))',
                        ),
                    ),
                ),
            ),
        )
    ); ?>

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

</div><!-- form -->