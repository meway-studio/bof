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
                <ul>
                    <?php foreach ($category->elements( array( 'scopes' => array( 'published' ) ) ) as $cat): ?>
                        <li class="<?php echo Yii::app()->request->requestUri == $cat->url ? 'active' : '' ?>">
                            <a href="<?php echo $cat->getUrl() ?>"><?php echo $cat->title ?></a>
                        </li>
                    <?php endforeach ?>
                </ul>
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