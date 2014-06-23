<?php
$this->breadcrumbs=array(
	Yii::t('GuidlineContent', 'Золотые правила')=>array('admin'),
	$model->id,
);

$this->menu=array(
	array('label'=>Yii::t('GuidlineContent', 'Создать Золотое Правило'),'url'=>array('create')),
	array('label'=>Yii::t('GuidlineContent', 'Управление Золотыми правилами'),'url'=>array('admin')),
);
?>

<h3><?php Yii::t('GuidlineContent', 'Обновить Золотое правило #{id}', array('{id}',$model->id)); ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>