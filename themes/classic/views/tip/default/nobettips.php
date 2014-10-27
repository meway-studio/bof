<?php
/**
 * @var CActiveDataProvider $dataProvider
 */
$inRunningTip = Yii::app()->request->getQuery( 'in_running', false );
?>
<div class="site-width">
    <div class="active-tips">

        <div class="title">
            <?php if ($inRunningTip): ?>
                <span class="bold"><?php echo Yii::t( 'tips', 'Советы по' ); ?></span>
                <span> <?php echo Yii::t( 'tips', 'по ходу игры' ); ?></span>
            <?php else: ?>
                <span><?php echo Yii::t( 'tips', 'Советы без ставок и по ходу игры' ) ?></span>
            <?php endif ?>
            <span style="float: right;">
                <?php echo CHtml::form( Yii::app()->createUrl( 'tip/default/NoBetTips' ), 'GET' ); ?>
                <?php echo CHtml::textField(
                    'searchValue',
                    $searchValue,
                    array(
                        'style'       => 'padding: 12px 20px; margin: 8px 0 8px 8px; width:200px; font-size:16px; float:left;',
                        'placeholder' => Yii::t( 'tips', 'Поиск' ),
                    )
                ) ?>
                <button type="submit" class="search button green"><?php echo Yii::t( 'tips', 'Искать' ) ?></button>
                <?php echo CHtml::endForm(); ?>
            </span>
        </div>

        <div class="last-tips">
            <?php ob_start() ?>
            <div class="title listType">
                <?php echo CHtml::link(
                    '',
                    Yii::app()->getRequest()->getPathInfo() . '?' . http_build_query( array_merge( $_GET, array( 'table' => 0 ) ) ),
                    array( 'class' => 'list_view_ list_view_list ' . (Yii::app()->request->getParam( 'table', false ) ? '' : 'active') )
                ); ?>
                <?php echo CHtml::link(
                    '',
                    Yii::app()->getRequest()->getPathInfo() . '?' . http_build_query( array_merge( $_GET, array( 'table' => 1 ) ) ),
                    array( 'class' => 'list_view_ list_view_grid ' . (Yii::app()->request->getParam( 'table', false ) ? 'active' : '') )
                ); ?>
            </div>
            <?php $listType = ob_get_clean() ?>
            <?php $viewTable = Yii::app()->request->getParam( 'table' ) ? true : false; ?>
            <?php $viewTableStart = "" ?>
            <?php $viewTableEnd = "" ?>
            <?php
            if ($viewTable) {
            $dataProvider->pagination->pageSize = 20;
            ob_start()
            ?>
            <table cellpadding="5" cellspacing="0">
                <tbody>
                <tr class="name">
                    <td class="event"><?php echo Yii::t( 'tips', 'Событие' ); ?></td>
                    <td class="date"><?php echo Yii::t( 'tips', 'Дата' ); ?></td>
                    <td class="tipster"><?php echo Yii::t( 'tips', 'Автор' ); ?></td>
                    <td class="stake"><?php echo Yii::t( 'tips', 'Подробнее' ); ?></td>
                </tr>
                <?php
                $viewTableStart = ob_get_clean();
                $viewTableEnd = "</tbody></table>";
                } ?>
                <?php $this->widget(
                    'zii.widgets.CListView',
                    array(
                        'dataProvider'    => $dataProvider,
                        'itemView'        => $viewTable ? '_table_nb' : '_nb_tip',
                        'template'        =>
                            '<div style="overflow:hidden;">'
                            . $listType
                            . '{pager}</div>'
                            . $viewTableStart
                            . '{items}'
                            . $viewTableEnd
                            . '{pager}',
                        'afterAjaxUpdate' => 'function(id,data){scroll(0,150);}',
                        'pager'           => array(
                            'header'         => '<span></span>',
                            'prevPageLabel'  => '&larr;',
                            'firstPageLabel' => '&larr;',
                            'nextPageLabel'  => '&rarr;',
                            'lastPageLabel'  => '&rarr;',
                        ),
                    )
                ); ?>
        </div>
    </div>
</div>