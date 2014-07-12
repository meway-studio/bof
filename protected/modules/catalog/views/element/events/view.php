<?php
/**
 * @var $model CatalogCategory
 */
foreach ($model->category->ancestors()->findAll() as $ancestor) {
    $this->breadcrumbs[ $ancestor->title ] = Yii::app()->createUrl( $ancestor->getUrl() );
}
$this->breadcrumbs[ $model->category->title ] = $model->category->getUrl();
$this->breadcrumbs[ ] = $model->title;
?>
<h2><?= $model->title ?></h2>
<div>
    <?php echo CHtml::image( $model->getImageUrl( '150x150' ) ); ?>
</div>
<p><?= $model->short_description ?></p>
<p><?= $model->full_description ?></p>

<?php
    $this->widget('comments.widgets.ECommentsListWidget', array(
        'model' => $model,
    ));
?>