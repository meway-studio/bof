<?php
/**
 * @var $category CatalogCategory
 * @var $element CatalogElement
 * @var $elementDataProvider CActiveDataProvider
 * @var $categoryDataProvider CActiveDataProvider
 */

$this->breadcrumbs[ ] = 'Поиск';
?>
    <h2>Поиск</h2>

    <h3>Элементы:</h3>
<?php foreach (($elements = $elementDataProvider->getData()) as $e): ?>
    <div>
        <?php echo CHtml::image( $e->getImageUrl( '150x150' ) ); ?>
    </div>
    <h4><?= $e->title ?></h4>
    <p><?= $e->short_description ?></p>
    <p><?= $e->full_description ?></p>
    <hr/>
<?php endforeach ?>

    <h3>Категории:</h3>
<?php foreach (($categories = $categoryDataProvider->getData()) as $c): ?>
    <div>
        <?php echo CHtml::image( $c->getImageUrl( '150x150' ) ); ?>
    </div>
    <h4><?= $c->title ?></h4>
    <p><?= $c->short_description ?></p>
    <p><?= $c->full_description ?></p>

    <?php foreach ($c->elements as $e): ?>
        <div>
            <?php echo CHtml::image( $e->getImageUrl( '150x150' ) ); ?>
        </div>
        <h4><?= $e->title ?></h4>
        <p><?= $e->short_description ?></p>
        <p><?= $e->full_description ?></p>
    <?php endforeach ?>
    <hr/>
<?php endforeach ?>