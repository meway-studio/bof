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
    <h2><?= $element->title ?></h2>
    <div>
        <?php echo CHtml::image( $element->getImageUrl( '150x150' ) ); ?>
    </div>
    <p><?= $element->short_description ?></p>
    <p><?= $element->full_description ?></p>

<?php
$this->widget(
    'comments.widgets.ECommentsListWidget',
    array(
        'model'         => $element,
        'showPopupForm' => false,
    )
);
$this->widget(
    'comments.widgets.ECommentsFormWidget',
    array(
        'model' => $element,
    )
);
?>