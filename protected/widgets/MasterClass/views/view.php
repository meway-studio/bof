<div class="contact-form" id="masterclass-form-container" itemscope itemtype="http://schema.org/Organization">
    <div class="help">
        <?php
        /**
         * @var CActiveForm $form
         */
        $form = $this->beginWidget(
            'CActiveForm',
            array(
                'id'                   => 'masterclass-form',
                'enableAjaxValidation' => false,
                'action'               => '#masterclass-form-container',
            )
        ); ?>

        <span class="say-hi"><?php echo Yii::t( 'masterclass', 'Заявка на мастер-класс' ); ?></span>
        <?php if (Yii::app()->user->hasFlash( 'masterclassSuccess' )): ?>
            <span class="success" style="margin: 20px auto;height: 25px;"><?php echo Yii::app()->user->getFlash(
                    'masterclassSuccess'
                ); ?></span>
        <?php endif ?>
        <?php echo $form->textField( $model, 'name', array( 'class' => 'name', 'placeholder' => Yii::t( 'masterclass', 'Имя' ) ) ); ?>
        <?php echo $form->error( $model, 'name', array( 'class' => 'oops' ) ); ?>

        <?php echo $form->textField(
            $model,
            'email',
            array( 'class' => 'mail', 'placeholder' => Yii::t( 'masterclass', 'Ваш электронный адрес' ) )
        ); ?>
        <?php echo $form->error( $model, 'email', array( 'class' => 'oops' ) ); ?>

        <div class="row-float">
            <?php echo $form->radioButtonList(
                $model,
                'type',
                array(
                    'seminar' => Yii::t( 'masterclass', 'СЕМИНАР' ),
                    'webinar' => Yii::t( 'masterclass', 'ВЕБИНАР' ),
                ),
                array(
                    'class'        => 'type-radio',
                    'separator'    => '',
                    'labelOptions' => array(
                        'class' => 'type-radio-label',
                    ),
                )
            ) ?>
        </div>

        <div class="row">
            <?php Yii::import( 'ext.datetimepicker.CJuiDateTimePicker' );
            $this->widget(
                'CJuiDateTimePicker',
                array(
                    'model'       => $model, //Model object
                    'attribute'   => 'time', //attribute name
                    'mode'        => 'datetime', //use "time","date" or "datetime" (default)
                    'language'    => 'en-GB',
                    'options'     => array(
                        'dateFormat' => 'yy-mm-dd',
                        'timeFormat' => 'hh:mm:ss',
                        // @todo: Привести к виду LocaleExtensions::getJQueryDateFormat(Yii::app()->getModule('user')->birth_date_format)
                    ),
                    'htmlOptions' => array(
                        'class'       => 'time',
                        'placeholder' => Yii::t( 'masterclass', 'Удобное время для встречи' ),
                    ),
                )
            );
            ?>
            <?php echo $form->error( $model, 'time', array( 'class' => 'oops' ) ); ?>
        </div>

        <?php //echo $form->labelEx($model,'details'); ?>
        <?php echo $form->textArea(
            $model,
            'details',
            array( 'class' => 'details', 'placeholder' => Yii::t( 'masterclass', 'Детали' ) )
        ); ?>
        <?php echo $form->error( $model, 'details', array( 'class' => 'oops' ) ); ?>

        <input class="submit" type="submit" value="<?php echo Yii::t( 'masterclass', 'Отправить' ); ?>">

        <?php $this->endWidget(); ?>
    </div>
</div>