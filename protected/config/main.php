<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$config = array(
    'basePath'          => dirname( __FILE__ ) . DIRECTORY_SEPARATOR . '..',
    'name'              => 'Bet On Football',
    'language'          => 'en',
    'sourceLanguage'    => 'quenya',
    'defaultController' => 'tip',
    'theme'             => 'classic',
    'aliases'           => array(
        'bootstrap' => 'ext.bootstrap',
    ),
    // preloading 'log' component
    'preload'           => array(
        //'log',
        'config',
        'eav',
        'catalog',
    ),
    // autoloading model and component classes
    'import'            => array(
        'application.models.*',
        'application.modules.user.components.*',
        'application.modules.user.models.*',
        'application.modules.tip.models.*',
        'application.modules.eav.components.*',
        'application.modules.eav.models.*',
        'application.modules.catalog.components.*',
        'application.modules.catalog.models.*',
        'application.components.*',
        'ext.mail.YiiMailMessage',
        'ext.config.*',
        'ext.eoauth.*',
        'ext.eoauth.lib.*',
        'ext.lightopenid.*',
        'ext.eauth.services.*',
    ),
    'modules'           => array(

        'user' => array(
            'salt' => 'xZeQNnEsMtbN6NUvaqWnh8M1nN5aP60JIoZEMQFE9Vo9ik6eSN',
        ),
        'tip',
        'guidline',
        // uncomment the following to enable the Gii tool

        'gii'  => array(
            'class'          => 'system.gii.GiiModule',
            'password'       => '123',
            'ipFilters'      => array( '*', '::1' ),
            //'ipFilters' => array('46.188.2.4','::1'),

            'generatorPaths' => array(
                'bootstrap.gii',
            ),
        ),


    ),
    // application components
    'components'        => array(
        'messages'     => array(
            'class' => 'PhpMessageSource',
        ),
        'robokassa'    => array(
            'class'          => 'Robokassa',
            'sMerchantLogin' => 'BetonFootball',
            'sMerchantPass1' => 'mCiI7Uj1bn',
            'sMerchantPass2' => 'v62ZoGzZgv',
            'resultMethod'   => 'post',
            'sCulture'       => 'en',
            'orderModel'     => 'Purchase',
            'priceField'     => 'PriceRUR',
            //'onSuccess'      => array('Order','Success'),
            //'onFail'         => array('Order','Fail'),
            'isTest'         => false,
        ),
        /*
        'Paypal' => array(
            'class'        => 'ext.paypal.components.Paypal',
            'apiUsername'  => 'subscription-facilitator@betonfootball.eu',
            'apiPassword'  => 'ARdiSRBcWTgbGxXSTujybwW3YXuMtaijkXlsijnBRRTq8FKZmSqLbz3JOvqa',
            'apiSignature' => 'EPWsWBD3K8WGVoIl685H_CrUpTsJvQ1cIUNSxLf8rKsnHqMQNUDlEn9l2Brx',
            'apiLive'      => false,

            'returnUrl' => 'page-success_pay', //regardless of url management component
            'cancelUrl' => 'page-fail_pay', //regardless of url management component

            // Default currency to use, if not set USD is the default
            'currency'  => 'USD',

            // Default description to use, defaults to an empty string
            //'defaultDescription' => '',

            // Default Quantity to use, defaults to 1
            //'defaultQuantity' => '1',

            //The version of the paypal api to use, defaults to '3.0' (review PayPal documentation to include a valid API version)
            //'version' => '3.0',
        ),
        */
        'payment'      => array(
            'class'    => 'application.extensions.aktivemerchant.ActiveMerchant',
            'mode'     => 'test', //live
            'gateways' => array(
                'Skrill' => array(
                    'login'     => 'blabla',
                    'password'  => 'password',
                    'signature' => '....',
                    'currency'  => 'EUR'
                ),
                'PaypalExpress' => array(
                    'login'     => 'subscription_api1.betonfootball.eu', //'subscription-facilitator@betonfootball.eu',
                    'password'  => 'BR7ZMY5D9VLGV934', //'ARdiSRBcWTgbGxXSTujybwW3YXuMtaijkXlsijnBRRTq8FKZmSqLbz3JOvqa',
                    'signature' => '203BAB5F947E50B767BAABF26109FFCC', //'EPWsWBD3K8WGVoIl685H_CrUpTsJvQ1cIUNSxLf8rKsnHqMQNUDlEn9l2Brx',
                    'currency'  => 'EUR'
                ),
            ),
        ),
        'geoip'        => array(
            'class'    => 'application.extensions.geoip.CGeoIP',
            'filename' => dirname( __FILE__ ) . '/../extensions/geoip/GeoIP/GeoLiteCity.dat',
            'mode'     => 'STANDARD',
        ),
        'weather'      => array(
            'class' => 'application.extensions.weather.weather',
            'key'   => '9azzx5zzecnutkhxbch67rsc',
        ),
        'bootstrap'    => array(
            'class' => 'bootstrap.components.Bootstrap',
        ),
        'session'      => array(
            'class'                  => 'ZCDbHttpSession', //CDbHttpSession
            'autoStart'              => true,
            'connectionID'           => 'db',
            'autoCreateSessionTable' => true,
            'timeout'                => 86400,
        ),
        'config'       => array(
            'class' => 'DConfig',
        ),
        'mail'         => require('mail.php'),
        'clientScript' => array(
            'scriptMap' => array(
                'jquery.js'        => '/js/jquery-1.9.1.js',
                'jquery.min.js'    => '/js/jquery-1.9.1.min.js',
                'jquery-ui.min.js' => '/js/jquery-ui.js',
                'jquery-ui.css'    => '/css/jquery-ui.css',
            )
        ),
        'loid'         => array(
            'class' => 'ext.lightopenid.loid',
        ),
        'eauth'        => array(
            'class'    => 'ext.eauth.EAuth',
            'popup'    => false, // Use the popup window instead of redirecting.
            'services' => array( // You can change the providers and their classes.
                'google'   => array(
                    'class' => 'GoogleOpenIDService',
                ),
                'twitter'  => array(
                    'class'  => 'TwitterOAuthService',
                    'key'    => 'uc1SRjDS97a6yJ4RQiTow',
                    'secret' => 'OpyxXtSvWDYAixAjZsvZ0AaWY37FgfZh34hJE1r6V4',
                ),
                'facebook' => array(
                    'class'         => 'FacebookOAuthService',
                    'client_id'     => '478480112252065',
                    'client_secret' => '75a9b09a4fd98571de9705d4e3b70af3',
                ),

            ),
        ),
        'user'         => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'loginUrl'       => '/login',
            'class'          => 'WebUser',
        ),
        'authManager'  => array(
            // Будем использовать свой менеджер авторизации
            'class'        => 'application.modules.user.components.PhpAuthManager',
            // Роль по умолчанию. Все, кто не админы, модераторы и юзеры — гости.
            'defaultRoles' => array( 'guest' ),
        ),
        // uncomment the following to enable URLs in path-format

        'urlManager'   => array(
            'class'          => 'UrlManager',
            'languages'      => array( 'en', 'ru' ),
            'urlFormat'      => 'path',
            'showScriptName' => false,
            'rules'          => array(
                '/'                                                  => '/tip/default/index',
                'rss'                                                => '/tip/default/rss',
                'edit-tip/<id:\d+>'                                  => '/tip/default/update',
                'edit-nb-tip/<id:\d+>'                               => '/tip/default/updateNb',
                'delete-tip/<id:\d+>'                                => '/tip/default/delete',
                't<id:\d+>'                                          => '/tip/default/stat',
                'tip<id:\d+>'                                        => '/tip/default/view',
                'nb-tip<id:\d+>'                                     => '/tip/default/NbView',
                't<tipster:\d+>-tips'                                => '/tip/default/list',
                'subscribe/<term:\w+>'                               => '/tip/default/buysubscription',
                'faq'                                                => '/guidline/faq/index',
                'video'                                              => '/guidline/default/video',
                'drafts'                                             => '/tip/default/drafts',
                'cart'                                               => '/tip/default/cart',
                'single-table'                                       => '/tip/default/SingleTable',
                'no-bet-tips'                                        => '/tip/default/NoBetTips',
                'in-running-tips'                                    => '/tip/default/NoBetTips/in_running/1',
                'all-tips'                                           => '/tip/default/list',
                'active-tips'                                        => '/tip/default/list/active/1',
                'last-tips'                                          => '/tip/default/list/active/0',
                'all-stats'                                          => '/tip/default/allstat',
                'forgot'                                             => '/user/default/forgot',
                'signup'                                             => '/user/default/signup',
                'login'                                              => '/user/default/login',
                'logout'                                             => '/user/default/logout',
                'add-tip'                                            => '/tip/default/create',
                'add-nb-tip'                                         => '/tip/default/createNb',
                'add-in-running-tip'                                 => '/tip/default/createNb/in_running/1',
                'change-password'                                    => '/user/default/password',
                'profile'                                            => '/user/default/update',
                'guideline'                                          => '/guidline/default/index',
                'subscription'                                       => '/tip/default/subscription',
                'stats-all-time'                                     => '/tip/default/tipsters',
                'page-<view:\w+>'                                    => '/site/page',
                'contacts'                                           => '/guidline/default/contacts',
                'purchase'                                           => '/tip/default/purchase',
                'robokassa'                                          => '/tip/default/Robokassa',
                'sitemap.xml'                                        => '/site/SiteMap',
                'sitemap'                                            => '/site/UserSiteMap',
                'admin'                                              => '/tip/admin/default/admin',
                'admin/banner'                                       => 'admin/banner/admin',
                'admin/banner/<controller:\w+>'                      => 'admin/banner/<controller>',
                'admin/banner/<controller:\w+>/<action:\w+>'         => 'admin/banner/<controller>/<action>',
                'admin/banner/<controller:\w+>/<action:\w+>/*'       => 'admin/banner/<controller>/<action>',
                'admin/messages'                                     => 'admin/messages',
                'admin/messages/messages.csv'                        => 'admin/messages/download',
                'admin/messages/<controller:\w+>'                    => 'admin/messages/<controller>',
                'admin/messages/<controller:\w+>/<action:\w+>'       => 'admin/messages/<controller>/<action>',
                'admin/messages/<controller:\w+>/<action:\w+>/*'     => 'admin/messages/<controller>/<action>',
                'admin/<module:\w+>'                                 => '<module>/admin/default',
                'admin/<module:\w+>/<controller:\w+>'                => '<module>/admin/<controller>',
                'admin/<module:\w+>/<controller:\w+>/<action:\w+>'   => '<module>/admin/<controller>/<action>',
                'admin/<module:\w+>/<controller:\w+>/<action:\w+>/*' => '<module>/admin/<controller>/<action>',
                'catalog'                                            => 'catalog/category/view/name/optics',
                array(
                    'class' => 'application.modules.catalog.components.CatalogCategoryUrlRule'
                ),
                /*'<controller:\w+>/<id:\d+>'                          => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'             => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>'                      => '<controller>/<action>',*/
            ),
        ),
        'db'           => array(
            'connectionString' => 'mysql:host=localhost;dbname=test',
            'emulatePrepare'   => true,
            'username'         => 'test',
            'password'         => 'test',
            'charset'          => 'utf8',
            'tablePrefix'      => 'me_',
        ),
        'cache'        => array(
            'class' => 'system.caching.CFileCache',
        ),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log'          => array(
            'class'  => 'CLogRouter',
            'routes' => array(
                array(
                    'class'  => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                /*
                array(
                    'class'=>'CWebLogRoute',
                ),
                */

            ),
        ),
        'eav'          => array(
            'class'  => 'application.modules.eav.components.EavComponent',
            'config' => array(
                'translate' => array(
                    'languages' => array( 'ru' ),
                ),
                'entities'  => array(
                    'model' => array(
                        'Tips'            => array(
                            'translate' => array(
                                'club_1',
                                'club_2',
                                'league',
                                'description',
                                'content',
                                'selection',
                                'tip_result',
                                'meta_k',
                                'meta_d',
                            ),
                        ),
                        'GuidlineContent' => array(
                            'translate' => array(
                                'content'
                            ),
                        ),
                        'Config'          => array(
                            'translate' => array(
                                'value',
                            ),
                        ),
                        'CatalogElement'  => array(
                            'translate' => array(
                                'name',
                                'title',
                                'article',
                                'short_description',
                                'full_description',
                                'meta_title',
                                'meta_keywords',
                                'meta_description',
                            ),
                        ),
                        'CatalogCategory' => array(
                            'translate' => array(
                                'title',
                            ),
                        ),
                        'Reviews'         => array(
                            'translate' => array(
                                'content',
                            ),
                        ),
                    ),
                ),
            ),
        ),
        'catalog'      => array(
            'class'  => 'application.modules.catalog.components.CatalogComponent',
            'config' => array(
                'catalog' => array(
                    'admin' => array(
                        'for' => array(
                            'page'     => array(
                                'viewDir' => 'page'
                            ),
                            'articles' => array(
                                'viewDir' => 'articles'
                            ),
                        ),
                    ),
                    'for'   => array(
                        'page'     => array(
                            'viewDir' => 'page'
                        ),
                        'articles' => array(
                            'viewDir' => 'articles'
                        ),
                    ),
                ),
            ),
            /*'element' => array(
                'behaviors' => array(
                    'CatalogElementEventsBehavior' => array(
                        'class'    => 'application.modules.catalog.behaviors.CatalogElementEventsBehavior',
                        'catalogs' => array(
                            'events'
                        ),
                    ),
                ),
            ),*/
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params'            => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        'rur_eur'    => 50,
    ),
);

if (defined( 'Yii_DEBUG' )) {
    $_SERVER[ 'REMOTE_ADDR' ] = "46.188.2.4";
}
/* Include local config */
if (file_exists( $localConfig = dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'local.main.php' )) {
    $config = CMap::mergeArray( $config, require($localConfig) );
}
return $config;
