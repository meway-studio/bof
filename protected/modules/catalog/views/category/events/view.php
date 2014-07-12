<?php
/**
 * @var $category CatalogCategory
 * @var $elements array
 * @var $element CatalogElement
 */
foreach ($category->ancestors()->findAll() as $ancestor) {
    $this->breadcrumbs[ $ancestor->title ] = Yii::app()->createUrl( $ancestor->getUrl() );
}
$this->breadcrumbs[ ] = $category->title;
?>
<h2><?= $category->title ?></h2>

<?php foreach ($elements as $element): ?>
    <div>
        <?php echo CHtml::image( $element->getImageUrl( '150x150' ) ); ?>
    </div>
    <p><?= $element->short_description ?></p>
    <p><?= $element->full_description ?></p>
    <hr/>
<?php endforeach ?>