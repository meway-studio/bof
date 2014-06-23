<?php
/* @var $this DefaultController */

$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1><?php echo $this->uniqueId . '/' . $this->action->id; ?></h1>

<p>
    <?php echo Yii::t('user', 'Этот вид контента для действий {aid}. Действие относится к контроллеру {get} в {mid} модуль.', array('{aid}' => $this->action->id, '{get}' => get_class($this), '{mid}' => $this->module->id)); ?>
</p>
<p>
    <?php echo Yii::t('user', 'Вы можете настроить страницу, редактируя'); ?> <tt><?php echo __FILE__; ?></tt>
</p>