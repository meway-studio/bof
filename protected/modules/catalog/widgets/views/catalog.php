<?php
/* @var $category CatalogCategory */
/* @var $elements array */
/* @var $element CatalogElement */
?>
<div class="catalog-widget">
    <div class="category-title"><?= $category->title ?></div>
    <div class="elements">
        <?php foreach ((array)$elements as $element): ?>
            <div class="element">
                <span class="element-title">
                    <?= CHtml::link( $element->title, $element->getUrl() ) ?>
                </span>
                <span class="element-public-date"><?= $element->publish_date ?></span>
                <span class="element-short-description"><?= $element->short_description ?></span>
            </div>
        <?php endforeach ?>
    </div>
    <div class="category-url">
        <?= CHtml::link( 'Все элементы', $category->getUrl() ) ?>
    </div>
</div>