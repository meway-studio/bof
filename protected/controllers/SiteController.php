<?php

class SiteController extends Controller
{
    //public $layout = '//layouts/column1';

    public function init()
    {
        Yii::app()->user->load();
        parent::init();
    }

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            /*
                // captcha action renders the CAPTCHA image displayed on the contact page
                'captcha'=>array(
                    'class'     => 'CCaptchaAction',
                    'backColor' => 0xFFFFFF,
                    'foreColor' => 0x8CC153,
                    'height'    => 100,
                    'width'     => 240,
                    'minLength' => 2,
                    'maxLength' => 5,
                    'offset'    => -5,
                    'transparent' => true,
                ),
                */
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'ViewAction',
                //'layout' => '//layouts/column1',
            ),
        );
    }

    public function actionTest()
    {

        Yii::import( 'ext.paypal.Paypal' );

        // Параметры нашего запроса
        $requestParams = array(
            'RETURNURL' => 'http://www.betonfootball.eu/page-success_pay',
            'CANCELURL' => 'http://www.betonfootball.eu/page-fail_pay'
        );

        $orderParams = array(
            'PAYMENTREQUEST_0_AMT'          => '500',
            'PAYMENTREQUEST_0_SHIPPINGAMT'  => '4',
            'PAYMENTREQUEST_0_CURRENCYCODE' => 'GBP',
            'PAYMENTREQUEST_0_ITEMAMT'      => '496'
        );

        $item = array(
            'L_PAYMENTREQUEST_0_NAME0' => 'iPhone',
            'L_PAYMENTREQUEST_0_DESC0' => 'White iPhone, 16GB',
            'L_PAYMENTREQUEST_0_AMT0'  => '496',
            'L_PAYMENTREQUEST_0_QTY0'  => '1'
        );

        $paypal = new Paypal();
        $response = $paypal->request( 'SetExpressCheckout', $requestParams + $orderParams + $item );

        if (is_array( $response ) && $response[ 'ACK' ] == 'Success') { // Запрос был успешно принят
            $token = $response[ 'TOKEN' ];
            $url = 'https://www.paypal.com/webscr?cmd=_express-checkout&token=' . urlencode( $token );

            $this->redirect( $url );
        } else {
            print_r( $response );
        }

        Yii::app()->end();
    }

    public function actionSiteMap()
    {
        Yii::import( 'application.components.DSitemap' );

        if (!($xml = Yii::app()->cache->get( 'sitemap' ))) {
            $classes = array(
                'Tips'   => array( DSitemap::DAILY, 0.8 ),
                'NbTips' => array( DSitemap::DAILY, 0.8 ),
            );

            $sitemap = new DSitemap();

            //$sitemap->addUrl('/drafts', DSitemap::WEEKLY);
            //$sitemap->addUrl('/cart', DSitemap::WEEKLY);
            //$sitemap->addUrl('/change-password', DSitemap::WEEKLY);
            //$sitemap->addUrl('/logout', DSitemap::WEEKLY);
            $sitemap->addUrl( '/sitemap', DSitemap::WEEKLY );
            $sitemap->addUrl( '/video', DSitemap::WEEKLY );
            $sitemap->addUrl( '/single-table', DSitemap::WEEKLY );
            $sitemap->addUrl( '/no-bet-tips', DSitemap::WEEKLY );
            $sitemap->addUrl( '/all-tips', DSitemap::WEEKLY );
            $sitemap->addUrl( '/active-tips', DSitemap::WEEKLY );
            $sitemap->addUrl( '/last-tips', DSitemap::WEEKLY );
            $sitemap->addUrl( '/all-stats', DSitemap::WEEKLY );
            $sitemap->addUrl( '/forgot', DSitemap::WEEKLY );
            $sitemap->addUrl( '/signup', DSitemap::WEEKLY );
            $sitemap->addUrl( '/login', DSitemap::WEEKLY );
            $sitemap->addUrl( '/add-tip', DSitemap::WEEKLY );
            $sitemap->addUrl( '/add-nb-tip', DSitemap::WEEKLY );
            $sitemap->addUrl( '/profile', DSitemap::WEEKLY );
            $sitemap->addUrl( '/guideline', DSitemap::WEEKLY );
            $sitemap->addUrl( '/subscription', DSitemap::WEEKLY );
            $sitemap->addUrl( '/stats-all-time', DSitemap::WEEKLY );
            $sitemap->addUrl( '/contacts', DSitemap::WEEKLY );
            $sitemap->addUrl( '/purchase', DSitemap::WEEKLY );

            foreach ($classes as $class => $options) {
                $sitemap->addModels( CActiveRecord::model( $class )->published()->findAll(), $options[ 0 ], $options[ 1 ] );
            }

            $xml = $sitemap->render();
            Yii::app()->cache->set( 'sitemap', $xml, 3600 );
        }

        header( "Content-type: text/xml" );
        echo $xml;
        Yii::app()->end();
    }

    public function actionUserSiteMap()
    {
        $model = User::model()->active()->tipsterRole()->with( 'tipster' )->findAll();
        $this->render( 'sitemap', array( 'model' => $model ) );
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest) {
                echo $error[ 'message' ];
            } else {
                $this->render( 'error', $error );
            }
        }
    }

    public function actionMessages()
    {
        $messagesPath = Yii::getPathOfAlias( 'application.messages' );
        $messagesPattern = "<?php\nreturn array(\n{rows}\n);";
        $messageRowPattern = "\t" . '"{key}" => "{value}",' . "\n{rows}";
        $result = array();

        if (($handle = fopen( Yii::getPathOfAlias( 'webroot.uploads' ) . '/messages.csv', "r" )) !== false) {
            while (($data = fgetcsv( $handle, 1000, "," )) !== false) {
                list($file, $originMessage, $enMessage, $ruMessage) = $data;

                $originMessage = str_replace( '"', '\"', $originMessage );

                foreach (array( 'en' => $enMessage, 'ru' => $ruMessage ) as $lang => $message) {
                    $message = str_replace( '"', '\"', $message );
                    $row = str_replace(
                        array( '{key}', '{value}' ),
                        array( $originMessage, $message ),
                        $messageRowPattern
                    );

                    if (empty($result[ $lang ])) {
                        $result[ $lang ] = array();
                    }

                    $pattern = empty($result[ $lang ][ $file ]) ? $messagesPattern : $result[ $lang ][ $file ];
                    $result[ $lang ][ $file ] = str_replace(
                        '{rows}',
                        $row,
                        $pattern
                    );
                }
            }
            fclose( $handle );
        }

        foreach ($result as $lang => $fileData) {
            if (!is_array( $fileData )) {
                continue;
            }
            foreach ($fileData as $file => $data) {
                $data = str_replace( "\n{rows}", '', $data );
                file_put_contents( "{$messagesPath}/{$lang}/{$file}", $data );
            }
        }
    }

    /**
     * Displays the contact page
     */
    /*
    public function actionContact()
    {
        $model=new ContactForm;
        if(isset($_POST['ContactForm']))
        {
            $model->attributes=$_POST['ContactForm'];
            if($model->validate())
            {
                $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
                $subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
                $headers="From: $name <{$model->email}>\r\n".
                    "Reply-To: {$model->email}\r\n".
                    "MIME-Version: 1.0\r\n".
                    "Content-type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
                Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact',array('model'=>$model));
    }
    */
    /**
     * Displays the contact page
     */
    /*
    public function actionGuidline()
    {
        $model=new ContactForm;
        if(isset($_POST['ContactForm']))
        {
            $model->attributes=$_POST['ContactForm'];
            if($model->validate())
            {
                $name='=?UTF-8?B?'.base64_encode($model->name).'?=';
                $subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
                $headers="From: $name <{$model->email}>\r\n".
                    "Reply-To: {$model->email}\r\n".
                    "MIME-Version: 1.0\r\n".
                    "Content-type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
                Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('guidline',array('model'=>$model));
    }
    */
}