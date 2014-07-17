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
$this->pageTitle = $element->title;
?>

<div class="guidline-slide"></div>
<div class="site-width">
<div class="guidline-us">
	<div class="guidline-left">
		<div class="title">
			<span class="bold"><?php echo $element->category->title; ?></span>
		</div>

		<div class="guidline-menu">
			<?php $this->widget('application.modules.guidline.widgets.GuidlineMenu'); ?>
		</div>

	</div>
	<div class="questions">

		<div class="question">
			<h3><?= $element->title ?></h3>
		</div>

		<p>
			<?= $element->full_description ?>
		</p>
		
	</div>
</div>
</div>