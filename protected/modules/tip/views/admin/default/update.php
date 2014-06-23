<?php
$this->breadcrumbs=array(
	Yii::t('tips', 'Советы')=>array('admin'),
	$model->title=>array('view','id'=>$model->id),
	Yii::t('tips', 'Обновление'),
);

$this->menu=array(
	array('label'=>Yii::t('tips', 'Создать совет'),'url'=>array('create')),
	array('label'=>Yii::t('tips', 'Смотреть совет'),'url'=>array('view','id'=>$model->id)),
	array('label'=>Yii::t('tips', 'Управление советами'),'url'=>array('admin')),
);
?>

<h3><?php echo Yii::t('tips', 'Управление советом {title}', array('{title}'=>'<em>'.$model->title."</em>")); ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>