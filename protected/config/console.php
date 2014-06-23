<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
$config = array(
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'     => 'Bet On Football',
	'language'          => 'en',
	'sourceLanguage'    => 'quenya',

	// preloading 'log' component
	'preload'=>array(
		'log',
		'config'
	),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.modules.user.components.*',
		'application.modules.user.models.*',
		'application.modules.tip.models.*',
		'application.modules.eav.components.*',
		'application.components.*',
		'ext.mail.YiiMailMessage',
		'ext.config.*',
		'ext.eoauth.*',
		'ext.eoauth.lib.*',
		'ext.lightopenid.*',
		'ext.eauth.services.*',
	),
	
	'modules'=>array(
		
		'user' => array(
			'salt' => 'xZeQNnEsMtbN6NUvaqWnh8M1nN5aP60JIoZEMQFE9Vo9ik6eSN',
		),
	),
	
	'behaviors'=>array(
		'templater'=>'ConsoleApplicationTemplater', //application.extentions.templater.
	),

	// application components
	'components'=>array(
		
		'widgetFactory'=>array(
            'class'=>'CWidgetFactory',
        ),
		
        'themeManager'=>array(
            'class'=>'CThemeManager',
        ),
		
		'request' => array(
            'hostInfo'  => 'http://www.betonfootball.eu',
            'baseUrl'   => '',
            'scriptUrl' => '',
        ),
		
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin' => true,
			'loginUrl'       => '/user/default/login',
			'class'          => 'WebUser',
		),
		
		'mail' => array(
 			'class'            => 'ext.mail.YiiMail',
            'transportType'    => 'smtp',
			'transportOptions' => array(
				'host'       => 'email-smtp.us-east-1.amazonaws.com',
				'username'   => 'AKIAISKSPP4QPGWDEIWA',
				'password'   => 'AogNlzPOeBZrvlE1k1hANplF4mOvOIE7Hnv3ds7BSWWZ',
				'port'       => '465',
				'encryption' => 'tls', //'ssl' tls
			),
            'viewPath' => 'application.views.mail',
            'logging'  => true,
            'dryRun'   => false
 		),
		
		'config'=>array(
			'class' => 'DConfig'
		),

        'db' => array(
			'connectionString' => 'mysql:host=localhost;dbname=test',
			'emulatePrepare'   => true,
			'username'         => 'test',
			'password'         => 'test',
			'charset'          => 'utf8',
			'tablePrefix'      => 'me_',
		),
        'cache'        => array(
            'class' => 'system.caching.CDummyCache',
        ),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
		
		'urlManager'=>array(
			'urlFormat'      => 'path',
			'showScriptName' => false,

			'rules'=>array(
				
				'/'                   => '/tip/default/index',
				'edit-tip/<id:\d+>'   => '/tip/default/update',
				'delete-tip/<id:\d+>' => '/tip/default/delete',
				't<id:\d+>'           => '/tip/default/stat',
				'tip<id:\d+>'         => '/tip/default/view',
				't<tipster:\d+>-tips' => '/tip/default/list',
				
				'subscribe/<term:\w+>' => '/tip/default/buysubscription',
				
				'drafts'         => '/tip/default/drafts',
				'cart'           => '/tip/default/cart',
				'all-tips'       => '/tip/default/list',
				'active-tips'    => '/tip/default/list/active/0',
				'last-tips'      => '/tip/default/list/active/0',
				'all-stats'      => '/tip/default/allstat',
				'signup'         => '/user/default/signup',
				'login'          => '/user/default/login',
				'logout'         => '/user/default/logout',
				'add-tip'        => '/tip/default/create',
				'change-password'=> '/user/default/password',
				'profile'        => '/user/default/update',
				'guideline'      => '/guidline/default/index',
				'subscription'   => '/tip/default/subscription',
				'stats-all-time' => '/tip/default/tipsters',
				'page-<view:\w+>'=> '/site/page',
				'contacts'       => '/guidline/default/contacts',
				'purchase'       => '/tip/default/purchase',
				
				/*
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				*/
				
				'admin'=>'/tip/admin/default/admin',
				'admin/<module:\w+>'=>'<module>/admin/default',
				'admin/<module:\w+>/<controller:\w+>'=>'<module>/admin/<controller>',
				'admin/<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/admin/<controller>/<action>',
				'admin/<module:\w+>/<controller:\w+>/<action:\w+>/*'=>'<module>/admin/<controller>/<action>',
			),
		),
		
		
	),
	
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'noreplyEmail' => 'webmaster@example.com',
		'adminEmail'   => 'webmaster@example.com',
	),
);

/* Include local config */
if (file_exists($localConfig = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'local.console.php')) {
    $config = CMap::mergeArray($config, require($localConfig));
}
return $config;