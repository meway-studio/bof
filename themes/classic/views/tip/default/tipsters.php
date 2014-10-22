<?php
/**
 * @var array $tipstersInStatistic
 * @var array $tipstersOutStatistic
 */
?>
<div class="site-width">
    <div class="stats-all-time">
        <div class="title">
            <span class="bold"><?php echo Yii::t( 'themes', 'Статистика' ); ?></span>
            <!--<span> <?php echo Yii::t( 'themes', 'За все время' ); ?></span>-->
        </div>
        <div class="profile">
            <div class="tipster-inf">
                <div class="top">
                    <div class="_top">
                        <div style="display: inline-block; position: relative;">
                            <img class="image" src="/themes/classic/css/images/menu/no_avatar.png" alt="">
                            <img class="img_pattern" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/img_pattern_white.png">
                        </div>
                        <div class="some-inf">
                            <span><?php echo Yii::t( 'themes', 'Общий' ); ?></span>
                            <span class="big"><?php echo $bofTeam[ 'profit' ]; ?></span>
                            <span><?php echo Yii::t( 'themes', 'Прибыль' ); ?></span>
                            <span><?php echo Yii::t( 'themes', 'ROI (Доход)' ); ?>
                                <span> <?php echo $bofTeam[ 'yield' ]; ?>%</span>
                            </span>
                        </div>
                    </div>
                    <span class="name"><?php echo $bofTeam[ 'name' ]; ?></span>
                    <span class="status"><?php echo $bofTeam[ 'rank' ]; ?></span>
                    <span class="devis"><?php echo $bofTeam[ 'comment' ]; ?></span>
                    <div class="some-inf-bottom">
                        <a class="stats" href="<?php echo Yii::app()->createUrl( '/tip/default/allstat' ); ?>">
                            <span class="pixel active"></span>
                            <span><?php echo Yii::t( 'tips', 'Статистика' ); ?></span>
                        </a> <a class="tips" href="<?php echo Yii::app()->createUrl( '/tip/default/list' ); ?>">
                            <span class="pixel active"></span>
                            <span class="how-mutch"><?php echo $bofTeam[ 'activeCount' ]; ?></span>
                            <span><?php echo Yii::t( 'themes', 'Советы' ); ?></span>
                        </a> <a class="subscribe" href="<?php echo Yii::app()->createUrl(
                            '/tip/default/subscription'
                        ); ?>" style="margin-right: 0px;">
                            <span class="pixel"></span>
                            <span><?php echo Yii::t( 'themes', 'Подписки' ); ?></span>
                        </a>
                    </div>
                </div>
                <div class="bottom">
                    <span><?php echo $bofTeam[ 'tips' ]; ?>
                        <span><?php echo Yii::t( 'themes', 'Количество советов' ); ?></span>
                    </span>
                    <span><?php echo round( $bofTeam[ 'winrate' ], 0 ); ?>%
                        <span><?php echo Yii::t( 'themes', 'Количество побед' ); ?></span>
                    </span>
                    <span style="margin-right: 0;"><?php echo $bofTeam[ 'odds' ]; ?>
                        <span><?php echo Yii::t( 'themes', 'Средний коэффициент' ); ?></span>
                    </span>
                </div>
            </div>

            <?php foreach ($tipstersInStatistic AS $data): ?>
                <div class="tipster-inf">
                    <div class="top">
                        <div class="_top">
                            <div style="display: inline-block; position: relative;">
                                <?php echo CHtml::image( $data->photoOriginal, '', array( 'class' => 'image' ) ); ?>
                                <img class="img_pattern" src="<?php echo Yii::app(
                                )->theme->baseUrl; ?>/css/images/img_pattern_white.png">
                            </div>
                            <div class="some-inf">
                                <span><?php echo Yii::t( 'themes', 'Общая прибыль' ); ?></span>
                                <span class="big"><?php echo $data->tipster->profit; ?></span>
                                <span><?php echo Yii::t( 'themes', 'Прибыль' ); ?></span>
                                <span><?php echo Yii::t( 'themes', 'ROI (Доход)' ); ?>
                                    <span> <?php echo $data->tipster->yield; ?>%</span>
                                </span>
                            </div>
                        </div>
                        <span class="name"><?php echo $data->FullName; ?></span>
                        <span class="status"><?php echo $data->tipster->rank; ?></span>
                        <span class="devis"><?php echo $data->tipster->comment; ?></span>
                        <div class="some-inf-bottom">
                            <a class="stats" href="<?php echo Yii::app()->createUrl( '/tip/default/stat', array( 'id' => $data->id ) ); ?>">
                                <span class="pixel active"></span>
                                <span><?php echo Yii::t( 'tips', 'Статистика' ); ?></span>
                            </a> <a class="tips" href="<?php echo Yii::app()->createUrl(
                                '/tip/default/list',
                                array( 'tipster' => $data->id )
                            ); ?>">
                                <span class="pixel active"></span>
                                <span class="how-mutch"><?php echo $data->tipster->activeCount; ?></span>
                                <span><?php echo Yii::t( 'themes', 'Советы' ); ?></span>
                            </a> <a class="subscribe" href="<?php echo Yii::app()->createUrl(
                                '/tip/default/subscription'
                            ); ?>" style="margin-right: 0px;">
                                <span class="pixel"></span>
                                <span><?php echo Yii::t( 'themes', 'Подписки' ); ?></span>
                            </a>
                        </div>
                    </div>
                    <div class="bottom">
                        <span><?php echo $data->tipster->tips; ?>
                            <span><?php echo Yii::t( 'themes', 'Количество советов' ); ?></span>
                        </span>
                        <span><?php echo $data->tipster->winrate; ?>
                            <span><?php echo Yii::t( 'themes', 'Количество побед' ); ?></span>
                        </span>
                        <span style="margin-right: 0;"><?php echo $data->tipster->odds; ?>
                            <span><?php echo Yii::t( 'themes', 'Средний коэффициент' ); ?></span>
                        </span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if (count( $tipstersOutStatistic )): ?>
        <hr style="margin-right: 35px;">
        <div class="stats-all-time">
            <div class="title">
                <span class="bold"><?php echo Yii::t( 'themes', 'Аналитики, покинувшие проект' ); ?></span>
            </div>
            <div class="profile">
                <?php foreach ($tipstersOutStatistic AS $data): ?>
                    <div class="tipster-inf">
                        <div class="top">
                            <div class="_top">
                                <div style="display: inline-block; position: relative;">
                                    <?php echo CHtml::image( $data->photoOriginal, '', array( 'class' => 'image' ) ); ?>
                                    <img class="img_pattern" src="<?php echo Yii::app(
                                    )->theme->baseUrl; ?>/css/images/img_pattern_white.png">
                                </div>
                                <div class="some-inf">
                                    <span><?php echo Yii::t( 'themes', 'Общая прибыль' ); ?></span>
                                    <span class="big"><?php echo $data->tipster->profit; ?></span>
                                    <span><?php echo Yii::t( 'themes', 'Прибыль' ); ?></span>
                                    <span><?php echo Yii::t( 'themes', 'ROI (Доход)' ); ?>
                                        <span> <?php echo $data->tipster->yield; ?>%</span>
                                    </span>
                                </div>
                            </div>
                            <span class="name"><?php echo $data->FullName; ?></span>
                            <span class="status"><?php echo $data->tipster->rank; ?></span>
                            <span class="devis"><?php echo $data->tipster->comment; ?></span>
                            <div class="some-inf-bottom">
                                <a class="stats" href="<?php echo Yii::app()->createUrl(
                                    '/tip/default/stat',
                                    array( 'id' => $data->id )
                                ); ?>">
                                    <span class="pixel active"></span>
                                    <span><?php echo Yii::t( 'tips', 'Статистика' ); ?></span>
                                </a> <a class="tips" href="<?php echo Yii::app()->createUrl(
                                    '/tip/default/list',
                                    array( 'tipster' => $data->id )
                                ); ?>">
                                    <span class="pixel active"></span>
                                    <span class="how-mutch"><?php echo $data->tipster->activeCount; ?></span>
                                    <span><?php echo Yii::t( 'themes', 'Советы' ); ?></span>
                                </a> <a class="subscribe" href="<?php echo Yii::app()->createUrl(
                                    '/tip/default/subscription'
                                ); ?>" style="margin-right: 0px;">
                                    <span class="pixel"></span>
                                    <span><?php echo Yii::t( 'themes', 'Подписки' ); ?></span>
                                </a>
                            </div>
                        </div>
                        <div class="bottom">
                            <span><?php echo $data->tipster->tips; ?>
                                <span><?php echo Yii::t( 'themes', 'Количество советов' ); ?></span>
                            </span>
                            <span><?php echo $data->tipster->winrate; ?>
                                <span><?php echo Yii::t( 'themes', 'Количество побед' ); ?></span>
                            </span>
                            <span style="margin-right: 0;"><?php echo $data->tipster->odds; ?>
                                <span><?php echo Yii::t( 'themes', 'Средний коэффициент' ); ?></span>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif ?>
</div>