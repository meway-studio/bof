<?php
$this->breadcrumbs=array(
	Yii::t('tips', 'Советы')=>array('admin'),
	Yii::t('tips', 'Создать'),
);

$this->menu=array(
	array('label'=>Yii::t('tips', 'Управление советами'),'url'=>array('admin')),
);
?>

<h3><?php echo Yii::t('tips', 'Создать совет'); ?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>