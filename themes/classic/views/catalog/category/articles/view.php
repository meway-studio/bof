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
<div class="site-width">
    <div class="guidline-us">
        <div class="guidline-left">
            <div class="title">
                <?php echo Yii::t( 'themes', '<span class="bold">Гайдлайн</span> <span>БОФ</span> ' ); ?>
            </div>

            <div class="guidline-menu">
                <?php $this->widget( 'application.modules.guidline.widgets.GuidlineMenu' ); ?>
            </div>

        </div>
        <div class="articles questions">
            <?php foreach ($category->children()->findAll() as $subCategory): ?>
                <h2 style="color: #488BE2; font-size: 18px; margin: 40px 0 -30px 30px;"><?php echo $subCategory->title ?></h2>
                <?php foreach ($subCategory->getAllElements()->findAll() as $element): ?>
                    <div class="article" style="overflow: hidden; background-color: #fff; position: relative;">
                        <div style="display: inline-block; position: relative; float: left; margin:-20px 10px -20px -20px; height: 158px; width: 158px;">
                            <?php echo CHtml::image(
                                $element->getImageUrl( '158x158', 'resize' ),
                                null,
                                array(
                                    'style' => 'height: 158px; width: 158px;'
                                )
                            ); ?>
                            <img class="img_pattern" style="position: absolute; top: 0; left: 0;" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/img_pattern_white.png">
                        </div>
                        <div class="title"><?=
                            Yii::app()->dateFormatter->formatDateTime(
                                CDateTimeParser::parse( $element->publish_date, 'yyyy-MM-dd' ),
                                'long',
                                null
                            ); ?></div>
                        <div class="text" style="margin: 0;"><?= $element->short_description ?></div>
                        <div class="text spoiler-text"><?= $element->full_description ?></div>
                        <div class="spoiler"><b class="show">+</b><b class="hide">-</b></div>
                    </div>
                <?php endforeach ?>
            <?php endforeach ?>
        </div>
    </div>
</div>