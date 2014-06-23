<div class="site-width">
	<?php if(Yii::app()->user->hasFlash('createSuccess')):?>
		<span class="success"><?php echo Yii::app()->user->getFlash('createSuccess');?></span>
	<?php elseif(Yii::app()->user->hasFlash('createFailure')):?>
		<span class="error"><?php echo Yii::app()->user->getFlash('createFailure');?></span>
	<?php endif;?>

	<?php $this->renderPartial('_form_nb', array('model'=>$model));?>
</div>
