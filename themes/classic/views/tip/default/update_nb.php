<div class="site-width">
	<?php if(Yii::app()->user->hasFlash('updateSuccess')):?>
		<span class="success"><?php echo Yii::app()->user->getFlash('updateSuccess');?></span>
	<?php elseif(Yii::app()->user->hasFlash('updateFailure')):?>
		<span class="error"><?php echo Yii::app()->user->getFlash('updateFailure');?></span>
	<?php endif;?>

	<?php $this->renderPartial('_form_nb', array('model'=>$model));?>
</div>
