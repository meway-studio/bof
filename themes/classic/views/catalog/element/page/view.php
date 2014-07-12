<?php
/**
 * @var  CatalogElement|ImageBehavior $element
 * @var  CatalogCategory|NestedSetBehavior|ImageBehavior $category
 */
foreach ($category->ancestors()->findAll() as $ancestor) {
    $this->breadcrumbs[ $ancestor->title ] = Yii::app()->createUrl( $ancestor->getUrl() );
}
$this->breadcrumbs[ $element->category->title ] = $element->category->getUrl();
$this->breadcrumbs[ ] = $element->title;
?>
<div class="site-width">
    <h2><?= $element->title ?></h2>
    <p><?= $element->short_description ?></p>
    <p><?= $element->full_description ?></p>
</div>