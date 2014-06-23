<?php
$this->breadcrumbs = array(
    'Banners' => array( 'index' ),
    'Manage',
);

$this->menu = array(
    array( 'label' => Yii::t( 'banner', 'Управление баннерами' ), 'url' => array( 'admin' ) ),
);
?>

    <h1><?php echo Yii::t( 'banner', 'Создать баннер' ) ?></h1>

<?php echo $this->renderPartial( '_form', array( 'model' => $model ) ); ?>