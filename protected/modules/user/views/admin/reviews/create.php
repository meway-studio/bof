<?php
$this->breadcrumbs=array(
	Yii::t('user', 'Отзывы')=>array('admin'),
	Yii::t('user', 'Добавить'),
);

$this->menu=array(
	array('label'=>Yii::t('user', 'Управление отзывами'),'url'=>array('admin')),
);
?>

<h3><?php echo Yii::t('user', 'Добавить отзыв'); ?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>