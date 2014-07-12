<?php
/**
 * @var $this DefaultController
 * @var $category CatalogCategory
 */
$this->menu = array();
$this->menu[ ] = array(
    'label' => Yii::t( 'CatalogModule.admin.category.main', 'Создать элемент' ),
    'url'   => Yii::app()->createUrl( 'catalog/admin/element/create', array( 'id' => $category->id ) )
);
$this->menu[ ] = array(
    'label' => Yii::t( 'CatalogModule.admin.category.main', 'Создать подкатегорию' ),
    'url'   => Yii::app()->createUrl( 'catalog/admin/category/create', array( 'id' => $category->id ) )
);
if ($category && !$category->isRoot()) {
    $this->menu[ ] = array(
        'label' => Yii::t( 'CatalogModule.admin.category.main', 'Редактировать категорию' ),
        'url'   => Yii::app()->createUrl( 'catalog/admin/category/update', array( 'id' => $category->id ) )
    );
    $this->menu[ ] = array(
        'label' => Yii::t( 'CatalogModule.admin.category.main', 'Удалить категорию' ),
        'url'   => Yii::app()->createUrl( 'catalog/admin/category/delete', array( 'id' => $category->id ) ),
        'htmlOptions' => array('color' => 'red'),
    );
} else {
    $this->menu[ ] = array(
        'label' => Yii::t( 'CatalogModule.admin.category.main', 'Редактировать каталог' ),
        'url'   => Yii::app()->createUrl( 'catalog/admin/category/update', array( 'id' => $category->id ) )
    );
    $this->menu[ ] = array(
        'label' => Yii::t( 'CatalogModule.admin.category.main', 'Удалить катaлог' ),
        'url'   => Yii::app()->createUrl( 'catalog/admin/category/delete', array( 'id' => $category->id ) ),
        'htmlOptions' => array('color' => 'red'),
    );
}


$this->sidebar .= $this->renderPartial(
    '../sidebar',
    array(
        'model' => $model,
    ),
    true
);
if ($category && !$category->isNewRecord) {
    foreach ($category->ancestors()->findAll() as $ancestor) {
        $this->breadcrumbs[ $ancestor->title ] = Yii::app()->createUrl(
            'catalog/admin/category/index',
            array(
                'id' => $ancestor->id
            )
        );
    }
    $this->breadcrumbs[ ] = $category->title;
    $root = $category->isRoot() ? $category : $category->ancestors()->find();
}
else {
    $root = new CatalogCategory();
}


?>
<div class="row">
	<h2><?= $root ? Yii::t( 'CatalogModule.admin.category.main', $root->title ) : Yii::t( 'CatalogModule.admin.category.main', 'Каталог' ) ?></h2>

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
                'name',
                array(
                    'name'  => 'author_search',
                    'value' => '$data->author->firstname." ".$data->author->lastname',
                ),
                'create_date',
                'publish_date',
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


