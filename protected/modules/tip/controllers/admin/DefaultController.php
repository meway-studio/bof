<?php

class DefaultController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $defaultAction = 'admin';

    public function init()
    {

        Yii::app()->theme = 'bootstrap';

        Yii::app()->setComponents(
            array(
                'mail' => array(
                    'viewPath' => 'webroot.themes.' . Yii::app()->theme->name . '.views.tip.mail',
                ),
            )
        );

        //Yii::app()->theme = null;
        parent::init();
    }

    public function actions()
    {
        return array(
            'upload' => array(
                'class'     => 'ext.blueimp.FileUploadAction',
                'attribute' => 'cover',
                'filepath'  => 'webroot.images.tips',
                'allowMime' => array( 'image/jpeg', 'image/png', 'image/gif' ),
                'minsize'   => 0,
                'maxsize'   => 1024 * 1024,
            ),
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
                'allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array( 'meta', 'admin', 'update', 'view' ),
                'roles'   => array( 'manager' ),
            ),
            array(
                'allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array(
                    'admin',
                    'delete',
                    'create',
                    'update',
                    'index',
                    'view',
                    'settings',
                    'purchase',
                    'PurchaseDetail',
                    'purchaseDelete',
                    'adminInput',
                    'meta',
                    'calc',
                    'statistics'
                ),
                'roles'   => array( 'admin' ),
            ),
            array(
                'deny', // deny all users
                'users' => array( '*' ),
            ),
        );
    }

    public function actionCalc()
    {
        set_time_limit( 0 );
        $result = array(
            'count_all'  => '',
            'count_won'  => '',
            'count_lost' => '',
            'count_void' => '',
            'profit_all' => '',
            'yield_all'  => '',
            'stake_all'  => '',
        );


        $between = array(
            'from' => Yii::app()->request->getParam( 'from', '' ),
            'to'   => Yii::app()->request->getParam( 'to', '' ),
        );

        if (empty($between[ 'from' ]) OR empty($between[ 'to' ])) {
            Yii::app()->end();
        }

        $s = strtotime( $between[ 'from' ] );
        $f = strtotime( $between[ 'to' ] );

        $cr = new CDbCriteria();
        $cr->addBetweenCondition( 'event_date', $s, $f );
        $cr->scopes = array( 'published', 'closed' );
        $cr->order = 'id';

        $result[ 'count_all' ] = ($countAll = Tips::model()->count($cr));

        $pageSize = 50;
        $countPages = ($countAll - ($countAll % $pageSize)) / $pageSize;
        $countPages += ($countAll % $pageSize) ? 1 : 0;

        for ($page = 0; $page < $countPages; $page++) {
            $dataProvider = new CActiveDataProvider(new Tips());
            $dataProvider->criteria = $cr;
            $dataProvider->pagination->pageSize = $pageSize;
            $dataProvider->pagination->currentPage = $page;
            $items = $dataProvider->getData();
            unset($dataProvider);

            foreach ($items as $item) {
                $result[ 'profit_all' ] += $item->TempProfit;
                $result[ 'stake_all' ] += $item->stake;

                SWITCH ($item->tip_result) {
                    CASE Tips::TIP_RESULT_WON:
                        $result[ 'count_won' ]++;
                        break;
                    CASE Tips::TIP_RESULT_HALF:
                        $result[ 'count_won' ]++;
                        break;
                    CASE Tips::TIP_RESULT_LOST:
                        $result[ 'count_lost' ]++;
                        break;
                    CASE Tips::TIP_RESULT_VOID:
                        $result[ 'count_void' ]++;
                        break;
                    CASE Tips::TIP_RESULT_HALF_LOST:
                        $result[ 'count_lost' ]++;
                        break;
                }
            }
        }

        if ($result[ 'count_all' ] > 0) {
            $result[ 'yield_all' ] = round( $result[ 'profit_all' ] / $result[ 'stake_all' ] * 100, 2 );
        }

        header( 'Content-Type: text/json; charset=utf8' . PHP_EOL );
        echo CJSON::encode( $result );
        die();
    }

    public function actionStatistics()
    {
        $this->render( 'statistics' );
    }

    public function actionMeta()
    {

        $model = new MetaForm;

        foreach ($model->attributes AS $k => $v) {

            if (!Yii::app()->config->has( $k )) {
                Yii::app()->config->add( array( array( 'param' => $k ) ) );
            }

            $model->{$k} = Yii::app()->config->get( $k );
        }

        if (isset($_POST[ 'MetaForm' ])) {
            $model->attributes = $_POST[ 'MetaForm' ];

            foreach ($model->attributes AS $k => $v) {
                Yii::app()->config->set( $k, $v );
            }
        }

        $this->render( 'meta', array( 'model' => $model ) );
    }

    public function actionAdminInput()
    {

        $data = Yii::app()->request->getPost( 'Tip', array() );
        $result = array();

        $data[ 'tip_result' ] = isset($data[ 'tip_result' ]) ? $data[ 'tip_result' ] : array();

        foreach ($data[ 'tip_result' ] AS $id => $attr) {

            $model = Tips::model()->findByPk( $id );

            if ($model == null) {
                continue;
            }

            $model->tip_result = $data[ 'tip_result' ][ $id ];
            $model->match_result = $data[ 'match_result' ][ $id ];
            $status = $model->save();

            $result[ $id ] = array(
                'status'  => $status,
                'message' => ($status ? Yii::t( 'tips', 'Успешно обновлено' ) : Yii::t( 'tips', 'Ошибка при обновлении' )),
                'title'   => $model->title,
            );
        }

        echo CJSON::encode( $result );
        Yii::app()->end();
    }

    public function actionPurchase()
    {

        $this->layout = '//layouts/column1';

        $model = new Purchase('search');

        $model->unsetAttributes(); // clear any default values

        if (isset($_GET[ 'Purchase' ])) {
            $model->attributes = $_GET[ 'Purchase' ];
        }

        $this->render(
            'purchase',
            array(
                'model' => $model,
            )
        );
    }

    public function actionPurchaseDetail( $id, $action = null )
    {

        $this->layout = '//layouts/column1';

        $model = Purchase::model()->with( 'user', 'tips' )->findByPk( $id );

        if ($model == null) {
            throw new CHttpException(404, Yii::t( 'tips', 'Запрашиваемая страница не существует.' ));
        }

        if ($model->status == Purchase::STATUS_NEW) {

            if ($action == 'yes') {
                $model->status = Purchase::STATUS_PAID;
                $model->save();

                // открыть доступ к типсам
                if ($model->type == Purchase::TYPE_ONCE) {

                    foreach ($model->tips AS $item) {
                        $ptip = new PaidTips();
                        $ptip->tip_id = $item->tips_id;
                        $ptip->user_id = $model->user_id;
                        $ptip->save();
                    }
                    // или увеличить время
                } else {
                    if ($model->type == Purchase::TYPE_DATE) {

                        $user = $model->user;

                        if ($user->sub == null) {

                            $sub = new UsersSubscription();
                            $sub->user_id = $user->id;
                            $sub->expiration_date = date( 'U' );
                            $sub->save();

                            $user = User::model()->with( 'sub' )->findByPk( $user->id );
                        }

                        $user->sub->expiration_date = (($user->sub->expiration_date > date( 'U' )) ? ($user->sub->expiration_date
                            + $model->days) : (date( 'U' ) + $model->days));
                        $user->sub->save();
                    }
                }
            } else {
                if ($action == 'no') {
                    $model->status = Purchase::STATUS_REJECT;
                    $model->save();
                }
            }
        }

        $this->render(
            'purchase_detail',
            array(
                'model' => $model,
            )
        );
    }

    // гланвая страница
    public function actionSettings()
    {

        $model = new SettingsForm();

        foreach ($model->attributes AS $k => $v) {

            if (!Yii::app()->config->has( $k )) {
                Yii::app()->config->add( array( array( 'param' => $k ) ) );
            }

            $model->{$k} = Yii::app()->config->get( $k );
        }

        if (isset($_POST[ 'SettingsForm' ])) {

            $model->attributes = $_POST[ 'SettingsForm' ];
            $model->validate();

            if (!$model->hasErrors()) {

                foreach ($model->attributes AS $k => $v) {
                    Yii::app()->config->set( $k, $v );
                }

                Yii::app()->user->setFlash( 'updateSuccess', Yii::t( 'tips', 'Настройки сохранены' ) );
            }
        }

        $this->render( 'settings', array( 'model' => $model ) );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView( $id )
    {
        $this->render(
            'view',
            array(
                'model' => $this->loadModel( $id ),
            )
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model = new Tips;
        $model->scenario = 'create';

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST[ 'Tips' ])) {
            $model->attributes = $_POST[ 'Tips' ];
            $model->validate();

            if (!$model->hasErrors()) {

                $model->dateWithTime();
                $model->save();
                $this->redirect( array( 'view', 'id' => $model->id ) );
            }
        }

        $this->render(
            'create',
            array(
                'model' => $model,
            )
        );
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate( $id )
    {
        $model = $this->loadModel( $id );
        $model->scenario = Yii::app()->user->isAdmin ? 'create' : 'seo';
        $model->dateWithOutTime();

        if (isset($_POST[ 'Tips' ])) {
            $model->attributes = $_POST[ 'Tips' ];
            $model->validate();

            if (!$model->hasErrors()) {

                // prepare date with time
                $model->dateWithTime();
                $model->save();

                $this->redirect( array( 'view', 'id' => $model->id ) );
            }
        }

        $this->render(
            'update',
            array(
                'model' => $model,
            )
        );
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete( $id )
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel( $id )->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET[ 'ajax' ])) {
                $this->redirect( isset($_POST[ 'returnUrl' ]) ? $_POST[ 'returnUrl' ] : array( 'admin' ) );
            }
        } else {
            throw new CHttpException(400, Yii::t( 'tips', 'Недопустимый запрос. Пожалуйста, не повторяйте этот запрос еще раз.' ));
        }
    }

    public function actionPurchaseDelete( $id )
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            //$this->loadModel($id)->delete();
            Purchase::model()->deleteByPk( $id );

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET[ 'ajax' ])) {
                $this->redirect( isset($_POST[ 'returnUrl' ]) ? $_POST[ 'returnUrl' ] : array( 'admin' ) );
            }
        } else {
            throw new CHttpException(400, Yii::t( 'tips', 'Недопустимый запрос. Пожалуйста, не повторяйте этот запрос еще раз.' ));
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $this->layout = '//layouts/column1';
        $model = new Tips('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET[ 'Tips' ])) {
            $model->attributes = $_GET[ 'Tips' ];
        }

        $this->render(
            'admin',
            array(
                'model' => $model,
            )
        );
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel( $id )
    {
        $model = Tips::model()->findByPk( $id );
        if ($model === null) {
            throw new CHttpException(404, Yii::t( 'tips', 'Запрашиваемая страница не существует.' ));
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation( $model )
    {
        if (isset($_POST[ 'ajax' ]) && $_POST[ 'ajax' ] === 'tips-form') {
            echo CActiveForm::validate( $model );
            Yii::app()->end();
        }
    }
}