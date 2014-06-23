<?php
$this->breadcrumbs=array(
	Yii::t('GuidlineContent', 'Категории FAQ')=>array('admin'),
	$model->title=>array('update','id'=>$model->id),
	Yii::t('GuidlineContent', 'Обновить'),
);

$this->menu=array(
	array('label'=>Yii::t('GuidlineContent', 'Создать категорию FAQ'),'url'=>array('create')),
	array('label'=>Yii::t('GuidlineContent', 'Управление категорией FAQ'),'url'=>array('admin')),
);
?>

<h3><?php echo Yii::t('GuidlineContent', 'Обновление категории FAQ #{id}', array('{id}'=>$model->id)); ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>

<h3><?php echo Yii::t('GuidlineContent', 'Обновление вопросов в категории FAQ #{id}', array('{id}'=>$model->id)); ?></h3>

<hr />

<div class="form">
	
	<b><?php echo Yii::t('GuidlineContent', 'Добавить новый вопрос'); ?></b>
	
	<?php echo CHtml::beginForm(); ?>
	<table>
		<tr>
			<td><?php echo Yii::t('GuidlineContent', 'Статус'); ?></td>
			<td><?php echo CHtml::activeDropDownList($FaqItem,"[0]status", $FaqItem->statusList); ?></td>
		</tr>
		<tr>
			<td><?php echo Yii::t('GuidlineContent', 'Сортировка'); ?></td>
			<td><?php echo CHtml::activeTextField($FaqItem,"[0]sort"); ?></td>
		</tr>
		<tr>
			<td><?php echo Yii::t('GuidlineContent', 'Название'); ?></td>
			<td><?php echo CHtml::activeTextField($FaqItem,"[0]title"); ?></td>
		</tr>
		<tr>
			<td><?php echo Yii::t('GuidlineContent', 'Описание'); ?></td>
			<td><?php echo CHtml::activeTextArea($FaqItem,"[0]content"); ?></td>
		</tr>
	</table>
	
	<hr/>
	
	<b><?php echo Yii::t('GuidlineContent', 'Обновить созданные вопросы'); ?></b>
	
	<?php foreach($model->items as $item): ?>
		<hr/>
		<table id="FaqItem<?php echo $item->id;?>">
			<tr>
				<td><?php echo Yii::t('GuidlineContent', 'Статус'); ?></td>
				<td><?php echo CHtml::activeDropDownList($item,"[$item->id]status", $item->statusList); ?></td>
			</tr>
			<tr>
				<td><?php echo Yii::t('GuidlineContent', 'Сортировка'); ?></td>
				<td><?php echo CHtml::activeTextField($item,"[$item->id]sort"); ?></td>
			</tr>
			<tr>
				<td><?php echo Yii::t('GuidlineContent', 'Название'); ?></td>
				<td><?php echo CHtml::activeTextField($item,"[$item->id]title"); ?></td>
			</tr>
			<tr>
				<td><?php echo Yii::t('GuidlineContent', 'Описание'); ?></td>
				<td><?php echo CHtml::activeTextArea($item,"[$item->id]content"); ?></td>
			</tr>
			<tr>
				<td></td>
				<td><?php echo CHtml::link(Yii::t('GuidlineContent', 'Удалить'), array('/guidline/admin/faq/DeleteItem', 'id'=>$item->id), array('class'=>'DeleteItem', 'data-remove'=>'#FaqItem'.$item->id));?></td>
			</tr>
		<table>
	<?php endforeach; ?>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>Yii::t('GuidlineContent', 'Сохранить'),
		)); ?>
	</div>
	
	<?php echo CHtml::endForm(); ?>
</div><!-- form -->

<script>
	$(".DeleteItem").click(function(){
		var id = $(this).data('remove');
		
		if(confirm(<?php echo Yii::t('GuidlineContent', 'Вы это серьезно?'); ?>)){
			$.post($(this).attr('href'), {}, function(){
				$(id).fadeOut();
			});
		}
		
		return false;
	});
</script>