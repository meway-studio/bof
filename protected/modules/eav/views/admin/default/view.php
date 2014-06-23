<?php $this->pageTitle = $model->title;?>

<h3><?php echo $model->title;?></h3>

<p><?php echo $model->description;?></p>

<?php if(Yii::app()->user->hasFlash('form_failure')): ?>
	<div class="flash-error"><?php echo Yii::app()->user->getFlash('form_failure'); ?></div>
<?php endif; ?>

<?php if(Yii::app()->user->hasFlash('form_success')): ?>
	<div class="flash-success"><?php echo Yii::app()->user->getFlash('form_success'); ?></div>
<?php else: ?>

	<div class="form">
		<?php echo $form;?>
	</div>

<?php endif; ?>

<p><?php echo $model->advanced;?></p>