<?php
$this->breadcrumbs = array(
    Yii::t( 'banner', 'Баннеры' ),
);

$this->menu = array(
    array( 'label' => Yii::t( 'banner', 'Создать баннер' ), 'url' => array( 'create' ) ),
);

Yii::app()->clientScript->registerScript(
    'search',
    "
   $('.search-button').click(function(){
       $('.search-form').toggle();
       return false;
   });
   $('.search-form form').submit(function(){
       $.fn.yiiGridView.update('banner-grid', {
           data: $(this).serialize()
       });
       return false;
   });
   "
);
?>

<h1><?php echo Yii::t( 'banner', 'Баннеры' ) ?></h1>

<p></p>

<?php echo CHtml::link( Yii::t( 'banner', 'Расширенный поиск' ), '#', array( 'class' => 'search-button btn' ) ); ?>
<div class="search-form" style="display:none">
    <?php $this->renderPartial(
        '_search',
        array(
            'model' => $model,
        )
    ); ?>
</div><!-- search-form -->

<?php $this->widget(
    'bootstrap.widgets.TbGridView',
    array(
        'id'           => 'banner-grid',
        'dataProvider' => $model->search(),
        'filter'       => $model,
        'columns'      => array(
            'id',
            'sort',
            'create_date',
            'title',
            array(
                'name' => 'show',
                'value' => 'Yii::t("banner", $data->show)'
            ),
            array(
                'name' => 'active',
                'value' => '$data->active == 1 ? Yii::t("banner", "Да") : Yii::t("banner", "Нет")'
            ),
            array(
                'class' => 'bootstrap.widgets.TbButtonColumn',
            ),
        ),
    )
); ?>
