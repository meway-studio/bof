<?php
$this->breadcrumbs = array(
    'Banners'     => array( 'index' ),
    $model->title => array( 'view', 'id' => $model->id ),
    'Update',
);

$this->menu = array(
    array( 'label' => Yii::t( 'banner', 'Управление баннерами' ), 'url' => array( 'admin' ) ),
    array( 'label' => Yii::t( 'banner', 'Создать баннер' ), 'url' => array( 'create' ) ),
);
?>

    <h1><?php echo Yii::t( 'banner', 'Редактирование баннера' ) ?> "<?php echo $model->title; ?>"</h1>

<?php echo $this->renderPartial( '_form', array( 'model' => $model ) ); ?>