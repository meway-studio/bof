<?php
/**
 * @var $this DefaultController
 * @var $category CatalogCategory
 */
$this->menu = array();
$this->menu[ ] = array(
    'label' => Yii::t( 'CatalogModule.admin.menu', 'Создать событие' ),
    'url'   => Yii::app()->createUrl( 'catalog/admin/element/create', array( 'id' => $category->id ) )
);

$this->sidebar .= $this->renderPartial(
    '../sidebar',
    array(
        'model' => $model,
    ),
    true
);
if (!$category->isNewRecord) {
    foreach ($category->ancestors()->findAll() as $ancestor) {
        $this->breadcrumbs[ $ancestor->title ] = Yii::app()->createUrl(
            'catalog/admin/category/index',
            array(
                'category' => $ancestor->id
            )
        );
    }
    $this->breadcrumbs[ ] = $category->title;
    $root = $category->isRoot() ? $category : $category->ancestors()->find();
} else {
    $root = new CatalogCategory();
}


?>
<div class="row">
    <h2><?= $root ? Yii::t( 'CatalogModule.admin', $root->title ) : Yii::t( 'CatalogModule.admin.index', 'Каталог' ) ?></h2>

    <?php
    $this->widget(
        'bootstrap.widgets.TbGridView',
        array(
            'id'           => 'catalog-element-grid',
            'dataProvider' => $dataProvider,
            'filter'       => $model,
            'columns'      => array(
                array(
                    'name'        => 'id',
                    'value'       => '$data->id',
                    'htmlOptions' => array( 'style' => 'width:25px;' ),
                ),
                array(
                    'name'  => 'title',
                    'value' => '$data->title',
                ),
                array(
                    'header' => 'Дата начала',
                    'name'   => 'start_date',
                    'value'  => '$data->start_date',
                ),
                array(
                    'header' => 'Дата завершения',
                    'name'   => 'finish_date',
                    'value'  => '$data->finish_date',
                ),
                array(
                    'class'   => 'bootstrap.widgets.TbButtonColumn',
                    'buttons' => array(
                        'view'   => array(
                            'url' => '$data->getUrl()',
                        ),
                        'update' => array(
                            'url' => 'Yii::app()->createUrl("catalog/admin/element/update", array("id"=>$data->id))',
                        ),
                        'delete' => array(
                            'url' => 'Yii::app()->createUrl("catalog/admin/element/delete", array("id"=>$data->id))',
                        ),
                    ),
                ),
            ),
        )
    ); ?>
</div>


