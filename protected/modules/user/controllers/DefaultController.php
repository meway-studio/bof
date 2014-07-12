<?php

// User
class DefaultController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column1';

    public function init()
    {
        Yii::app()->setComponents(
            array(
                'mail' => array(
                    'viewPath' => 'webroot.themes.' . Yii::app()->theme->name . '.views.user.mail',
                ),
            )
        );
    }

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array( 'login', 'logout', 'signup', 'confirm', 'forgot', 'restore', 'unscribe' ), //,'crop'
                'users'   => array( '*' ),
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array( 'password', 'update', 'upload' ), //,'photo','AutocompleteCity','bind','unbind','profile'
                'roles'   => array( 'user' ),
            ),
            array(
                'deny', // deny all users
                'users' => array( '*' ),
            ),
        );
    }

    public function actionSpam()
    {

        $model = $this->loadModel( Yii::app()->user->id );

        if (isset($_POST[ 'spamId' ])) {


            SWITCH ($_POST[ 'spamId' ]) {
                CASE 'signup':
                    $this->sendmailSignup( $model );
                    break;
                CASE 'confirm':
                    $this->sendmailConfirm( $model );
                    break;
                CASE 'forgot':
                    $this->sendmailForgot( $model, new UserForgot('create') );
                    break;
                CASE 'restore':
                    $this->sendmailRestore( $model );
                    break;
                CASE 'widget' :
                    $this->sendmailWidget( $model );
                    break;
            }
        }

        $this->render( 'spam', array( 'model' => $model ) );
    }

    public function actionUnscribe( $id, $hash )
    {

        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_UNSCRIBE' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_UNSCRIBE' ), 'description' );
        $this->pageTitle = 'Unsubscribe';

        $model = $this->loadModel( $id );
        $status = null;

        if ($hash == $model->unscribeHash) {
            $model->scenario = 'admin_update';
            $model->has_spam = 0;
            $status = $model->save();
        }

        $this->render( 'unscribe', array( 'model' => $model, 'status' => $status ) );
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {

        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_LOGIN' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_LOGIN' ), 'description' );
        $this->pageTitle = 'Login';

        $service = Yii::app()->request->getQuery( 'service' );

        if (isset($service)) {
            $authIdentity = Yii::app()->eauth->getIdentity( $service );
            $authIdentity->redirectUrl = Yii::app()->user->returnUrl;
            $authIdentity->cancelUrl = $this->createAbsoluteUrl( Yii::app()->user->loginUrl );

            if ($authIdentity->authenticate()) {
                $identity = new ServiceUserIdentity($authIdentity);

                // Успешный вход
                if ($identity->authenticate()) {
                    Yii::app()->user->login( $identity );

                    // Специальный редирект с закрытием popup окна
                    $authIdentity->redirect();
                } else {
                    // Закрываем popup окно и перенаправляем на cancelUrl
                    $authIdentity->cancel();
                }
            }

            // Что-то пошло не так, перенаправляем на страницу входа
            $this->redirect( Yii::app()->user->loginUrl, true, 302, true );
        }

        $model = new LoginForm;

        // collect user input data
        if (isset($_POST[ 'LoginForm' ])) {
            $model->attributes = $_POST[ 'LoginForm' ];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $this->redirect( Yii::app()->user->returnUrl, true, 302, true );
            }
        }

        $this->render( 'login', array( 'model' => $model ) );
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect( Yii::app()->homeUrl );
    }

    /**
     * Регистрация нового пользователя
     */
    public function actionSignup()
    {

        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_SIGNUP' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_SIGNUP' ), 'description' );
        $this->pageTitle = Yii::t( 'themes', 'Зарегистрироваться' );

        $model = new User('signup');

        if (isset($_POST[ 'User' ])) {

            $model->attributes = $_POST[ 'User' ];
            $model->validate();

            if (!$model->hasErrors() AND $model->save()) {

                // Сразу активируем пользователя

                // если пароль не был установлен
                if (empty($model->password)) {
                    $model->password = $model->generatePassword();
                }

                $model->scenario = 'confirm';
                $model->status = 1;
                $model->confirm = 1;
                $model->role = 1;
                $model->temp_password = $model->password;
                $model->password = $model->cryptPassword;

                $model->validate();

                if (!$model->hasErrors()) {
                    $model->save();
                }

                $this->sendmailSignup( $model );

                $model->unsetAttributes();

                Yii::app()->user->setFlash(
                    'signupSuccess',
                    Yii::t( 'user', 'Поздравляю, Регистрация прошла успешно! Проверьте вашу почту.' )
                );
            } else {
                Yii::app()->user->setFlash( 'signupFailure', Yii::t( 'user', 'Ошибка. Попробуйте еще раз попозже.' ) );
            }
        }

        $model->password = '';

        $this->render( 'signup', array( 'model' => $model ) );
    }

    /**
     * Активация учетной записи
     */
    public function actionConfirm( $hash )
    {

        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_CONFIRM' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_CONFIRM' ), 'description' );
        $this->pageTitle = 'Sign Up confirm';

        $model = User::model()->findByAttributes( array( 'hash' => $hash ) );

        if ($model !== null AND $model->confirm == 0) {

            // если пароль не был установлен
            if (empty($model->password)) {
                $model->password = $model->generatePassword();
            }

            $model->scenario = 'confirm';
            $model->status = 1;
            $model->confirm = 1;
            $model->role = 1;
            $model->temp_password = $model->password;
            $model->password = $model->cryptPassword;

            $model->validate();

            if (!$model->hasErrors() AND $model->save()) {
                $this->sendmailConfirm( $model );
                Yii::app()->user->setFlash(
                    'confirmSuccess',
                    Yii::t(
                        'user',
                        'Ваша учетная запись была активирована. Проверьте вашу почту. Добро пожаловать в команду BetOnFootball!'
                    )
                );
            } else {
                Yii::app()->user->setFlash( 'confirmFailure', Yii::t( 'user', 'Ошибка. Попробуйте еще раз попозже.' ) );
            }
        }

        $this->render( 'confirm' );
    }

    /**
     * Восстановление пароля
     */
    public function actionForgot()
    {

        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_FORGOT' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_FORGOT' ), 'description' );
        $this->pageTitle = 'Password recovery';

        $model = new User();
        $model->scenario = 'forgot';

        if (isset($_POST[ 'User' ])) {

            $model->attributes = $_POST[ 'User' ];
            $model->validate();

            if (!$model->hasErrors()) {
                $user = User::model()->findByAttributes( array( 'email' => $model->email ) );

                $forgot = new UserForgot();
                $forgot->scenario = 'create';
                $forgot->user_id = $user->id;
                $forgot->validate();

                if (!$forgot->hasErrors() AND $forgot->save()) {
                    $this->sendmailForgot( $user, $forgot );
                    $model->unsetAttributes();
                    Yii::app()->user->setFlash( 'forgotSuccess', Yii::t( 'user', 'Заявка принята. Проверьте вашу почту.' ) );
                } else {
                    Yii::app()->user->setFlash( 'forgotFailure', Yii::t( 'user', 'Ошибка. Попробуйте еще раз попозже.' ) );
                }
            }
        }

        $this->render( 'forgot', array( 'model' => $model ) );
    }

    /**
     * Задать новый проль по ссылке восстановления
     */
    public function actionRestore( $hash )
    {

        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_RESTORE' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_RESTORE' ), 'description' );
        $this->pageTitle = 'Restore password';

        $model = UserForgot::model()->findByAttributes( array( 'hash' => $hash ) );

        if ($model == null OR $model->user == null OR date( 'U' ) > $model->ending_date OR $model->status != 0) {
            throw new CHttpException(404, Yii::t( 'user', 'Link is invalid' ));
        }

        if (isset($_POST[ 'User' ])) {
            $model->user->scenario = 'restore';
            $model->user->attributes = $_POST[ 'User' ];
            $model->user->validate();

            if (!$model->user->hasErrors()) {
                $model->user->temp_password = $model->user->password;
                $model->user->password = $model->user->cryptPassword;

                if ($model->user->save()) {
                    $this->sendmailRestore( $model->user );
                    $model->status = 1;
                    $model->save();
                    Yii::app()->user->setFlash( 'restoreSuccess', Yii::t( 'user', 'Пароль изменен. Проверьте вашу почту.' ) );
                } else {
                    Yii::app()->user->setFlash( 'restoreFailure', Yii::t( 'user', 'Ошибка. Попробуйте еще раз попозже.' ) );
                }
            }
        }

        $model->user->password = '';

        $this->render( 'restore', array( 'model' => $model->user ) );
    }

    /**
     * Страница профиля пользователя
     */
    public function actionProfile( $id )
    {

        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_PROFILE' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_PROFILE' ), 'description' );
        $this->pageTitle = 'My Account';

        $model = User::model()->findByPk( $id );

        if ($model == null) {
            throw new CHttpException(404, Yii::t( 'user', 'User not found' ));
        }

        $this->pageTitle = $model->FullName;

        $this->render( 'profile', array( 'model' => $model ) );
    }

    /*
     * Диалоговое окно загрузки фото пользователя
     */
    /*
    public function actionPhoto(){
        $model = $this->loadModel(Yii::app()->user->id);
        $this->render('photo', array('model'=>$model));
    }
    */

    /*
     * Загрузка фотографии
     * todo: вынести настройки загрузки и кропинга в компоенент WebUser
     */
    public function actionUpload()
    {

        $model = $this->loadModel( Yii::app()->user->id );
        $model->scenario = 'photo';
        $model->photo = CUploadedFile::getInstanceByName( 'photo' );
        $status = false;

        if ($model->photo != null) {

            $filename = strtolower( uniqid() . '.' . $model->photo->getExtensionName() );
            $model->photo->saveAs( $model->PhotoOriginalPath . $filename );
            $model->photo = $filename;

            Yii::import( 'application.extensions.imagecropper.ImageCropper' );

            $cropper = new ImageCropper;
            $cropper->resize_and_crop( $model->PhotoOriginalPath . $model->photo, $model->PhotoMediumPath . $model->photo, 320, 320, 100 );
            $cropper->resize_and_crop( $model->PhotoOriginalPath . $model->photo, $model->PhotoThumbPath . $model->photo, 150, 150, 80 );
            $status = $model->save();
        }

        echo CJSON::encode(
            array(
                'status' => $status,
                'photo'  => array(
                    'original'  => $model->PhotoOriginal,
                    'medium'    => $model->PhotoMedium,
                    'thumbnail' => $model->PhotoThumb,
                )
            )
        );

        Yii::app()->end();
    }

    /*
     * Кроп фотографии
     * todo: вынести настройки загрузки и кропинга в компоенент WebUser
     */
    /*
    public function actionCrop(){

        if(Yii::app()->user->isGuest){

            echo CJSON::encode(array('status' => false, 'redirect'=>$this->createUrl(Yii::app()->user->loginUrl)));

        }else if(isset($_POST['coords'])){

            $model = User::model()->findByPk(Yii::app()->user->id);

            if(!$model OR empty($model->photo)){
                echo CJSON::encode(array('status' => false));

            }else{

                $targ_w_1 = $targ_h_1 = 320;
                $targ_w_2 = $targ_h_2 = 100;
                $jpeg_quality         = 90;

                $src    = $model->PhotoOriginalPath.$model->photo;

                SWITCH(CFileHelper::getExtension($src))
                {
                    CASE 'jpg': $img_r = imagecreatefromjpeg($src); break;
                    CASE 'gif': $img_r = imagecreatefromgif($src); break;
                    CASE 'png': $img_r = imagecreatefrompng($src); break;
                }

                $dst_r_1 = ImageCreateTrueColor( $targ_w_1, $targ_h_1 );
                $dst_r_2 = ImageCreateTrueColor( $targ_w_2, $targ_h_2 );

                imagecopyresampled($dst_r_1,$img_r,0,0,$_POST['x'],$_POST['y'],$targ_w_1,$targ_h_1,$_POST['w'],$_POST['h']);
                imagecopyresampled($dst_r_2,$img_r,0,0,$_POST['x'],$_POST['y'],$targ_w_2,$targ_h_2,$_POST['w'],$_POST['h']);

                $status = imagejpeg($dst_r_1,$model->PhotoMediumPath.$model->photo,$jpeg_quality);
                $status = imagejpeg($dst_r_2,$model->PhotoThumbPath.$model->photo,$jpeg_quality);

                echo CJSON::encode(array('status' => true));
            }
        }

        Yii::app()->end();
    }
    */

    /**
     * Страница редактирования профиля пользователя
     */
    public function actionUpdate()
    {

        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_PROFILE' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_PROFILE' ), 'description' );
        $this->pageTitle = 'My Account';

        $model = $this->loadModel( Yii::app()->user->id );
        $model->scenario = 'update';

        if ($model->isTipster AND $model->tipster == null) {
            $model->tipster = new Tipsters();
            $model->tipster->user_id = $model->id;
        }

        if (isset($_POST[ 'User' ])) {

            $model->attributes = $_POST[ 'User' ];
            $model->validate();

            if (!$model->hasErrors() AND $model->save()) {
                if ($model->about) {
                    if (!($review = Reviews::model()->findByAttributes( array( 'user_id' => $model->id ) ))) {
                        $review = new Reviews();
                        $review->user_id = $model->id;
                        $review->create_date = time();
                    }
                    $review->content = $model->about;
                    $review->status = 0;
                    $review->save();
                }

                // если у пользователя небыл подтвержден емейл адрес, отправить письмо ему
                if ($model->confirm == 0) {

                    $this->sendmailSignup( $model );
                    Yii::app()->user->setFlash(
                        'updateSuccess',
                        Yii::t(
                            'user',
                            'Данные были изменены. Вам отправлено письмо на указанный E-mail. Для активации E-mail пройдите по ссылке в письме.'
                        )
                    );
                } else {
                    Yii::app()->user->setFlash( 'updateSuccess', Yii::t( 'user', 'Данные были изменены.' ) );
                }
            } else {
                Yii::app()->user->setFlash( 'updateFailure', Yii::t( 'user', 'Ошибка. Попробуйте еще раз попозже.' ) );
            }
        }

        if (isset($_POST[ 'Tipsters' ]) AND $model->isTipster) {

            $model->tipster->attributes = $_POST[ 'Tipsters' ];
            $model->tipster->validate();

            if (!$model->tipster->hasErrors()) {
                $model->tipster->save();
            } else {
                print_r( $model->tipster->getErrors() );
                Yii::app()->end();
            }
        }

        $this->render( 'update', array( 'model' => $model ) );
    }

    protected function createUserContact( $user_id, $contact_type )
    {
        $contact = new UserContact('create');
        $contact->user_id = $user_id;
        $contact->contact_type = $contact_type;
        return $contact->save();
    }

    /**
     * Изменить пароль учетной записи
     */
    public function actionPassword()
    {

        $model = $this->loadModel( Yii::app()->user->id );
        $form = new User('password');

        if (isset($_POST[ 'User' ]) AND $model->confirm == 1) {

            $form->attributes = $_POST[ 'User' ];
            $form->validate();

            if ($model->password != $form->cryptPassword) {
                $form->addError( 'password', Yii::t( 'user', 'Текущий пароль неверный' ) );
            }

            if (!$form->hasErrors()) {

                $model->scenario = 'restore';
                $model->password = User::cryptPassword( $form->temp_password );
                $model->validate();

                if (!$model->hasErrors() AND $model->save()) {
                    Yii::app()->user->setFlash( 'passwordSuccess', Yii::t( 'user', 'Успешно изменен пароль' ) );
                } else {
                    Yii::app()->user->setFlash( 'passwordFailure', Yii::t( 'user', 'Изменить пароль не удалось' ) );
                }
            }

            // $form->unsetAttributes не работает для temp_password
            $form->password = '';
            $form->temp_password = '';
        }

        $this->render( 'password', array( 'model' => $form, 'user' => $model ) );
    }

    /**
     * Прикрепить к учетной записи аккаунт eauth
     */
    public function actionBind()
    {

        $this->pageTitle = Yii::t( 'user', 'Прикрепить учетную запись' );

        $service = Yii::app()->request->getQuery( 'service' );

        if (isset($service)) {

            $authIdentity = Yii::app()->eauth->getIdentity( $service );
            $authIdentity->redirectUrl = $this->createAbsoluteUrl( '/' . $this->route ); //Yii::app()->user->returnUrl;
            $authIdentity->cancelUrl = $this->createAbsoluteUrl( Yii::app()->user->loginUrl );

            if ($authIdentity->authenticate()) {
                $identity = new ServiceUserIdentity($authIdentity);

                // Успешный вход
                if ($identity->bindAuthenticate()) {
                    Yii::app()->user->setFlash( 'bindSuccess', Yii::t( 'user', 'Учетная запись успешно привязана' ) );

                    // Специальный редирект с закрытием popup окна
                    $authIdentity->redirect();
                } else {

                    Yii::app()->user->setFlash( 'bindFailure', Yii::t( 'user', 'Ошибка. Попробуйте позднее.' ) );

                    // Закрываем popup окно и перенаправляем на cancelUrl
                    $authIdentity->cancel();
                }
            }
        }

        // получить все прикрепленные учетные записи
        $model = UserEauth::model()->findAllByAttributes( array( 'user_id' => Yii::app()->user->id ) );

        $this->render( 'bind', array( 'model' => $model ) );
    }

    public function actionUnbind()
    {

        $id = Yii::app()->request->getPost( 'id', false );
        $data = array( 'status' => false );

        $model = UserEauth::model()->findByAttributes( array( 'user_id' => Yii::app()->user->id, 'id' => $id ) );

        if ($model !== null) {
            $model->delete();
            $data[ 'status' ] = true;
        }

        echo CJSON::encode( $data );
        Yii::app()->end();
    }

    public function actionAutocompleteCity()
    {

        $term = Yii::app()->getRequest()->getParam( 'term' );

        if (!empty($term)) {

            $criteria = new CDbCriteria;
            $criteria->compare( 'city_name_ru', $term, true, 'OR' );
            $criteria->compare( 'city_name_en', $term, true, 'OR' );
            $customers = City::model()->findAll( $criteria );
            $result = array();
            foreach ($customers as $city) {
                $result[ ] = array( 'id' => $city->id, 'label' => $city->Name, 'value' => $city->Name );
            }
        }

        echo CJSON::encode( $result );
        Yii::app()->end();
    }

    /************************************************ START sendmail *************************************************/

    /**
     * Отправка письма для подтверждения емейл адреса
     */
    protected function sendmailSignup( $model )
    {
        return $this->sendmail(
            $model,
            Yii::t( 'user', 'Регистрация на сайте BoF' ) . ' ' . Yii::app()->name,
            array( 'model' => $model ),
            'signup'
        );
    }

    /**
     * Отправка письма после подтверждения емейл адреса
     */
    protected function sendmailConfirm( $model )
    {
        return $this->sendmail(
            $model,
            Yii::t( 'user', 'Ваша учетная запись активирована' ) . ' ' . Yii::app()->name,
            array( 'model' => $model ),
            'confirm'
        );
    }

    /**
     * Отправка письма для восстановления пароля
     */
    protected function sendmailForgot( $user, $forgot )
    {
        return $this->sendmail(
            $user,
            Yii::t( 'user', 'Восстановление пароля для входа на BoF' ) . ' ' . Yii::app()->name,
            array( 'model' => $user, 'forgot' => $forgot ),
            'forgot'
        );
    }

    /**
     * Отправка нового пароля после восстановления
     */
    protected function sendmailRestore( $model )
    {
        return $this->sendmail(
            $model,
            Yii::t( 'user', 'Ваш новый пароль для входа на BoF' ) . ' ' . Yii::app()->name,
            array( 'model' => $model ),
            'restore'
        );
    }

    /**
     * Отправка нового пароля после восстановления
     */
    protected function sendmailWidget( $model )
    {
        return $this->sendmail(
            $model,
            Yii::t( 'user', 'Новый ' ) . ' ' . Yii::app()->name,
            array( 'model' => $model ),
            'widget'
        );
    }

    protected function sendmail( $user, $subjext, $body = array(), $view )
    {
        $message = new YiiMailMessage($subjext);
        $message->setBody( $body, 'text/html' );
        $defaultLang = Yii::app()->language;
        if ($user->language) {
            Yii::app()->language = $user->language;
        }
        $message->addTo( $user->email );
        $message->from = array( Yii::app()->config->get( 'EMAIL_NOREPLY' ) => Yii::app()->name );
        $return = Yii::app()->mail->send( $message );
        Yii::app()->language = $defaultLang;
        return $return;
    }

    /************************************************ END sendmail *************************************************/

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel( $id )
    {
        $model = User::model()->findByPk( $id );
        if ($model === null) {
            throw new CHttpException(404, Yii::t( 'user', 'Запрашиваемая страница не существует.' ));
        }
        return $model;
    }
}