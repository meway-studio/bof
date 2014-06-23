<?php
	Yii::app()->clientScript->registerScriptFile('/js/chosen/chosen.jquery.min.js');
	Yii::app()->clientScript->registerScriptFile('/js/redactor/redactor.js');
	Yii::app()->clientScript->registerScriptFile('/js/tag-it/tag-it.min.js');
	Yii::app()->clientScript->registerScriptFile('/js/form.js');
	Yii::app()->clientScript->registerCssFile('/js/redactor/redactor.css');
	Yii::app()->clientScript->registerCssFile('/js/chosen/chosen.css');
	Yii::app()->clientScript->registerCssFile('/js/tag-it/jquery.tagit.css');
?>
<h3>Конструктор форм Yiiii!</h3>
<div id="tabs">

	<ul class="nav nav-tabs" id="form_tab">
		<li><a href="#formparams">Параметры формы</a></li>
		<li><a href="#elements">Элементы формы</a></li>
	</ul>
	
	<div class="tab-content">
		<div id="formparams" class="tab-pane">
			<?php $this->renderPartial('_form_settings',array('model'=>$model));?>
		</div>
		<div id="elements" class="tab-pane form-horizontal">
			
			<h4>Элементы формы</h4>

			<div id="formElementsBox">
				<?php $this->renderPartial('_form',array('model'=>$model)); ?>
			</div>

			<div class="form-actions navbar navbar-fixed-bottom">
			 <?php echo CHtml::link('Добавить',array('form/createElement','id'=>$model->id),array('class'=>'createElement btn btn-success','data-block'=>'formElementsBox','data-form-id'=>$model->id));?>
			</div>
					
		</div>
	</div>

</div>

<div id="dialog"></div>
