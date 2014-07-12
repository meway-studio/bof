<?php

/**
 * Create/update category
 * @var CatalogCategory $model
 * @var $this BackController
 */

$this->menu = array();
$this->menu[ ] = array(
    'label' => Yii::t( 'CatalogModule.admin.category.main', 'Просмотр' ),
    'url'   => Yii::app()->createUrl( 'catalog/admin/category/index', array( 'id' => $this->category_id ) )
);

if (!$model->isNewRecord) {
    $this->menu[ ] = array(
        'label' => Yii::t( 'CatalogModule.admin.category.main', 'Создать подкатегорию' ),
        'url'   => Yii::app()->createUrl( 'catalog/admin/category/create', array( 'id' => $this->category_id ) )
    );
    $this->menu[ ] = array(
        'label' => Yii::t( 'CatalogModule.admin.category.main', 'Создать элемент' ),
        'url'   => Yii::app()->createUrl( 'catalog/admin/element/create', array( 'id' => $this->category_id ) )
    );
}

$this->sidebar .= $this->renderPartial(
    '../sidebar',
    array(
        'model' => $model,
    ),
    true
);


$currentCategory = $model->isNewRecord ? $this->currentCategory : $model;
if (!$model->isNewRecord) {
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
            'category' => $currentCategory->id
        )
    );

    $this->breadcrumbs[ ] = Yii::t(
        'CatalogModule.admin.category.main',
        ($model->isNewRecord ? 'Добавление' : 'Редактирование') . ' ' . ($model->isRoot() ? 'каталога' : 'подкатегории')
    );
}

?>

<h3>
    <?=
    Yii::t(
        'CatalogModule.admin.category.main',
        ($model->isNewRecord ? 'Добавление' : 'Редактирование') . ' ' . ($model->isRoot() ? 'каталога' : 'подкатегории')
    ) ?>
</h3>
<?php echo $this->renderPartial( 'page/form', array( 'model' => $model ) ); ?>
