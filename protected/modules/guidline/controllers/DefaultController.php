<?php

class DefaultController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class'       => 'CCaptchaAction',
                'backColor'   => 0xFFFFFF,
                'foreColor'   => 0x8CC153,
                'height'      => 100,
                'width'       => 240,
                'minLength'   => 2,
                'maxLength'   => 5,
                'offset'      => -5,
                'transparent' => true,
            ),
            'index'   => array(
                'class' => 'ViewAction'
            ),
        );
    }

    public function init()
    {
        Yii::app()->setComponents(
            array(
                'mail' => array(
                    'viewPath' => 'webroot.themes.' . Yii::app()->theme->name . '.views.guidline.mail',
                ),
            )
        );
    }

    public function actionIndex()
    {

        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_GUIDELINE' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_GUIDELINE' ), 'description' );
        $this->pageTitle = Yii::t( 'GuidlineMessages', 'Гайдлайн BOF' );

        $model = new GuidlineMessages();
        $model->scenario = 'form';

        if (isset($_POST[ 'GuidlineMessages' ])) {

            $model->attributes = $_POST[ 'GuidlineMessages' ];
            $model->validate();

            if (!$model->hasErrors() AND $model->save()) {

                Yii::app()->user->setFlash( 'GuidlineMessagesSuccess', Yii::t( 'GuidlineMessages', 'Сообщение отправлено. Спасибо!' ) );

                // sendmail here
                $this->sendmail( $model );
            }
            //Yii::app()->user->setFlash('GuidlineMessagesFailure', Yii::t('GuidlineMessages', 'Error, please try later!'));

        }

        $rules = GuidlineContent::model()->findAll(
            array(
                'condition' => 'status=:S',
                'params'    => array( ':S' => GuidlineContent::STATUS_PUBLIC ),
                'order'     => 'sort ASC',
            )
        );

        $index = null;

        foreach ($rules AS $k => $item) {
            if ($item->is_index == 1) {
                $index = $item;
                unset($rules[ $k ]);
                break;
            }
        }

        @sort( $rules, SORT_NUMERIC );

        $this->render(
            'index',
            array(
                'model' => $model,
                'rules' => $rules,
                'index' => $index,
            )
        );
    }

    public function actionContacts()
    {

        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_CONTACTS' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_CONTACTS' ), 'description' );
        $this->pageTitle = Yii::t( 'GuidlineMessages', 'Контакты BOF' );

        $model = new GuidlineMessages();
        $model->scenario = 'form';

        if (isset($_POST[ 'GuidlineMessages' ])) {

            $model->attributes = $_POST[ 'GuidlineMessages' ];
            $model->validate();

            if (!$model->hasErrors() AND $model->save()) {

                Yii::app()->user->setFlash( 'GuidlineMessagesSuccess', Yii::t( 'GuidlineMessages', 'Сообщение отправлено. Спасибо!' ) );

                // sendmail here
                $this->sendmail( $model );
            }
            //Yii::app()->user->setFlash('GuidlineMessagesFailure', Yii::t('GuidlineMessages', 'Error, please try later!'));

        }

        $this->render(
            'contact',
            array(
                'model' => $model,
            )
        );
    }

    public function actionVideo()
    {

        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_CONTACTS' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_CONTACTS' ), 'description' );
        $this->pageTitle = Yii::t( 'GuidlineMessages', 'Видео советы' );

        $model = new GuidlineMessages();
        $model->scenario = 'form';

        if (isset($_POST[ 'GuidlineMessages' ])) {

            $model->attributes = $_POST[ 'GuidlineMessages' ];
            $model->validate();

            if (!$model->hasErrors() AND $model->save()) {

                Yii::app()->user->setFlash( 'GuidlineMessagesSuccess', Yii::t( 'GuidlineMessages', 'Сообщение отправлено. Спасибо!' ) );

                // sendmail here
                $status = @$this->sendmail( $model );

                echo '<!--';
                echo $status ? 'Sendmail sended' : 'Sendmail error';
                echo '-->';
            }
            //Yii::app()->user->setFlash('GuidlineMessagesFailure', Yii::t('GuidlineMessages', 'Error, please try later!'));
        }

        $this->render(
            'video',
            array(
                'model' => $model,
            )
        );
    }

    protected function sendmail( $model )
    {
        $message = new YiiMailMessage(Yii::t( 'GuidlineMessages', 'Рекомендуемый вопрос от' ) . ' ' . Yii::app()->name);
        $message->view = 'form';
        $message->setBody( array( 'model' => $model ), 'text/html' );
        $message->addTo( Yii::app()->config->get( 'GUIDLINE_EMAIL_TO' ) );
        $message->from = array( Yii::app()->config->get( 'GUIDLINE_EMAIL_FROM' ) => Yii::app()->name );
        return Yii::app()->mail->send( $message );
    }
}