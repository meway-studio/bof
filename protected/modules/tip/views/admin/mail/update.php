<?php
/* @var $this MailController */
/* @var $model MailTask */

$this->breadcrumbs=array(
	Yii::t('tips', 'Рассылка')=>array('admin'),
	Yii::t('tips', 'Редактирование'),
);

$this->menu=array(
	array('label'=>Yii::t('tips', 'Добавить рассылку'), 'url'=>array('create')),
	array('label'=>Yii::t('tips', 'Управление рассылкой'), 'url'=>array('admin')),
);
?>

<h3><?php echo Yii::t('tips', 'Реадктирование рассылки #{id}', array('{id}'=>$model->id)); ?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>