<?php
$this->breadcrumbs=array(
	Yii::t('GuidlineContent', 'Категории FAQ')=>array('admin'),
	Yii::t('GuidlineContent', 'Cоздать'),
);

$this->menu=array(
	array('label'=>Yii::t('GuidlineContent', 'Управление категориями FAQ'),'url'=>array('admin')),
);
?>

<h3><?php echo Yii::t('GuidlineContent', 'Создать категорию FAQ'); ?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>