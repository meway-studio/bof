<?php
$this->breadcrumbs=array(
	Yii::t('GuidlineContent', 'Золотые правила')=>array('admin'),
	Yii::t('GuidlineContent', 'Создать'),
);

$this->menu=array(
	array('label'=>Yii::t('GuidlineContent', 'Управление Золотым правилом'),'url'=>array('admin')),
);
?>

<h3><?php Yii::t('GuidlineContent', 'Создать Золотое Правило'); ?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>