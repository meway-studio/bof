<?php

/**
 * @var $this BackController
 */
$this->sidebar .= $this->renderPartial(
    '../sidebar',
    array(
        'model' => $model,
        'updateElement' => true,
    ),
    true
);

/**
 * Create/update category
 * @var CatalogElement $model
 */

$this->menu = array();
$this->menu[ ] = array(
    'label' => Yii::t( 'CatalogModule.admin.menu', 'Просмотр' ),
    'url'   => Yii::app()->createUrl( 'catalog/admin/category/index', array( 'id' => $model->category_id ) )
);
if (!$model->isNewRecord) {
    $this->menu[ ] = array(
        'label' => Yii::t( 'CatalogModule.admin.menu', 'Создать элемент' ),
        'url'   => Yii::app()->createUrl( 'catalog/admin/element/create', array( 'id' => $model->category_id ) )
    );
}

$currentCategory = $model->category;
foreach ($currentCategory->ancestors()->findAll() as $ancestor) {
    $this->breadcrumbs[ $ancestor->title ] = Yii::app()->createUrl(
        'catalog/admin/category/index',
        array(
            'id' => $ancestor->id
        )
    );
}
$this->breadcrumbs[ $currentCategory->title ] = Yii::app()->createUrl(
    'catalog/admin/category/index',
    array(
        'id' => $currentCategory->id
    )
);
$this->breadcrumbs[ ] = Yii::t(
    'CatalogModule.admin.element',
    'Добавление элемента'
);

?>

<h3><?= Yii::t( 'CatalogModule.admin.element', 'Добавление элемента' ) ?></h3>
<?php echo $this->renderPartial( 'events/form', array( 'model' => $model ) ); ?>