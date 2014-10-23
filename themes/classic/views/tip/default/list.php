<?php
/**
 * @var CActiveDataProvider $dataProvider
 */
?>
<div class="site-width">
    <div class="active-tips">

        <div class="title">
            <span>
                <?php if ($active == null): ?>
                    <?php echo $user != null ? Yii::t(
                        'tips',
                        'Все советы от <b>{FullName}</b> за весь период',
                        array( '{FullName}' => $user->FullName )
                    ) : Yii::t( 'tips', 'Все советы на весь период' ); ?>
                <?php else: ?>
                    <?php if ($active == 1): ?>
                        <?php echo
                        $user != null ? Yii::t( 'tips', 'Активные советы от <b>{FullName}</b>' ) : Yii::t( 'tips', 'Активные Советы' ) ?>
                    <?php else: ?>
                        <?php echo $user != null ? Yii::t(
                            'tips',
                            'Все советы от <b>{FullName}</b>',
                            array( '{FullName}' => $user->FullName )
                        ) : Yii::t( 'tips', 'Все советы' ); ?>
                    <?php endif ?>
                <?php endif; ?>
            </span>
            <span style="float: right;">
                <?php echo CHtml::form(); ?>
                <?php echo CHtml::textField(
                    'searchValue',
                    $searchValue,
                    array(
                        'style'       => 'padding: 10px 20px; margin: 8px 0 8px 8px; width:200px; font-size:16px;',
                        'placeholder' => Yii::t( 'tips', 'Поиск' ),
                    )
                ) ?>
                <?php echo CHtml::submitButton(
                    Yii::t( 'tips', 'Искать' ),
                    array(
                        'style' => 'padding: 7px 20px; font-size: 16px; cursor: pointer;'
                    )
                ) ?>
                <?php echo CHtml::endForm(); ?>
            </span>
        </div>
        <div class="last-tips">
            <?php ob_start() ?>
            <div class="title listType">
                <?php echo CHtml::link(
                    Yii::t( 'tips', 'Кратко' ),
                    Yii::app()->getRequest()->getPathInfo() . '?' . http_build_query( array_merge( $_GET, array( 'table' => 1 ) ) ),
                    array( 'class' => 'top' )
                ); ?>
                <?php echo CHtml::link(
                    Yii::t( 'tips', 'Подробно' ),
                    Yii::app()->getRequest()->getPathInfo() . '?' . http_build_query( array_merge( $_GET, array( 'table' => 0 ) ) ),
                    array( 'class' => 'top right' )
                ); ?>
            </div>
            <?php $listType = ob_get_clean() ?>
            <?php $viewTable = Yii::app()->request->getParam( 'table' ) ? true : false; ?>
            <?php $viewTableStart = "" ?>
            <?php $viewTableEnd = "" ?>
            <?php if ($viewTable) {
            $dataProvider->pagination->pageSize = 20;
            ob_start() ?>
            <table cellpadding="5" cellspacing="0">
                <tbody>
                <tr class="name">
                    <td class="event"><?php echo Yii::t( 'tips', 'Событие' ); ?></td>
                    <td class="date"><?php echo Yii::t( 'tips', 'Дата' ); ?></td>
                    <td class="tipster"><?php echo Yii::t( 'tips', 'Автор' ); ?></td>
                    <td class="selection"><?php echo Yii::t( 'tips', 'Выбор' ); ?></td>
                    <td class="odds"><?php echo Yii::t( 'tips', 'Шансы' ); ?></td>
                    <td class="stake"><?php echo Yii::t( 'tips', 'Ставка' ); ?></td>
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
                        'itemView'        => $viewTable ? '_table' : '_tip',
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