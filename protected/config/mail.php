<?php 

return array(
/*
        'mail' => array(
             'class'    => 'ext.mail.YiiMail',
             'transportType' => 'php',
             'viewPath' => 'application.views.mail',
             'logging'  => true,
             'dryRun'   => false
         ),
*/

/*
        'mail' => array(
             'class'    => 'ext.mail.YiiMail',
             'transportType' => 'php',
             'viewPath' => 'application.views.mail',
             'logging'  => true,
             'dryRun'   => false
         ),
*/
            'class'            => 'ext.mail.YiiMail',
            'transportType'    => 'smtp',
            'transportOptions' => array(
                //'host'       => 'email-smtp.us-east-1.amazonaws.com',
                //'username'   => 'AKIAISKSPP4QPGWDEIWA',
                //'password'   => 'AogNlzPOeBZrvlE1k1hANplF4mOvOIE7Hnv3ds7BSWWZ',
                'host'       => 'email-smtp.eu-west-1.amazonaws.com',
                'username'   => 'AKIAIK2HK4IM3F2K4UBQ',
                'password'   => 'Agn5cBQFhy2B8WpW4Q1AeVuKtACAP6jyy3q9FwiXk1Ui',
                'port'       => '465',
                'encryption' => 'tls', //'ssl' tls
            ),
            'viewPath'         => 'application.views.mail',
            'logging'          => true,
            'dryRun'           => false

);