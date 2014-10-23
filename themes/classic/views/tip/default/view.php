<?php Yii::import( 'application.modules.tip.widgets.PreviousTips.PreviousTips' ); ?>

<div class="site-width">

    <div class="stats-tip">
        <div class="page-title">
            <span class="title">
                <span><?php echo $model->club_1; ?></span>
                vs
                <span><?php echo $model->club_2; ?></span>
            </span>
        </div>
        <div class="match">
            <?php /*<img src="<?php echo Yii::app()->theme->baseUrl;?>/css/images/tips/flag1.png">*/ ?>
            <span><?php echo CHtml::tag( 'i', array( 'class' => 'flag ' . $model->flag_1 ), '' ); ?> <?php echo $model->league; ?></span>

            <span class="data"><?php echo $model->format_event_date; ?></span>
        </div>

        <div class="briks">
            <div class="brik">
                <span class="brik-name"><?php echo Yii::t( 'themes', 'Автор' ); ?></span>
                <div class="brik-inf">
                    <div style="display: inline-block; position: relative;">
                        <?php echo CHtml::image( $model->tipster->photoThumb, '', array( 'width' => 79 ) ); ?>
                        <img width="90" class="img_pattern" src="/themes/classic/css/images/tips/img_pattern.png">
                    </div>
                    <div class="right">
                        <div class="name">
                            <span><?php echo $model->tipster->FullName; ?></span>
                            <?php echo CHtml::link(
                                CHtml::image( Yii::app()->theme->baseUrl . "/css/images/menu/fsm.png" ),
                                array( '/tip/default/stat', 'id' => $model->tipster_id )
                            ); ?>
                        </div>
                        <span class="yeld"><?php echo Yii::t( 'themes', 'Получат' ); ?>
                            <span><?php echo $model->tipster->tipster->yield; ?>%</span>
                        </span>
                        <span class="small-title"><?php echo Yii::t( 'themes', 'Последние 7 советов' ); ?></span>
                        <span class="stats won"><?php echo Yii::t( 'tips', '{n} won|{n} won|{n} won|{n} won', $last[ 'won' ] ); ?></span>
                        <span class="stats lost"><?php echo Yii::t( 'tips', '{lost} lost', array( '{lost}' => $last[ 'lost' ] ) ); ?></span>
                        <span class="stats void"><?php echo Yii::t(
                                'tips',
                                '{n} void|{n} void|{n} void|{n} void',
                                $last[ 'void' ]
                            ); ?></span>
                    </div>
                </div>
                <div class="bottom">
                    <span><?php echo Yii::t(
                            'tips',
                            '{n} <span>Ставка</span>|{n} <span>Ставки</span>|{n} <span>Ставок</span>|{n} <span>Ставок</span>',
                            $model->tipster->tipster->tips
                        ); ?></span>
                    <span><?php echo $model->tipster->tipster->winrate; ?>%
                        <span><?php echo Yii::t( 'themes', 'Кол. побед' ); ?></span>
                    </span>
                    <span><?php echo $model->tipster->tipster->odds; ?>
                        <span><?php echo Yii::t( 'themes', 'Ср. шансы' ); ?></span>
                    </span>
                </div>
            </div>

            <div class="brik">
                <span class="brik-name"><?php echo Yii::t( 'themes', 'Подробнее о совете' ); ?></span>
                <div class="brik-inf no-bord">
                    <div class="row">
                        <span class="small-title"><?php echo Yii::t( 'themes', 'Ставка на:' ); ?></span>
                        <span class="small-info"><?php echo $model->betOnClub; ?></span>
                        <span class="orange-bg"><?php echo $model->SelectionNum; ?></span>
                    </div>
                    <div class="row">
                        <span class="small-title" style="margin-top: 20px;"><?php echo Yii::t( 'themes', 'Лучшая цена:' ); ?></span>
                        <?php echo $model->bestOdds; ?>
                    </div>
                    <div class="row">
                        <span class="small-title" style="margin-top: 20px;"><?php echo Yii::t( 'themes', 'Ставка:' ); ?></span>
                        <span class="small-info"><?php echo $model->stake; ?></span>
                        <span>(<?php echo Yii::t( 'themes', 'Единиц' ); ?>)</span>
                    </div>
                </div>
            </div>

            <div class="brik">
                <span class="brik-name marg"><?php echo Yii::t( 'themes', 'Результат' ); ?></span>
                <div class="brik-inf no-marg">
                    <div class="tip-result <?php if ($model->tip_result == Tips::TIP_RESULT_WON) {
                        echo 'won';
                    } elseif ($model->tip_result == Tips::TIP_RESULT_LOST) {
                        echo 'lost';
                    } elseif ($model->tip_result == Tips::TIP_RESULT_VOID) {
                        echo 'void';
                    } ?>">
                        <span class="small-title"><?php echo Yii::t( 'themes', 'Результат:' ); ?></span>
                        <span class="small-info gr-bg"><?php echo $model->TipResultStr; ?></span>
                        <?php
                        if ($model->tip_result == Tips::TIP_RESULT_WON) {
                            echo CHtml::tag( 'span', array( 'class' => 'stats won-ic' ), Yii::t( 'tips', 'выигранный' ) );
                        } elseif ($model->tip_result == Tips::TIP_RESULT_LOST) {
                            echo CHtml::tag( 'span', array( 'class' => 'stats lost-ic' ), Yii::t( 'tips', 'проигранный' ) );
                        } elseif ($model->tip_result == Tips::TIP_RESULT_VOID) {
                            echo CHtml::tag( 'span', array( 'class' => 'stats void-ic' ), Yii::t( 'tips', 'недействительный' ) );
                        }
                        ?>
                    </div>
                    <div class="match-result no-marg">
                        <span class="small-title"><?php echo Yii::t( 'themes', 'Результат матча:' ); ?></span>
                        <span class="small-info"><?php echo $model->MatchResult; ?></span>
                    </div>
                    <div class="profit no-marg">
                        <span class="small-title"><?php echo Yii::t( 'tips', 'Прибыль' ); ?></span>
                        <span class="small-info or-bg"><?php
                            echo $model->tip_result == Tips::TIP_RESULT_VOID ? 'unknow' : Yii::t(
                                'tips',
                                '{profit} единица',
                                array( '{profit}' => $model->tempProfit )
                            );
                            ?></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="game-preview">
            <span class="small-title"><?php echo Yii::t( 'themes', 'Предварительный просмотр игры' ); ?></span>
            <div class="social">

                <?php echo CHtml::link(
                    CHtml::image( Yii::app()->theme->baseUrl . '/css/images/tips/fb.png' ),
                    Yii::app()->createAbsoluteUrl( '/tip/default/view', array( 'id' => $model->id ) ),
                    array(
                        'class'               => 'addthis_button_facebook',
                        'addthis:url'         => Yii::app()->createAbsoluteUrl( '/tip/default/view', array( 'id' => $model->id ) ),
                        'addthis:title'       => CHtml::encode( $model->club_1 . ' vs ' . $model->club_2 ),
                        'addthis:description' => CHtml::encode( $model->description ),
                    )
                );?>

                <?php echo CHtml::link(
                    CHtml::image( Yii::app()->theme->baseUrl . '/css/images/tips/tw.png' ),
                    Yii::app()->createAbsoluteUrl( '/tip/default/view', array( 'id' => $model->id ) ),
                    array(
                        'class'               => 'addthis_button_twitter',
                        'addthis:url'         => Yii::app()->createAbsoluteUrl( '/tip/default/view', array( 'id' => $model->id ) ),
                        'addthis:title'       => CHtml::encode( $model->club_1 . ' vs ' . $model->club_2 ),
                        'addthis:description' => CHtml::encode( $model->description ),
                    )
                );?>
                <?php /*
			<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/css/images/footer/fb.png"></a>
			<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/css/images/footer/tw.png"></a>
			*/
                ?>
            </div>
            <span class="text"><?php echo $model->content; ?></span>
            <span class="data"><?php echo Yii::t( 'themes', 'Совет опубликован' ); ?> <?php echo $model->format_create_date ?></span>
        </div>

        <?php if ($model->comments && Yii::app()->config->get( 'SHOW_COMMENTS' )): ?>
            <div class="game-preview">
                <span class="small-title" style="margin-bottom: 20px;"><?php echo Yii::t( 'themes', 'Комментарии' ); ?></span>
                <?php $this->widget( 'application.widgets.disqus.Disqus', array( 'shortname' => 'wmsamolet' ) ) ?>
            </div>
        <?php endif ?>

    </div>

</div>

<?php
$this->widget(
    'PreviousTips',
    array(
        'limit'   => 3,
        'active'  => PreviousTips::ACTIVE_TRUE,
        'free'    => PreviousTips::FREE_NULL,
        'tipster' => $model->tipster_id,
        'view'    => 'active',
        'order'   => 't.event_date DESC',
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
        'tipster' => $model->tipster_id,
        'view'    => 'last',
        'order'   => 't.event_date DESC',
    )
);
?>

<div class="site-width" style="text-align:center;margin-bottom:35px;">
    <?php echo CHtml::link(
        Yii::t( 'themes', 'Показать еще 7 советов' ),
        array( '/tip/default/ajaxmore', 'tipster' => $model->tipster_id ),
        array( 'class' => 'btn-blue', 'id' => 'show7moretips' )
    ); ?>
</div>