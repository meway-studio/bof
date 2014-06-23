<?php
/* @var $this FormsController */
/* @var $model Forms */
/* @var $form CActiveForm */
?>

<table class="table table-hover" id="formElements" data-form-id="<?php echo $model->id;?>">
<?php foreach($model->attributes AS $i=>$attribute):?>
	<tr id="formElement_<?php echo $attribute->id;?>">
		<td><i class="icon-align-justify"></i></td>
		<td><label class="<?php echo $attribute->LabelClass;?>"><?php echo $attribute->Preview;?></label></td>
		<td>
			<?php echo CHtml::link('<i class="icon-pencil"></i>',array('form/updateElement','id'=>$attribute->id),array('class'=>'updateElement','data-form-id'=>$model->id));?>
			<?php echo CHtml::link('<i class="icon-trash"></i>',array('form/deleteElement','id'=>$attribute->id),array('class'=>'deleteElement','data-block'=>"formElement_{$attribute->id}"));?>
		</td>
	</tr>
<?php endforeach;?>
</table>