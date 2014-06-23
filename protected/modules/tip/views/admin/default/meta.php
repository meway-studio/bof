<?php
$this->breadcrumbs=array( 
    'SEO'
);
/* @var $this MetaFormController */
/* @var $model MetaForm */
/* @var $form CActiveForm */
?>

<h3><?php echo Yii::t('tips', 'Ключевые слова и описание'); ?></h3>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'meta-form-meta-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	
	<table>
	
		<thead>
			<td><b><?php echo Yii::t('tips', 'Страница'); ?></b></td>
			<td><b><?php echo Yii::t('tips', 'Слова'); ?></b></td>
			<td><b><?php echo Yii::t('tips', 'Описание'); ?></b></td>
		</thead>

		<tr>
		<td><?php echo $form->labelEx($model,'META_K_INDEX'); ?></td>
		<td><?php echo $form->textField($model,'META_K_INDEX'); ?></td>
		<td><?php echo $form->error($model,'META_K_INDEX'); ?></td>
		
		<td><?php echo $form->textField($model,'META_D_INDEX'); ?></td>
		<td><?php echo $form->error($model,'META_D_INDEX'); ?></td>
		</tr>

		<tr>
		<td><?php echo $form->labelEx($model,'META_K_STATS_ALL_TIME'); ?></td>
		<td><?php echo $form->textField($model,'META_K_STATS_ALL_TIME'); ?></td>
		<td><?php echo $form->error($model,'META_K_STATS_ALL_TIME'); ?></td>
		
		<td><?php echo $form->textField($model,'META_D_STATS_ALL_TIME'); ?></td>
		<td><?php echo $form->error($model,'META_D_STATS_ALL_TIME'); ?></td>
		</tr>

		<tr>
		<td><?php echo $form->labelEx($model,'META_K_PAGE_ABOUT'); ?></td>
		<td><?php echo $form->textField($model,'META_K_PAGE_ABOUT'); ?></td>
		<td><?php echo $form->error($model,'META_K_PAGE_ABOUT'); ?></td>
		
		<td><?php echo $form->textField($model,'META_D_PAGE_ABOUT'); ?></td>
		<td><?php echo $form->error($model,'META_D_PAGE_ABOUT'); ?></td>
		</tr>

		<tr>
		<td><?php echo $form->labelEx($model,'META_K_SUBSCRIPTION'); ?></td>
		<td><?php echo $form->textField($model,'META_K_SUBSCRIPTION'); ?></td>
		<td><?php echo $form->error($model,'META_K_SUBSCRIPTION'); ?></td>
		
		<td><?php echo $form->textField($model,'META_D_SUBSCRIPTION'); ?></td>
		<td><?php echo $form->error($model,'META_D_SUBSCRIPTION'); ?></td>
		</tr>

		<tr>
		<td><?php echo $form->labelEx($model,'META_K_CONTACTS'); ?></td>
		<td><?php echo $form->textField($model,'META_K_CONTACTS'); ?></td>
		<td><?php echo $form->error($model,'META_K_CONTACTS'); ?></td>
		
		<td><?php echo $form->textField($model,'META_D_CONTACTS'); ?></td>
		<td><?php echo $form->error($model,'META_D_CONTACTS'); ?></td>
		</tr>

		<tr>
		<td><?php echo $form->labelEx($model,'META_K_GUIDELINE'); ?></td>
		<td><?php echo $form->textField($model,'META_K_GUIDELINE'); ?></td>
		<td><?php echo $form->error($model,'META_K_GUIDELINE'); ?></td>
		
		<td><?php echo $form->textField($model,'META_D_GUIDELINE'); ?></td>
		<td><?php echo $form->error($model,'META_D_GUIDELINE'); ?></td>
		</tr>

		<tr>
		<td><?php echo $form->labelEx($model,'META_K_PAGE_TERMS'); ?></td>
		<td><?php echo $form->textField($model,'META_K_PAGE_TERMS'); ?></td>
		<td><?php echo $form->error($model,'META_K_PAGE_TERMS'); ?></td>
		
		<td><?php echo $form->textField($model,'META_D_PAGE_TERMS'); ?></td>
		<td><?php echo $form->error($model,'META_D_PAGE_TERMS'); ?></td>
		</tr>

		<tr>
		<td><?php echo $form->labelEx($model,'META_K_ALL_TIPS'); ?></td>
		<td><?php echo $form->textField($model,'META_K_ALL_TIPS'); ?></td>
		<td><?php echo $form->error($model,'META_K_ALL_TIPS'); ?></td>
		
		<td><?php echo $form->textField($model,'META_D_ALL_TIPS'); ?></td>
		<td><?php echo $form->error($model,'META_D_ALL_TIPS'); ?></td>
		</tr>

		<tr>
		<td><?php echo $form->labelEx($model,'META_K_ALL_TIPS_0'); ?></td>
		<td><?php echo $form->textField($model,'META_K_ALL_TIPS_0'); ?></td>
		<td><?php echo $form->error($model,'META_K_ALL_TIPS_0'); ?></td>
		
		<td><?php echo $form->textField($model,'META_D_ALL_TIPS_0'); ?></td>
		<td><?php echo $form->error($model,'META_D_ALL_TIPS_0'); ?></td>
		</tr>

		<tr>
		<td><?php echo $form->labelEx($model,'META_K_ALL_TIPS_1'); ?></td>
		<td><?php echo $form->textField($model,'META_K_ALL_TIPS_1'); ?></td>
		<td><?php echo $form->error($model,'META_K_ALL_TIPS_1'); ?></td>

		<td><?php echo $form->textField($model,'META_D_ALL_TIPS_1'); ?></td>
		<td><?php echo $form->error($model,'META_D_ALL_TIPS_1'); ?></td>
		</tr>

		<tr>
		<td><?php echo $form->labelEx($model,'META_K_ALL_STATS'); ?></td>
		<td><?php echo $form->textField($model,'META_K_ALL_STATS'); ?></td>
		<td><?php echo $form->error($model,'META_K_ALL_STATS'); ?></td>

		<td><?php echo $form->textField($model,'META_D_ALL_STATS'); ?></td>
		<td><?php echo $form->error($model,'META_D_ALL_STATS'); ?></td>
		</tr>

		<tr>
		<td><?php echo $form->labelEx($model,'META_K_PROFILE'); ?></td>
		<td><?php echo $form->textField($model,'META_K_PROFILE'); ?></td>
		<td><?php echo $form->error($model,'META_K_PROFILE'); ?></td>

		<td><?php echo $form->textField($model,'META_D_PROFILE'); ?></td>
		<td><?php echo $form->error($model,'META_D_PROFILE'); ?></td>
		</tr>

		<tr>
		<td><?php echo $form->labelEx($model,'META_K_PURCHASE'); ?></td>
		<td><?php echo $form->textField($model,'META_K_PURCHASE'); ?></td>
		<td><?php echo $form->error($model,'META_K_PURCHASE'); ?></td>
		
		<td><?php echo $form->textField($model,'META_D_PURCHASE'); ?></td>
		<td><?php echo $form->error($model,'META_D_PURCHASE'); ?></td>
		</tr>

		<tr>
		<td><?php echo $form->labelEx($model,'META_K_ADD_TIP'); ?></td>
		<td><?php echo $form->textField($model,'META_K_ADD_TIP'); ?></td>
		<td><?php echo $form->error($model,'META_K_ADD_TIP'); ?></td>
		
		<td><?php echo $form->textField($model,'META_D_ADD_TIP'); ?></td>
		<td><?php echo $form->error($model,'META_D_ADD_TIP'); ?></td>
		</tr>

		<tr>
		<td><?php echo $form->labelEx($model,'META_K_DRAFTS'); ?></td>
		<td><?php echo $form->textField($model,'META_K_DRAFTS'); ?></td>
		<td><?php echo $form->error($model,'META_K_DRAFTS'); ?></td>

		<td><?php echo $form->textField($model,'META_D_DRAFTS'); ?></td>
		<td><?php echo $form->error($model,'META_D_DRAFTS'); ?></td>
		</tr>

		<tr>
		<td><?php echo $form->labelEx($model,'META_K_CART'); ?></td>
		<td><?php echo $form->textField($model,'META_K_CART'); ?></td>
		<td><?php echo $form->error($model,'META_K_CART'); ?></td>

		<td><?php echo $form->textField($model,'META_D_CART'); ?></td>
		<td><?php echo $form->error($model,'META_D_CART'); ?></td>
		</tr>
		
		<!-- -->
		
		<tr>
		<td><?php echo $form->labelEx($model,'META_K_LOGIN'); ?></td>
		<td><?php echo $form->textField($model,'META_K_LOGIN'); ?></td>
		<td><?php echo $form->error($model,'META_K_LOGIN'); ?></td>

		<td><?php echo $form->textField($model,'META_D_LOGIN'); ?></td>
		<td><?php echo $form->error($model,'META_D_LOGIN'); ?></td>
		</tr>
		
		<tr>
		<td><?php echo $form->labelEx($model,'META_K_SIGNUP'); ?></td>
		<td><?php echo $form->textField($model,'META_K_SIGNUP'); ?></td>
		<td><?php echo $form->error($model,'META_K_SIGNUP'); ?></td>

		<td><?php echo $form->textField($model,'META_D_SIGNUP'); ?></td>
		<td><?php echo $form->error($model,'META_D_SIGNUP'); ?></td>
		</tr>
		
		<tr>
		<td><?php echo $form->labelEx($model,'META_K_CONFIRM'); ?></td>
		<td><?php echo $form->textField($model,'META_K_CONFIRM'); ?></td>
		<td><?php echo $form->error($model,'META_K_CONFIRM'); ?></td>

		<td><?php echo $form->textField($model,'META_D_CONFIRM'); ?></td>
		<td><?php echo $form->error($model,'META_D_CONFIRM'); ?></td>
		</tr>
		
		<tr>
		<td><?php echo $form->labelEx($model,'META_K_FORGOT'); ?></td>
		<td><?php echo $form->textField($model,'META_K_FORGOT'); ?></td>
		<td><?php echo $form->error($model,'META_K_FORGOT'); ?></td>

		<td><?php echo $form->textField($model,'META_D_FORGOT'); ?></td>
		<td><?php echo $form->error($model,'META_D_FORGOT'); ?></td>
		</tr>
		
		<tr>
		<td><?php echo $form->labelEx($model,'META_K_RESTORE'); ?></td>
		<td><?php echo $form->textField($model,'META_K_RESTORE'); ?></td>
		<td><?php echo $form->error($model,'META_K_RESTORE'); ?></td>

		<td><?php echo $form->textField($model,'META_D_RESTORE'); ?></td>
		<td><?php echo $form->error($model,'META_D_RESTORE'); ?></td>
		</tr>
		
		<tr>
		<td><?php echo $form->labelEx($model,'META_K_UNSCRIBE'); ?></td>
		<td><?php echo $form->textField($model,'META_K_UNSCRIBE'); ?></td>
		<td><?php echo $form->error($model,'META_K_UNSCRIBE'); ?></td>

		<td><?php echo $form->textField($model,'META_D_UNSCRIBE'); ?></td>
		<td><?php echo $form->error($model,'META_D_UNSCRIBE'); ?></td>
		</tr>
		
	</table>
	
	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>Yii::t('tips', 'Сохранить'),
		)); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->