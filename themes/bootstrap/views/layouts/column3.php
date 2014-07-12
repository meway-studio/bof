<?php $this->beginContent('//layouts/main'); ?>
<?php
$this->widget(
    'bootstrap.widgets.TbMenu',
    array(
        'type'  => 'tabs',
        'items' => $this->menu,
        //'htmlOptions'=>array('class'=>'operations'),
    )
);
?>

<div class="row">
    <div class="span9">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
    <div class="span3">
        <?= $this->sidebar ?>
    </div>
</div>
<?php $this->endContent(); ?>