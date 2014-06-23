<?php
$this->breadcrumbs=array(
	Yii::t('user', 'Пользователи')=>array('admin'),
	$model->FullName=>array('view','id'=>$model->id),
	Yii::t('user', 'Редактирование'),
);

$this->menu=array(
	array('label'=>Yii::t('user', 'Просмотр пользователя'),'url'=>array('view','id'=>$model->id)),
	array('label'=>Yii::t('user', 'Управление пользователями'),'url'=>array('admin')),
);
?>

<h3><?php echo Yii::t('user', 'Редактирование пользователя - {fn}', array('{fn}'=>$model->FullName)); ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>