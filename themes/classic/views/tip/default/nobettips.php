<?php $inRunningTip = Yii::app()->request->getQuery( 'in_running', false ); ?>
<div class="site-width">
    <div class="active-tips">

        <div class="title">
            <?php if ($inRunningTip): ?>
                <span class="bold"><?php echo Yii::t( 'tips', 'Советы по' ); ?></span>
                <span> <?php echo Yii::t( 'tips', 'по ходу игры' ); ?></span>
            <?php else: ?>
                <span class="bold"><?php echo Yii::t( 'tips', 'Без ставок' ) ?></span>
                <span> <?php echo Yii::t( 'tips', 'Советов' ); ?></span>
            <?php endif ?>
        </div>

        <?php $this->widget(
            'zii.widgets.CListView',
            array(
                'dataProvider'    => $dataProvider,
                'itemView'        => '_nb_tip',
                'template'        => '{pager}<br />{items} {pager}',
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