<?php
if (!Yii::app()->session[ 'location' ] && ($location = Yii::app()->geoip->lookupLocation())) {
    $countryCode = strtolower( $location->countryCode );
    if ($countryCode == 'ru') {
        Yii::app()->session[ 'location' ] = $countryCode;
        Yii::app()->request->redirect( '/ru' );
    }
}
?>
<?php /* @var $this Controller */ ?>
<?php
Yii::app()->clientScript->registerCoreScript( 'jquery' );
Yii::app()->clientScript->registerScriptFile( Yii::app()->theme->baseUrl . '/js/main.js' );
Yii::app()->clientScript->registerScriptFile( Yii::app()->theme->baseUrl . '/js/jquery.toastmessage.js' );
Yii::app()->clientScript->registerCssFile( Yii::app()->theme->baseUrl . '/css/jquery.toastmessage.css' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>
    <meta name='yandex-verification' content='62cc5c68a8de19d0'/>
    <meta name="google-site-verification" content="F0KJ4gJi1sKiFt8GBP5ZKmArjhGR_AhFqbaQVPfheUw" />

    <script type="text/javascript">var addthis_config = {"data_track_addressbar": false};</script>
    <script type="text/javascript" src="/js/addthis_widget.js#pubid=ra-520203bd03c67254"></script>

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" media="screen, projection"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/flags.css" media="screen, projection"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" media="screen, projection"/>
    <link id="page_favicon" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/favicon.ico" rel="icon" type="image/x-icon"/>
    <title><?php echo CHtml::encode( $this->pageTitle ); ?></title>
</head>

<body>

<div id="header">
    <div class="site-width">
        <a class="logo" href="/<?php echo Yii::app()->language ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/logo.png"/></a>
        <!--div class="header_fifa"><img src="/images/header_fifa.png"/></div-->
        <div class="info">
            <div class="line"></div>
            <div class="block" style="margin-top: 15px;">
                <div class="left" style="position:relative; bottom:-5px;">
                    <span class="top"><?php echo Yii::t( 'themes', 'Язык' ); ?></span>
                    <span class="bottom">
                        <?php echo CHtml::link(
                            CHtml::image( '/images/ru_flag.png' ),
                            '/ru'
                        ); ?>
                        <?php echo CHtml::link(
                            CHtml::image( '/images/en_flag.png' ),
                            '/en'
                        ); ?>
                    </span>
                </div>
            </div>

            <div class="line"></div>

            <div class="block">
                <?php
                $this->widget( 'application.modules.user.widgets.weatherBox.weatherBox' );
                ?>
            </div>

            <div class="line"></div>
            <div class="block">
                <div class="right">
                    <span class="top"><?php echo Yii::t( 'themes', 'Валюта' ); ?></span>
                    <span class="bottom"><?php echo Yii::t( 'themes', '&euro; Eвро' ); ?></span>
                </div>
            </div>
            <div class="line"></div>
            <div class="block">
                <div class="right">
                    <span class="top"><?php echo Yii::t( 'themes', 'Время' ); ?></span>
                    <span class="bottom" id="clock">04:08</span>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="menu" style="overflow: visible;">
    <div class="site-width" style="overflow: visible;height: 60px;">
        <?php $this->widget(
            'zii.widgets.CMenu',
            array(
                'items' => array(
                    array(
                        'label'       => Yii::t( 'themes', 'Главная' ),
                        'url'         => array( '/tip/default/index' ),
                        'linkOptions' => array( 'class' => 'home' )
                    ),
                    array(
                        'label'       => Yii::t( 'themes', 'Статистика авторов' ),
                        'url'         => array( '/tip/default/tipsters' ),
                        'linkOptions' => array( 'class' => 'tipsters' )
                    ),
                    //array('label'=>'Stats', 'url'=> array('#'), 'linkOptions'=>array('class'=>'stats')),
                    array(
                        'label'       => Yii::t( 'themes', 'О БОФ' ),
                        'url'         => array( '/site/page', 'view' => 'about' ),
                        'linkOptions' => array( 'class' => 'about_bof' )
                    ),
                    array(
                        'label'       => Yii::t( 'themes', 'Подписаться' ),
                        'url'         => array( '/tip/default/subscription' ),
                        'linkOptions' => array( 'class' => 'subscription' )
                    ),
                    array(
                        'label'       => Yii::t( 'themes', 'Контакты' ),
                        'url'         => array( '/guidline/default/contacts' ),
                        'linkOptions' => array( 'class' => 'contacts' )
                    ),
                    array(
                        'label'       => Yii::t( 'themes', 'Гайдлайн' ),
                        'url'         => array( '/site/page', 'view' => 'manual' ),
                        'linkOptions' => array( 'class' => 'guidline' )
                    ),
                    array(
                        'label'       => Yii::t( 'themes', 'Видео' ),
                        'url'         => array( '/guidline/default/video' ),
                        'linkOptions' => array( 'class' => 'video' )
                    ),
                    //array('label'=>'Logout', 'url'=> array('/user/default/logout'), 'visible'=>!Yii::app()->user->isGuest),
                ),
            )
        ); ?>
        <!-- auth widget -->
        <?php $this->widget( 'application.modules.user.widgets.auth.auth' ); ?>
    </div>
</div>
<!-- mainmenu -->

<?php /*if(isset($this->breadcrumbs)):?>
	<?php $this->widget('zii.widgets.CBreadcrumbs', array(
		'links'=>$this->breadcrumbs,
	)); ?><!-- breadcrumbs -->
<?php endif*/
?>

<?php echo $content; ?>

<div id="footer">
    <div class="site-width">
        <div class="f-top">
            <div class="beton">
                <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/logo.png"></a>
                <span><?php echo Yii::t(
                        'themes',
                        'Проект BetonFootball разработан командой, которая любит футбол. В то же время команда BetonFootball предупреждает вас, что азартные игры могут вызывать зависимость, поэтому мы настаиваем на том, чтобы Вы не делали ставки вслепую, полагаясь только на удачу! Если Вы делаете ставки, пожалуйста, собирайте как можно больше информации об играх, на сколько это возможно. Наш сервис является исключительно информационно­аналитическим ресурсом, главная задача которого заключается в предоставлении доступа к максимально полной информации о предстоящих играх.'
                    ); ?></span>
                <div class="social">
                    <a class="tw" href="https://twitter.com/BetonFootball7" target="_blank">Twitter</a>
                    <a class="fb" href="https://www.facebook.com/BetOnFootball" target="_blank">Facebook</a>
                    <?php echo CHtml::link(
                        'Say Hello' . CHtml::image( Yii::app()->theme->baseUrl . '/css/images/footer/arrow_right.png' ),
                        array( '/guidline/default/contacts' ),
                        array( 'class' => 'sh' )
                    ); ?>
                </div>
            </div>
            <div class="f-menu">
                <ul>
                    <li>
                        <span class="shoes"><?php echo Yii::t( 'themes', 'О БОФ' ); ?></span>
                    </li>
                    <li><?php echo CHtml::link( Yii::t( 'themes', 'О нас' ), array( '/site/page', 'view' => 'about' ) ); ?></li>
                    <li><?php echo CHtml::link( Yii::t( 'themes', 'Гайдлайн' ), array( '/site/page', 'view' => 'manual' ) ); ?></li>
                    <li><?php echo CHtml::link( Yii::t( 'themes', 'Статистика авторов' ), array( '/tip/default/tipsters' ) ); ?></li>
                    <li><?php echo CHtml::link( Yii::t( 'themes', 'Контакты' ), array( '/guidline/default/contacts' ) ); ?></li>
                    <li><?php echo CHtml::link( Yii::t( 'themes', 'Сайтмап' ), array( '/site/UserSiteMap' ) ); ?></li>
                </ul>
            </div>
            <div class="f-menu">
                <ul>
                    <li>
                        <span class="sheld"><?php echo Yii::t( 'themes', 'ТОЛЬКО С BOF' ); ?></span>
                    </li>
                    <li><?php echo CHtml::link( Yii::t( 'themes', 'План подписки' ), array( '/tip/default/subscription' ) ); ?></li>
                </ul>
            </div>
            <div class="f-menu">
                <ul>
                    <li>
                        <span class="cup"><?php echo Yii::t( 'themes', 'BETTINGADVICE ПОДТВЕРДИЛ' ); ?></span>
                    </li>
                    <li><a class="betting" href="http://forum.bettingadvice.com/showthread.php?t=77116" target="_blank"></a></li>
                </ul>
                <div class="footer_veryfied" style="text-align: left;margin-top: 10px;">
                    <!-- START :: VerifiedTipsters.com SEAL -->
                    <a href="http://www.verifiedtipsters.com/tipsters_present.php?tipster_username=BetonFootball" target="_blank"><img src="http://www.verifiedtipsters.com/_images/seal.gif" border="0"></a>
                    <!-- END   :: VerifiedTipsters.com SEAL -->
                </div>
                <div class="footer_veryfied" style="text-align: left;margin-top: 10px;">
                    <a href="http://www.mybigpartner.com/?psl=9" target="_blank"><img width="142" height="60" alt="Sports betting tipsters verification service" src="http://www.mybigpartner.com/userfiles/image/verify%20seal.png"/></a>
                </div>
            </div>
        </div>

        <table class="f-bottom">
            <tr>
                <td class="f-left"><?php echo Yii::app()->config->get(
                        'COPYRIGHT'
                    ); /*&copy; 2013 BetOnFootball. All rights reserved.*/ ?></td>
                <td class="f-mid">
                    <?php echo CHtml::link(
                        Yii::t( 'themes', 'ТЕРМИНЫ &amp; УСЛОВИЯ РАБОТЫ' ),
                        array( '/site/page', 'view' => 'terms' )
                    ); ?>
                    <?php echo CHtml::link(
                        Yii::t( 'themes', 'ПОЛИТИКА КОНФИДЕНЦИАЛЬНОСТИ' ),
                        array( '/site/page', 'view' => 'privacy' )
                    ); ?>
                    <?php echo CHtml::link( Yii::t( 'themes', 'ПОЛИТИКА ВОЗВРАТА' ), array( '/site/page', 'view' => 'refund' ) ); ?>
                    <? /*<a href="/">LIVE SUPPORT</a><span>+7 (495) 703-1-678</span><span>SKYPE - betonfootball</span> */ ?>
                </td>
                <td class="f-right">
                    <a rel="nofollow" href="http://wakeupstudio.ru/contacts" target="_blank">Design by
                        <span>Wake Up!</span>
                    </a>&nbsp;&nbsp;&nbsp; <a rel="nofollow" href="http://meway.ru" target="_blank">Developed by
                        <img style="vertical-align: middle" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/meway.png"></a>
                </td>
            </tr>
        </table>
    </div>
</div>

<script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o), m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-36629493-1', 'betonfootball.eu');
    ga('send', 'pageview');

</script>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function(d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter23890561 = new Ya.Metrika({id: 23890561,
                    webvisor: true,
                    clickmap: true,
                    trackLinks: true,
                    accurateTrackBounce: true});
            }
            catch (e) {
            }
        });
        var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function() {
                n.parentNode.insertBefore(s, n);
            };
        s.type = "text/javascript";
        s.async = true;
        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";
        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        }
        else {
            f();
        }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript>
    <div><img src="//mc.yandex.ru/watch/23890561" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>
<!-- /Yandex.Metrika counter -->

</body>
</html>
