<?php
$this->breadcrumbs=array(
	Yii::t('user', 'Отзывы')=>array('admin'),
	$model->id=>array('update','id'=>$model->id),
	Yii::t('user', 'Редактирование'),
);

$this->menu=array(
	array('label'=>Yii::t('user', 'Добавить отзыв'),'url'=>array('create')),
	array('label'=>Yii::t('user', 'Управление отзывами'),'url'=>array('admin')),
);
?>

<h3><?php echo Yii::t('user', 'Редактирование отзыва', array('{id}'=>$model->id)); ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>