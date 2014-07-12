<?php
// Register scripts
Yii::app()->clientScript->registerScriptFile(
    CHtml::asset( $this->module->getBasePath() . '/assets/admin/' . (!empty($updateElement) ? 'element' : 'category') . '.js' ),
    CClientScript::POS_END
);

if (!$this->currentCategory && !($this->currentCategory = CatalogCategory::model()->roots()->find())) {
    $this->currentCategory = new CatalogCategory();
}

$catalogId = $this->currentCategory->isNewRecord ? 0 : $this->currentCategory->catalog->id;
?>

<div class="form wide">
    <?=
    $this->currentCategory ? '' : CHtml::link(
        'Создать каталог',
        array( '/catalog/admin/category/create' ),
        array( 'class' => 'btn btn-success', 'style' => 'margin-bottom: 20px;' )
    ); ?>
    <input type="text" style="width: 80%;" onkeyup='$("#CatalogCategoryTree").jstree("search", $(this).val());'/>
</div>

<?php
$this->widget(
    'ext.jstree.SJsTree',
    array(
        'id'      => "CatalogCategoryTree",
        'options' => array(
            'animation'   => 0,
            'core'        => array(
                //'initially_open' => "CatalogCategoryTreeNode_{$this->category_id}",
                'data' => array(
                    'url'  => "js:function (node) {
                        if (node.id == '#') {
                            return '/catalog/admin/categoryTree/roots/id/{$catalogId}';
                        }
                        return '/catalog/admin/categoryTree/nodes';
                    }",
                    'data' => "js:function (node) {
                        var current_id = {$this->category_id};
                        var id = parseInt(node.id.split('CatalogCategoryTreeNode_').join(''));
                        return { 'category_id':id, 'current_id':current_id };
                    }",
                ),
            ),
            'plugins'     => array(
                "contextmenu",
                "dnd",
                "search",
                "crrm",
            ),
            'crrm'        => array(
                'move' => array(
                    'check_move' => 'js:function (m){
                        var p = this._get_parent(m.r);
                        if (p == -1) return false;
                        return true;
                    }'
                )
            ),
            'contextmenu' => array(
                'items' => array()
            ),
            "themes"      => array( "stripes" => true ),
        ),
    )
);


Yii::app()->getClientScript()->registerCss( "CatalogCategoryTreeStyles", "#CatalogCategoryTree { width:90% }" );

?>

<div class="hint">
    <br><?php echo Yii::t( "CatalogModule.admin.main", "Используйте 'drag-and-drop' для сортировки категорий." ); ?>
</div>