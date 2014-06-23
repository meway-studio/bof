<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'reviews-form',
	'enableAjaxValidation'=>false,
	'action'      => $model->isNewRecord ? array('create') : array('update', 'id'=>$model->id),
)); ?>

	<p class="help-block"><?php echo Yii::t('user', 'Поля с {s} обязательны для заполнения.', array('{s}'=>'<span class="required">*</span>')); ?></p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownList($model,'status', $model->statusList, array('class'=>'span5')); ?>
	
	<?php echo $form->textFieldRow($model,'sort',array('class'=>'span5')); ?>

	<div>
		<?php echo $form->labelEx($model,'user_id'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
            'model'=>$model, // модель
            'attribute'=>'user_name', // атрибут модели
            // "источник" данных для выборки
            // может быть url, который возвращает JSON, массив
            // или функция JS('js: alert("Hello!");')
            'source'=>$this->createUrl('autocomplete'),
            // параметры, подробнее можно посмотреть на сайте
            // http://jqueryui.com/demos/autocomplete/
            'options'=>array(
                // минимальное кол-во символов, после которого начнется поиск
                'minLength'=>'3',
                // обработчик события, выбор пункта из списка
                'select' =>'js: function(event, ui) {
                    // действие по умолчанию, значение текстового поля
                    // устанавливается в значение выбранного пункта
                    this.value = ui.item.label;
                    // устанавливаем значения скрытого поля
                    $("#Reviews_user_id").val(ui.item.id);
                    return false;
                }',
            ),
            'htmlOptions' => array(
                'maxlength' => 50,
                'class'     => 'span5',
            ),
        )); ?>
        <?php echo $form->hiddenField($model,'user_id', array('style'=>'display: none;')); ?>
		<?php echo $form->error($model,'user_id'); ?>

    </div>

	<?php echo $form->textAreaRow($model,'content',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'       => 'primary',
			'label'      => $model->isNewRecord ? Yii::t('user', 'Создать') : Yii::t('user', 'Сохранить'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>
