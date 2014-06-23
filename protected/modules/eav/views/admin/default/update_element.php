<h4>Элемент #<?php echo $element->id;?>: <?php echo $element->name;?></h4>

<div id="elementTabs" class="tabbable tabs-left">

	<ul id="form_elements" class="nav nav-tabs">
		<li><a href="#property">Свойства</a></li>
		<li><a href="#options">Опции</a></li>
		<li><a href="#validation">Валидация</a></li>
	</ul>
	
	<div class="tab-content">	
		<div class="tab-pane" id="property">
			<?php $this->renderPartial('_form_form',array('element'=>$element));?>
		</div>
		
		<div class="tab-pane" id="options">
			<b>Опции Элмента</b>
			
			<div id="elementOptions_<?php echo $element->id;?>">
				<?php foreach($element->options AS $i=>$option):?>
					<?php $this->renderPartial('_options_form',array('option'=>$option));?>
				<?php endforeach;?>
			</div>

			<?php echo CHtml::link('Add Option',array('form/createElementOption','id'=>$element->id),array('class'=>'createElementOption btn btn-success','data-block'=>"elementOptions_{$element->id}"));?>
		</div>

		<div class="tab-pane" id="validation">
			
			<h4>Правила валидации</h4>
			
			<?php foreach($element->rules AS $i=>$rules):?>
				<?php $this->renderPartial('_rules_form',array('rules'=>$rules));?>
			<?php endforeach;?>
			
			<div class="form-inline">
				<?php echo CHtml::activeDropDownList($rules,'validator',$rules->ValidatorList); ?>
				<?php echo CHtml::link('Добавить валидатор',array('form/createValidator','id'=>$element->id),array('class'=>'createValidator btn btn-success')); ?>
			</div>
			<br>

		</div><!-- form -->
	</div>

</div>

<script>
	$('#form_elements a').click(function (e) {
	  e.preventDefault();
	  $(this).tab('show');
	});
	$('#form_elements a:first').tab('show');
	$('#Elements_name').focus();
</script>