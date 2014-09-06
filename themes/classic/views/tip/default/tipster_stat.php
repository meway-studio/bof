<div class="site-width">

    <div class="profiles">
        <div class="title">
            <span class="bold"><?php echo $model->FullName; ?></span>
            <span> <?php echo Yii::t( 'themes', 'Профиль' ); ?></span>
        </div>
        <div class="profile">
            <div class="tipster-inf">
                <div class="top">
                    <div style="display: inline-block; position: relative;">
                        <?php echo CHtml::image( $model->photoOriginal, '', array( 'class' => 'image' ) ); ?>
                        <img class="img_pattern" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/img_pattern_white.png">
                    </div>
                    <div class="some-inf">
                        <span><?php echo Yii::t( 'themes', 'Общая прибыль' ); ?> </span>
                        <span class="big"><?php echo $model->tipster->profit; ?></span>
                        <span><?php echo Yii::t( 'themes', 'Прибыль' ); ?></span>
                        <span><?php echo Yii::t( 'themes', 'ROI (Доход)' ); ?>
                            <span> <?php echo $model->tipster->yield; ?>%</span>
                        </span>
                    </div>
                    <span class="name"><?php echo $model->FullName; ?></span>
                    <span class="status"><?php echo $model->tipster->rank; ?></span>
                    <span class="devis"><?php echo $model->tipster->comment; ?></span>
                    <div class="some-inf-bottom">
                        <a class="stats" href="<?php echo Yii::app()->createUrl( '/tip/default/stat', array( 'id' => $model->id ) ); ?>">
                            <span class="pixel active"></span>
                            <span><?php echo Yii::t( 'themes', 'Статистика' ); ?></span>
                        </a> <a class="tips" href="<?php echo Yii::app()->createUrl(
                            '/tip/default/list',
                            array( 'active' => 0, 'tipster' => $model->id )
                        ); ?>">
                            <span class="pixel active"></span>
                            <span class="how-mutch"><?php echo $model->tipster->activeCount; ?></span>
                            <span><?php echo Yii::t( 'themes', 'Советов' ); ?></span>
                        </a> <a class="subscribe" href="<?php echo Yii::app()->createUrl(
                            '/tip/default/subscription'
                        ); ?>" style="margin-right: 0px;">
                            <span class="pixel active"></span>
                            <span><?php echo Yii::t( 'themes', 'Подписки' ); ?></span>
                        </a>
                    </div>
                </div>
                <div class="bottom">
                    <span><?php echo $model->tipster->tips; ?>
                        <span><?php echo Yii::t( 'themes', 'Количество советов' ); ?></span>
                    </span>
                    <span><?php echo round( $model->tipster->winrate, 0 ); ?>%
                        <span><?php echo Yii::t( 'themes', 'Количество побед' ); ?></span>
                    </span>
                    <span style="margin-right: 0;"><?php echo $model->tipster->odds; ?>
                        <span><?php echo Yii::t( 'themes', 'Средний коэффициент' ); ?></span>
                    </span>
                </div>
            </div>
            <div class="analysis">

                <div class="a-top">
                    <?php echo Yii::t(
                        'themes',
                        '<span>Анализ производительности<span>Общая совокупная прибыль</span></span>{units}',
                        array( '{units}' => '<br /><br /><span style="font-size: 10px;margin: 0 0 5px 15px;">Units</span>' )
                    ); ?>


                    <?php /*
					<div class="period">
						<a href="#">Daily</a>
						<a class="active" href="#">Monthly</a>
					</div>
					*/
                    ?>
                    <?php
                    Yii::import( 'ext.chart.Chart' );
                    $this->widget(
                        'Chart',
                        array(
                            'id'       => 'tipsterChart',
                            'width'    => 700,
                            'height'   => 210,
                            'labels'   => $chart[ 'months' ],
                            'datasets' => array(
                                array(
                                    'strokeColor' => 'rgba(154,205,102,1)',
                                    'fillColor'   => 'rgba(154,205,102,0.5)',
                                    'data'        => $chart[ 'profit' ]
                                )
                            ),
                        )
                    );
                    ?>
                </div>

                <div class="a-bottom">
                    <table cellpadding="5" cellspacing="0">
                        <tbody>
                        <tr class="name">
                            <td><?php echo Yii::t( 'themes', 'Месяц' ); ?></td>
                            <td><?php echo Yii::t( 'tips', 'Прибыль' ); ?></td>
                            <td><?php echo Yii::t( 'tips', 'ROI (Доход)' ); ?></td>
                            <td><?php echo Yii::t( 'themes', 'Количество советов' ); ?></td>
                        </tr>
                        <?php
                        $this->widget(
                            'zii.widgets.CListView',
                            array(
                                'dataProvider' => $dataProvider,
                                'itemView'     => '_month_tr',
                                'template'     => '{items}',
                            )
                        );
                        ?>
                        </tbody>
                    </table>

                </div>

            </div>
            <?php $this->widget(
                'CLinkPager',
                array(
                    'pages'          => $dataProvider->pagination,
                    'header'         => '<span></span>',
                    'prevPageLabel'  => '&larr;',
                    'firstPageLabel' => '&larr;',
                    'nextPageLabel'  => '&rarr;',
                    'lastPageLabel'  => '&rarr;',
                    'htmlOptions'    => array( 'style' => 'float:right;margin-right: 8px;' ),
                )
            );?>

        </div>
    </div>
</div>

<?php
Yii::import( 'application.modules.tip.widgets.PreviousTips.PreviousTips' );
?>

<?php
$this->widget(
    'PreviousTips',
    array(
        'limit'   => 12,
        'active'  => PreviousTips::ACTIVE_STAT,
        'free'    => PreviousTips::FREE_NULL,
        'tipster' => $model->id,
        'view'    => 'active',
    )
);
?>

<?php
$this->widget(
    'PreviousTips',
    array(
        'limit'   => 7,
        'active'  => PreviousTips::ACTIVE_FALSE,
        'free'    => PreviousTips::FREE_NULL,
        'tipster' => $model->id,
        'view'    => 'last',
        'order'   => 't.event_date DESC',
    )
);
?>

<div class="site-width" style="text-align:center;margin-bottom:35px;">
    <?php echo CHtml::link(
        Yii::t( 'themes', 'Показать еще 7 советов' ),
        array( '/tip/default/ajaxmore', 'tipster' => $model->id ),
        array( 'class' => 'btn-blue', 'id' => 'show7moretips' )
    ); ?>
</div>


<div class="site-width">
    <div class="title">
        <span class="bold"><?php echo $model->FullName; ?></span>
        <span> <?php echo Yii::t( 'themes', 'Резюме' ); ?></span>
    </div>
    <div class="active-tips user_articles">
        <div class="active-tip">
            <div class="first-column">
                <div class="information">
                    <div class="top">
                        <div class="left">
                            <span class="tip-name"><?php echo $model->tipster->rank; ?></span>
                        </div>
                    </div>
                    <div class="center"></div>
                    <span class="bottom"><?php echo $model->tipster->profile; ?></span>
                </div>
            </div>
        </div>
    </div>
</div>