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
        </div>

        <?php $this->widget(
            'zii.widgets.CListView',
            array(
                'dataProvider'    => $dataProvider,
                'itemView'        => '_tip',
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