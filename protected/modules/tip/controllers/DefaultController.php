<?php

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
                    'viewPath' => 'webroot.themes.' . Yii::app()->theme->name . '.views.tip.mail',
                ),
            )
        );
    }

    public function actions()
    {
        return array(
            'upload'   => array(
                'class'     => 'ext.blueimp.FileUploadAction',
                'attribute' => 'cover',
                'filepath'  => 'webroot.images.tips',
                'allowMime' => array( 'image/jpeg', 'image/png', 'image/gif' ),
                'minsize'   => 0,
                'maxsize'   => 1024 * 1024,
            ),
            'redactor' => array(
                'class'     => 'ext.blueimp.FileUploadAction',
                'redactor'  => true,
                'attribute' => 'file',
                'filelink'  => 'filelink',
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
                'allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array(
                    'index',
                    'list',
                    'view',
                    'tipsters',
                    'subscription',
                    'stat',
                    'allStat',
                    'ajaxmore',
                    'NoBetTips',
                    'NbView',
                    'Robokassa'
                ),
                'users'   => array( '*' ),
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array( 'paytip', 'buysubscription', 'cart', 'purchase', 'CartAdd', 'CartDelete', 'singleTable' ),
                'roles'   => array( 'user' ),
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array( 'create', 'update', 'upload', 'delete', 'drafts', 'redactor', 'CreateNb', 'UpdateNb', 'deleteNb' ),
                'roles'   => array( 'tipster' ),
            ),
            array(
                'allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array( 'test', 'MonthStat', 'PaypalConfirm' ),
                'roles'   => array( 'admin' ),
            ),
            array(
                'deny', // deny all users
                'users' => array( '*' ),
            ),
        );
    }

    public function actionTest()
    {

        /*
        $month       = 01;
        $year        = 2014;

        $tipster_id  = 20;

        $d = '01-'.$month.'-'.$year.' 00:00:00';
        $s = strtotime($d);
        $f = strtotime('+1 month -1 day', $s);

        $r = array(
            'tipster_id'   => $tipster_id,
            'month'  => $month,
            'year'   => $year,
            'profit' => 0,
            'yield'  => 0,
            'stake'  => 0,
            'bank'   => 0,
            'count_won'    => 0,
            'count_lost'   => 0,
            'count_void'   => 0,
        );

        // получить все типсы за месяц
        $c = new CDbCriteria();
        $c->addBetweenCondition('event_date', $s, $f);

        if($tipster_id!=0)
            $model     = Tips::model()->published()->closed()->byTipster($tipster_id)->findAll($c);
        else
            $model     = Tips::model()->published()->closed()->findAll($c);

        $r = array(
            'count_won'    => 0,
            'count_lost'   => 0,
            'count_void'   => 0,
        );

        $a = array(
            'stake'  => 0,
            'profit' => 0,
        );

        echo count($model)."\n";

        foreach($model AS $item){
            //echo $item->stake." => ".$item->tempProfit." => ".$item->TipsterName." => ".$item->title." => ".$item->TipResultName."\n";

            SWITCH($item->tip_result){
                CASE Tips::TIP_RESULT_WON:  $r['count_won']++;  break;
                CASE Tips::TIP_RESULT_HALF: $r['count_won']++;  break;
                CASE Tips::TIP_RESULT_LOST: $r['count_lost']++; break;
                CASE Tips::TIP_RESULT_VOID: $r['count_void']++; break;
                CASE Tips::TIP_RESULT_HALF_LOST: $r['count_lost']++; break;
            }

            $a['stake'] += $item->stake;
            $a['profit'] += $item->tempProfit;

        }

        print_r($r);
        print_r($a);

        Yii::app()->end();

        //$model = Tips::model()->findAllByAttributes(array('tipster_id'=>21, 'event_date >'=>strtotime('2013-12-01 00:00:00'), 'event_date <'=>strtotime('2014-01-01 00:00:00')));

        /*
        $model = Yii::app()->db->createCommand()->select('SUM(`stake`) AS `sum`')->from('{{tips}}')->where('tipster_id=:ID', array(':ID'=>461))->queryRow();
        echo $model['sum'];
        Yii::app()->end();
        */

        //$model = Tipsters::model()->findByPk(4);
        //echo $model->wonCount;
        /*
        $allCount = Tips::model()->byTipster(26)->count();
        $wonCount = Tips::model()->byTipster(26)->count('tip_result=:R1 OR tip_result=:R2', array(':R1'=>Tips::TIP_RESULT_WON, ':R2'=>Tips::TIP_RESULT_HALF));

        $winrate = round( $wonCount * 100 / $allCount, 0);

        echo "winrate: {$winrate}";
        echo "<br/>allCount: {$allCount}";
        echo "<br/>wonCount: {$wonCount}<BR />";
        */
        //Yii::app()->end();

        /*
        $model = Tips::model()->findAllByAttributes(array('calculated'=>0));

        echo count($model); Yii::app()->end();

        foreach($model AS $item){
            echo $item->id.' - '.$item->format_event_date."\n";
            $item->save();
        }
        */
        /*
        $session = new CHttpSession;
        $session->open();

        if(!isset($session['weather']) OR (date('U')-$session['weather']['date']>3600) ){

            $location = Yii::app()->geoip->lookupLocation();
            $weather  = Yii::app()->weather->city($location->city);

            $session['location'] = $location;

            $session['weather']  = array(
                'date' => date("U"),
                'data' => $weather->data->current_condition[0]
            );

            echo 'USE API HTTP';

        }else{

            print_r(array(
                $session['location'],
                $session['weather'],
            ));
        }
        */


        // высчитать правильный профит и елд всем типстерам
        // Получить всех типстеров
        $tipsters = User::model()->active()->tipsterRole()->with( 'tipster' )->findAll();

        foreach ($tipsters AS $t) {

            $stat = array(
                'stake'   => 0,
                'profit'  => 0,
                'yield'   => 0,
                'winrate' => 0,
                'odds'    => 0,
            );

            // Получить все закрытые посты
            $posts = Tips::model()->byTipster( $t->id )->published()->closed()->findAll();

            foreach ($posts AS $p) {
                $stat[ 'stake' ] += $p->stake;
                $stat[ 'profit' ] += $p->tempProfit;
                $stat[ 'odds' ] += $p->odds;

                if ($p->tip_result == Tips::TIP_RESULT_WON OR $p->tip_result == Tips::TIP_RESULT_HALF) {
                    $stat[ 'winrate' ]++;
                }
            }

            $count = (count( $posts ) == 0 ? 1 : count( $posts ));

            $stat[ 'winrate' ] = $stat[ 'winrate' ] == 0 ? 1 : $stat[ 'winrate' ];

            //$stat['winrate'] = round( $stat['winrate'] * 100 / ($count), 0);


            // new scheme winrate
            $stat[ 'winrate' ] = round( (($count - ($count - $stat[ 'winrate' ])) / $count) * 100, 0 );

            $stat[ 'odds' ] = round( $stat[ 'odds' ] / $count, 2 );
            //$stat['yield']   = round( ($stat['profit']==0 ? 1 : $stat['profit']) / Tips::BANK * 100 , 2);
            $stat[ 'yield' ] = round( ($stat[ 'profit' ] == 0 ? 1 : $stat[ 'profit' ]) / $stat[ 'stake' ] * 100, 2 );

            $t->tipster->profit = $stat[ 'profit' ];
            $t->tipster->yield = $stat[ 'yield' ];
            $t->tipster->odds = $stat[ 'odds' ];
            $t->tipster->winrate = $stat[ 'winrate' ];

            $status = $t->tipster->save();

            if ($t->tipster->hasErrors()) {
                print_r( $t->tipster->getErrors() );
            }

            echo $t->FullName . ": " . $stat[ 'profit' ] . "/" . $stat[ 'yield' ] . " (saved: " . (int)$status . ")" . "<br />\n";
        }


        //echo date('m');die();

        /*
        // Статистика по месяцам
        $m = 1;
        $y = 2014;

        Yii::import('application.modules.tip.extensions.tipsterStats.tipsterStats');

        // Получить всех типстеров
        $tipsters = User::model()->active()->tipsterRole()->with('tipster')->findAll();

        $pb = 6000;

        for($m=1; $m<13; $m++){

            //if($m > date('m')-1 AND $y==date("Y"))
            if($m > date('m') AND $y==date("Y"))
                continue;

            $all = array(
                'tipster_id'   => 0,
                'month'        => $m,
                'year'         => $y,
                'stake'        => 0,
                'profit'       => 0,
                'yield'        => 0,
                'bank'         => 0,
                'count_won'    => 0,
                'count_lost'   => 0,
                'count_void'   => 0,
                'tipscount'    => 0,
            );

            foreach($tipsters AS $item){

                // Проверить статистику на этот месяц
                $check = Tipstats::model()->findByAttributes(array(
                    'tipster_id' => $item->id,
                    'month'      => $m,
                    'year'       => $y,
                ));


                if($check!=null){
                    //echo "\t Статистика за {$m}-{$y} для {$item->FullName} уже существует\n";
                    //continue;
                }


                // Если не было записей, добавляем
                $stats = new tipsterStats($item->id, $m, $y);
                $model = $check!=null ? $check : new Tipstats();

                $model->attributes = $stats->calc();

                $all['stake']      += $stats->AllStake;
                $all['profit']     += $model->profit;
                $all['yield']      += $model->yield;
                $all['bank']       += $model->bank;
                $all['count_won']  += $model->count_won;
                $all['count_lost'] += $model->count_lost;
                $all['count_void'] += $model->count_void;
                $all['tipscount']  += $model->tipscount;

                print_r($model->attributes);

                if($model->tipscount==0){
                    echo "\tTipster ".$item->FullName." has not tips by {$m}/{$y}\n";
                    continue;
                }


                if(!$model->save())
                    echo "Save Error: ".print_r($model->getErrors(),1);

                echo $item->FullName." - {$m}/{$y}\n";
            }

            $all['yield'] = round($all['profit'] / $all['stake'] * 100, 2);
            $all['desc']  = $pb.'/'.$all['bank'];

            // Проверить статистику на этот месяц
            $check = Tipstats::model()->findByAttributes(array(
                'tipster_id' => 0,
                'month'      => $m,
                'year'       => $y,
            ));

            if($check==null){
                $model = new Tipstats();
                $model->attributes = $all;
                $model->save();
                if($model->hasErrors())
                    print_r($model->getErrors());
            }

            print_r($all);
            echo "ALL BOF - {$m}/{$y}\n";

            $pb = $all['bank'];
        }
        */
    }

    public function actionRobokassa()
    {

        Yii::app()->robokassa->onSuccess = function ( $event ) {

            $model = $event->sender->params[ 'order' ];

            if ($model->status == Purchase::STATUS_NEW) {

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
            }

            //Yii::app()->request->redirect( Yii::app()->createUrl('/tip/default/purchase') );
            Yii::app()->request->redirect( Yii::app()->createUrl( '/site/page', array( 'view' => 'success_pay' ) ) );
        };

        Yii::app()->robokassa->onFail = function ( $event ) {
            //Yii::app()->request->redirect( Yii::app()->createUrl('/tip/default/purchase') );
            Yii::app()->request->redirect( Yii::app()->createUrl( '/site/page', array( 'view' => 'fail_pay' ) ) );
        };

        Yii::app()->robokassa->result();
    }

    public function actionMonthStat()
    {
        // Статистика по месяцам
        $m = 1;
        $y = 2014;

        Yii::import( 'application.modules.tip.extensions.tipsterStats.tipsterStats' );

        // Получить всех типстеров
        $tipsters = User::model()->active()->tipsterRole()->with( 'tipster' )->findAll();

        $pb = 6000;

        for ($m = 1; $m < 13; $m++) {

            //if($m > date('m')-1 AND $y==date("Y"))
            if ($m > date( 'm' ) AND $y == date( "Y" )) {
                continue;
            }

            $all = array(
                'tipster_id' => 0,
                'month'      => $m,
                'year'       => $y,
                'stake'      => 0,
                'profit'     => 0,
                'yield'      => 0,
                'bank'       => 0,
                'count_won'  => 0,
                'count_lost' => 0,
                'count_void' => 0,
                'tipscount'  => 0,
            );

            foreach ($tipsters AS $item) {

                // Проверить статистику на этот месяц
                $check = Tipstats::model()->findByAttributes(
                    array(
                        'tipster_id' => $item->id,
                        'month'      => $m,
                        'year'       => $y,
                    )
                );


                if ($check != null) {
                    //echo "\t Статистика за {$m}-{$y} для {$item->FullName} уже существует\n";
                    //continue;
                    $check->delete();
                    $check = null;
                }


                // Если не было записей, добавляем
                $stats = new tipsterStats($item->id, $m, $y);
                $model = $check != null ? $check : new Tipstats();

                $model->attributes = $stats->calc();

                $all[ 'stake' ] += $stats->AllStake;
                $all[ 'profit' ] += $model->profit;
                $all[ 'yield' ] += $model->yield;
                $all[ 'bank' ] += $model->bank;
                $all[ 'count_won' ] += $model->count_won;
                $all[ 'count_lost' ] += $model->count_lost;
                $all[ 'count_void' ] += $model->count_void;
                $all[ 'tipscount' ] += $model->tipscount;

                print_r( $model->attributes );

                if ($model->tipscount == 0) {
                    echo "\tTipster " . $item->FullName . " has not tips by {$m}/{$y}\n";
                    continue;
                }


                if (!$model->save()) {
                    echo "Save Error: " . print_r( $model->getErrors(), 1 );
                }

                echo $item->FullName . " - {$m}/{$y}\n";
            }

            if ($all[ 'tipscount' ] == 0) {

                $all[ 'yield' ] = 0;
                $all[ 'profit' ] = 0;
            } else {

                $all[ 'yield' ] = round( $all[ 'profit' ] / $all[ 'stake' ] * 100, 2 );
                $all[ 'desc' ] = $pb . '/' . $all[ 'bank' ];
            }

            // Проверить статистику на этот месяц
            $check = Tipstats::model()->findByAttributes(
                array(
                    'tipster_id' => 0,
                    'month'      => $m,
                    'year'       => $y,
                )
            );

            if ($check != null) {
                $check->delete();
                $check = null;
            }

            $model = new Tipstats();
            $model->attributes = $all;
            $model->save();
            if ($model->hasErrors()) {
                print_r( $model->getErrors() );
            }

            print_r( $all );
            echo "ALL BOF - {$m}/{$y}\n";

            $pb = $all[ 'bank' ];
        }
    }

    public function actionAjaxmore( $offset = 0, $tipster = false )
    {

        if (!Yii::app()->request->isAjaxRequest) {
            throw new CHttpException(400, Yii::t( 'tips', 'Неправильный запрос.' ));
        }

        $this->renderPartial( 'ajax_more', array( 'offset' => $offset, 'tipster' => $tipster ) );
    }

    public function actionSingleTable()
    {

        $user = User::model()->findByPk( Yii::app()->user->id );

        if ($user == null OR !$user->AccessViewTips) {
            $this->redirect( array( '/tip/default/buysubscription' ) );
            Yii::app()->end();
        }

        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_ALL_TIPS' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_ALL_TIPS' ), 'description' );
        $this->pageTitle = Yii::t( 'tips', 'Советы' );

        $model = Tips::model()->published()->allActive()->with( 'tipster' );
        $dataProvider = new CActiveDataProvider($model, array( 'pagination' => array( 'pageSize' => 100 ) ));

        $this->render(
            'table',
            array(
                'dataProvider' => $dataProvider,
            )
        );
    }

    public function actionNoBetTips()
    {
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_ALL_TIPS' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_ALL_TIPS' ), 'description' );
        $this->pageTitle = Yii::t( 'tips', 'Советы' );

        $model = NbTips::model()->published()->with( 'tipster' );

        if (Yii::app()->request->getParam('in_running')) {
            $model = $model->inRunning();
        }

        $dataProvider = new CActiveDataProvider($model);

        $this->render(
            'nobettips',
            array(
                'dataProvider' => $dataProvider,
            )
        );
    }

    public function actionNbView( $id )
    {
        // Получить типс
        $model = $this->loadNbModel( $id );

        Yii::app()->clientScript->registerMetaTag( $model->meta_k, 'keywords' );
        Yii::app()->clientScript->registerMetaTag( $model->meta_d, 'description' );
        $this->pageTitle = $model->title;

        // получить ститстику по последним семи типсам
        $tips = Tips::model()->published()->closed()->byTipster( $model->tipster_id )->findAll(
            array( 'order' => 'create_date DESC', 'limit' => 7 )
        );
        $last = array( 'won' => 0, 'lost' => 0, 'void' => 0 );

        foreach ($tips as $item) {
            SWITCH ($item->tip_result) {
                CASE Tips::TIP_RESULT_WON:
                    $last[ 'won' ]++;
                    break;
                CASE Tips::TIP_RESULT_HALF:
                    $last[ 'won' ]++;
                    break;
                CASE Tips::TIP_RESULT_LOST:
                    $last[ 'lost' ]++;
                    break;
                CASE Tips::TIP_RESULT_VOID:
                    $last[ 'void' ]++;
                    break;
            }
        }

        $this->render( 'nb_view', array( 'model' => $model, 'last' => $last ) );
    }

    public function actionPurchase()
    {

        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_PURCHASE' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_PURCHASE' ), 'description' );
        $this->pageTitle = Yii::app()->config->get( 'SITENAME' );

        $model = new Purchase();
        $model->user_id = Yii::app()->user->id;

        $this->render( 'purchase', array( 'model' => $model->history() ) );
    }

    public function actionCart( $confirm = null )
    {

        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_CART' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_CART' ), 'description' );
        $this->pageTitle = Yii::t( 'tips', 'Корзина' );

        $session = new CHttpSession;
        $session->open();

        $tips = isset($session[ 'cart' ]) ? $session[ 'cart' ] : array();

        $c = new CDbCriteria();
        $c->addInCondition( 't.id', $tips );

        $model = Tips::model()->published()->with( 'tipster' )->findAll( $c ); //->active()

        $result = array( 'totalPrice' => 0, 'cart' => array() );

        foreach ($model AS $item) {

            if (!isset($result[ 'cart' ][ $item->tipster_id ][ 'tipster' ])) {
                $result[ 'cart' ][ $item->tipster_id ][ 'tipster' ] = $item->tipster;
            }

            $result[ 'cart' ][ $item->tipster_id ][ 'tips' ][ ] = $item;


            if (!isset($result[ 'cart' ][ $item->tipster_id ][ 'price' ])) {
                $result[ 'cart' ][ $item->tipster_id ][ 'price' ] = 0;
            }

            $result[ 'cart' ][ $item->tipster_id ][ 'price' ] += $item->price;

            if (!isset($result[ 'cart' ][ $item->tipster_id ][ 'ids' ])) {
                $result[ 'cart' ][ $item->tipster_id ][ 'ids' ] = '';
            }

            $result[ 'cart' ][ $item->tipster_id ][ 'ids' ] .= $item->id . ';';

            $result[ 'totalPrice' ] += $item->price;
        }

        if ($confirm == 1) {

            $status = null;

            // Выбор оплаты

            // Создать order
            $model_p = new Purchase();

            if (isset($_POST[ 'Purchase' ])) {

                $model_p->attributes = $_POST[ 'Purchase' ];
                $model_p->user_id = Yii::app()->user->id;
                $model_p->status = 0;
                $model_p->price = $result[ 'totalPrice' ];
                $model_p->type = Purchase::TYPE_ONCE;

                $model_p->validate();

                if (!$model_p->hasErrors()) {

                    $status = $model_p->save();

                    if ($status) {

                        // Добавить ID типсов к заказу
                        foreach ($model AS $item) {
                            $ptip = new PurchaseTips();
                            $ptip->purchase_id = $model_p->id;
                            $ptip->tips_id = $item->id;
                            $ptip->save();
                        }


                        // reset cart
                        $session[ 'cart' ] = array();

                        // sendmail here
                        // ...
                        $user = User::model()->findByPk( Yii::app()->user->id );
                        $model_p = Purchase::model()->findByPk( $model_p->id );

                        $message = new YiiMailMessage(Yii::t( 'user', 'Новый заказ' ) . ' #' . $model_p->id . ' - ' . Yii::app()->name);
                        $message->view = 'new_payment';
                        $message->setBody( array( 'user' => $user, 'model' => $model_p ), 'text/html' );
                        $message->addTo( Yii::app()->config->get( 'EMAIL_PAYMENT' ) );
                        $message->from = array( Yii::app()->config->get( 'EMAIL_NOREPLY' ) => Yii::app()->name );
                        Yii::app()->mail->send( $message );

                        if ($model_p->IsRobokassa) {
                            Yii::app()->robokassa->pay(
                                $model_p->PriceRUR,
                                $model_p->id,
                                CHtml::encode( $model_p->description ),
                                $model_p->user->email,
                                $model_p->IncCurrLabel
                            );
                        }
                    } else {
                        $status = false;
                    }
                } else {

                    $status = false;
                }
            }

            $result[ 'totalPrice' ] =
                Yii::app()->language == 'ru' ? $result[ 'totalPrice' ] * Yii::app()->params->rur_eur : $result[ 'totalPrice' ];

            $this->render(
                'buy_subscription',
                array(
                    'model'    => $model_p,
                    'price'    => $result[ 'totalPrice' ],
                    'status'   => $status,
                    'termDesc' => Yii::t(
                            'tips',
                            Yii::t( 'tips', '{cm} Совет|{cm} Советa|{cm} Советов|{cm} Совета', count( $model ) ),
                            array( '{cm}' => count( $model ) )
                        ),
                )
            );
        } else {

            $this->render( 'cart', array( 'model' => $result ) );
        }
    }

    public function actionCartAdd()
    {

        // Todo: post Only
        $message = '';

        $session = new CHttpSession;
        $session->open();

        if (!isset($session[ 'cart' ])) {
            $session[ 'cart' ] = array();
        }

        $tips_id = Yii::app()->request->getPost( 'tips_id', false );
        $model = Tips::model()->published()->active()->findByPk( $tips_id );

        if ($model != null AND $model->type == Tips::TYPE_PAID) {

            if ($tips_id AND !isset($session[ 'cart' ][ $tips_id ])) {

                $temp = $session[ 'cart' ];
                $temp[ $tips_id ] = $tips_id;
                $session[ 'cart' ] = $temp;

                $message = Yii::t( 'tips', 'Этот совет был успешно добавлен в корзину' );
            } else {
                $message = Yii::t( 'tips', 'Этот совет уже был добавлен ранее' );
            }
        } else {
            $message = Yii::t( 'tips', 'Этот совет не может быть добавлен в корзину' );
        }


        echo CJSON::encode(
            array(
                'count'   => count( $session[ 'cart' ] ),
                'message' => $message,
            )
        );
    }

    public function actionCartDelete( $id )
    {

        $ids = explode( ';', $id );

        $session = new CHttpSession;
        $session->open();

        if (!isset($session[ 'cart' ])) {
            $session[ 'cart' ] = array();
        }

        $temp = array();

        foreach ($session[ 'cart' ] AS $t) {

            if (!in_array( $t, $ids )) {
                $temp[ $t ] = $t;
            }
        }

        $session[ 'cart' ] = $temp;

        $this->redirect( '/tip/default/cart' );
    }

    // гланвая страница
    public function actionIndex()
    {

        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_INDEX' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_INDEX' ), 'description' );
        $this->pageTitle = Yii::app()->config->get( 'SITENAME' );

        $this->render( 'index' );
    }

    // страница Subscription
    public function actionSubscription()
    {

        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_SUBSCRIPTION' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_SUBSCRIPTION' ), 'description' );
        $this->pageTitle = Yii::t( 'tips', 'Подписки' );

        $this->render( 'subscription' );
    }

    // страница Subscription
    public function actionBuySubscription( $term, $success = false )
    {

        $date = 0;
        $price = 0;
        $status = null;

        $termDesc = '';

        SWITCH (strtolower( $term )) {
            CASE 'weekend':
                $date = 7 * 24 * 60 * 60;
                $termDesc = Yii::t( 'themes', 'Неделя подписки' );
                $price = Yii::app()->config->get( 'SUBSCRIPTION_WEEKEND_PRICE' );
                break;
            CASE 'month':
                $date = 30 * 24 * 60 * 60;
                $termDesc = Yii::t( 'themes', '1 месяц подписки' );
                $price = Yii::app()->config->get( 'SUBSCRIPTION_MONTH_PRICE' );
                break;
            CASE '3month':
                $date = 90 * 24 * 60 * 60;
                $termDesc = Yii::t( 'themes', '3 месяца подписки' );
                $price = Yii::app()->config->get( 'SUBSCRIPTION_3MONTH_PRICE' );
                break;
            CASE 'season':
                $date = 240 * 24 * 60 * 60;
                $termDesc = Yii::t( 'themes', '9 месяцев подписки' );
                $price = Yii::app()->config->get( 'SUBSCRIPTION_SEASON_PRICE' );
                break;
        }

        if ($date == 0) {
            throw new CHttpException(400, Yii::t( 'tips', 'Неправильный запрос.' ));
        }

        $model = new Purchase();

        $model->price = $price;

        if (isset($_POST[ 'Purchase' ])) {

            $model->attributes = $_POST[ 'Purchase' ];
            $model->user_id = Yii::app()->user->id;
            $model->status = Purchase::STATUS_NEW;
            $model->price = $price;
            $model->days = $date;
            $model->type = Purchase::TYPE_DATE;

            $model->validate();

            if (!$model->hasErrors()) {

                $status = $model->save();

                // sendmail here
                // ...
                $user = User::model()->findByPk( Yii::app()->user->id );
                $model = Purchase::model()->findByPk( $model->id );

                $message = new YiiMailMessage(Yii::t( 'user', 'Новый заказ' ) . ' #' . $model->id . ' - ' . Yii::app()->name);
                $message->view = 'new_payment';
                $message->setBody( array( 'user' => $user, 'model' => $model ), 'text/html' );
                $message->addTo( Yii::app()->config->get( 'EMAIL_PAYMENT' ) );
                $message->from = /*array(*/
                    Yii::app()->config->get( 'EMAIL_NOREPLY' ) /* => Yii::app()->name)*/
                ;
                Yii::app()->mail->send( $message );

                if ($model->IsRobokassa) {
                    Yii::app()->robokassa->pay(
                        $model->PriceRUR,
                        $model->id,
                        CHtml::encode( $termDesc ),
                        $model->user->email,
                        $model->IncCurrLabel
                    );
                } elseif ($model->isPaypall AND Yii::app()->user->isAdmin) {

                    $this->paypalBuy( $model );
                }
            } else {

                $status = false;
            }
        }

        $this->render(
            'buy_subscription',
            array(
                'term'     => $term,
                'status'   => $status,
                'price'    => $model->ViewPrice,
                'model'    => $model,
                'termDesc' => $termDesc,
            )
        );
    }

    protected function paypalBuy( $oder )
    {
    }

    public function actionStat( $id )
    {

        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_INDEX' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_INDEX' ), 'description' );
        $this->pageTitle = Yii::app()->config->get( 'SITENAME' );

        // получить пользователя с типстерскими данными
        $model = User::model()->with( 'tipster' )->active()->tipsterRole()->findByPk( $id );

        if ($model == null) {
            throw new CHttpException(404, Yii::t( 'tips', 'Совет не найден' ));
        }

        $stats = Tipstats::model()->byTipster( $model->id )->toView()->findAll();

        $chart = array(
            'months' => array(),
            'profit' => array(),
        );

        if (count( $stats ) == 1) {
            $chart[ 'months' ][ ] = $stats[ 0 ]->PrevMonthX;
            $chart[ 'profit' ][ ] = 0;
        }

        foreach (array_reverse( $stats ) AS $item) {
            $chart[ 'months' ][ ] = $item->MonthX;
            $chart[ 'profit' ][ ] = (float)$item->profit;
        }

        $dataProvider = new CActiveDataProvider(Tipstats::model()->byTipster( $model->id )->toGrid(
        ), array( 'pagination' => array( 'pageSize' => Tips::TIP_LAST_COUNT ) ));

        $this->render(
            'tipster_stat',
            array(
                'model'        => $model,
                'chart'        => $chart,
                'dataProvider' => $dataProvider,
            )
        );
    }

    public function actionAllStat()
    {

        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_ALL_STATS' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_ALL_STATS' ), 'description' );
        $this->pageTitle = Yii::t( 'tips', 'Профиль команды BOF' );

        $model = User::model()->byRole( User::ROLE_TIPSTER )->with( 'tipster' )->findAll();

        $count = count( $model );
        $bof = array(
            'name'        => Yii::t( 'tips', 'Команда BOF' ),
            'rank'        => '',
            'comment'     => '',
            'profit'      => 0,
            'stake'       => 0,
            'yield'       => 0,
            'tips'        => 0,
            'winrate'     => 0,
            'odds'        => 0,
            'activeCount' => 0,
        );

        foreach ($model as $item) {

            $allStake = Yii::app()->db->createCommand()->select( 'SUM(`stake`) AS `sum`' )->from( '{{tips}}' )->where(
                'tipster_id=:ID',
                array( ':ID' => $item->id )
            )->queryRow();

            $bof[ 'stake' ] += $allStake[ 'sum' ];
            $bof[ 'profit' ] += $item->tipster->profit;
            $bof[ 'yield' ] += $item->tipster->yield;
            $bof[ 'tips' ] += $item->tipster->tips;
            $bof[ 'winrate' ] += $item->tipster->winrate;
            $bof[ 'odds' ] += $item->tipster->odds;
            $bof[ 'activeCount' ] += $item->tipster->activeCount;
        }

        //echo '<!--BOF Stake: '.$bof['stake'].'; Bof Profit: '.$bof['profit'].'-->';

        $bof[ 'stake' ] = $bof[ 'stake' ] == 0 ? 1 : $bof[ 'stake' ];

        $bof[ 'odds' ] = (round( $bof[ 'odds' ] * 100 / $count )) / 100;
        //$bof['yield']   = round(Tips::BANK / $bof['profit'] * 100, 2);
        $bof[ 'yield' ] = round( $bof[ 'profit' ] / $bof[ 'stake' ] * 100, 2 );
        $bof[ 'winrate' ] = (round( $bof[ 'winrate' ] * 100 / $count )) / 100;


        $stats = Tipstats::model()->byTipster( 0 )->toView()->findAll();

        $chart = array(
            'months' => array(),
            'profit' => array(),
        );

        foreach (array_reverse( $stats ) AS $item) {

            if (!isset($chart[ 'months' ][ $item->MonthX ])) {

                $chart[ 'months' ][ $item->MonthX ] = $item->MonthX;
                $chart[ 'profit' ][ $item->MonthX ] = $item->profit;
            } else {

                $chart[ 'profit' ][ $item->MonthX ] += $item->profit;
            }
        }

        $chart[ 'months' ] = array_values( $chart[ 'months' ] );
        $chart[ 'profit' ] = array_values( $chart[ 'profit' ] );


        $dataProvider = new CActiveDataProvider(Tipstats::model()->byTipster( 0 )->toGrid(
        ), array( 'pagination' => array( 'pageSize' => Tips::TIP_LAST_COUNT ) ));

        $this->render(
            'all_stat',
            array(
                'chart'        => $chart,
                'dataProvider' => $dataProvider,
                'bof'          => $bof,
            )
        );
    }

    /**
     * Lists all published models models.
     */
    public function actionList( $active = null, $tipster = null )
    {

        //$tipster = $tid;

        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_ALL_TIPS' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_ALL_TIPS' ), 'description' );
        $this->pageTitle = Yii::t( 'tips', 'Типс' );

        $user = null;

        if ($tipster != null) {

            $user = User::model()->with( 'tipster' )->byRole( User::ROLE_TIPSTER )->findByPk( $tipster );

            if (!$user) {
                throw new CHttpException(404, Yii::t( 'tips', 'Запрашиваемая страница не существует.' ));
            }
        }

        $model = Tips::model()->published()->with( 'tipster' );
        $model = $tipster == null ? $model : $model->byTipster( $user->id );

        if ($active != null) {
            $model = $active == 1 ? $model->active() : $model->last();
        }

        $dataProvider = new CActiveDataProvider($model);

        $this->render(
            'list',
            array(
                'dataProvider' => $dataProvider,
                'active'       => $active,
                'user'         => $user,
            )
        );
    }

    public function actionDrafts()
    {

        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_DRAFTS' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_DRAFTS' ), 'description' );
        $this->pageTitle = Yii::t( 'tips', 'Мои черновики' );

        $model1 = Tips::model()->byTipster( Yii::app()->user->id )->draft()->with( 'tipster' );
        $dataProvider1 = new CActiveDataProvider($model1);

        $model2 = NbTips::model()->byTipster( Yii::app()->user->id )->draft()->with( 'tipster' );
        $dataProvider2 = new CActiveDataProvider($model2);

        $this->render(
            'drafts',
            array(
                'dataProvider1' => $dataProvider1,
                'dataProvider2' => $dataProvider2,
            )
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView( $id )
    {

        // Получить типс
        $model = $this->loadModel( $id );

        Yii::app()->clientScript->registerMetaTag( $model->MetaKeywords, 'keywords' );
        Yii::app()->clientScript->registerMetaTag( $model->MetaDescription, 'description' );
        $this->pageTitle = $model->MetaTitle;

        // получить ститстику по последним семи типсам
        $tips = Tips::model()->published()->closed()->byTipster( $model->tipster_id )->findAll(
            array( 'order' => 'create_date DESC', 'limit' => 7 )
        );
        $last = array( 'won' => 0, 'lost' => 0, 'void' => 0 );

        foreach ($tips as $item) {
            SWITCH ($item->tip_result) {
                CASE Tips::TIP_RESULT_WON:
                    $last[ 'won' ]++;
                    break;
                CASE Tips::TIP_RESULT_HALF:
                    $last[ 'won' ]++;
                    break;
                CASE Tips::TIP_RESULT_LOST:
                    $last[ 'lost' ]++;
                    break;
                CASE Tips::TIP_RESULT_VOID:
                    $last[ 'void' ]++;
                    break;
            }
        }

        // проверить парава на просмотр
        if (!$model->accessView) {
            //$this->render('access', array('model'=>$model));
            if (Yii::app()->user->isGuest) {
                $this->redirect( array( '/user/default/login' ) );
            } else {
                $this->redirect( array( '/tip/default/cart' ) );
            }
        } else {
            $this->render( 'view', array( 'model' => $model, 'last' => $last ) );
        }
    }

    /**
     * Купить типс
     */
    public function actionPayTip( $id, $success = false )
    {

        // Получить типс
        $model = $this->loadModel( $id );
        $status = null;

        // проверить, стоит ли покупать типс пользователю
        if ($model->accessView) {
            $this->redirect( array( 'view', 'id' => $model->id ) );
        }

        // если получены данные оплаты
        if ($success) {

            // занести в базу информацию о покупке
            $paid = new PaidTips();
            $paid->tip_id = $model->id;
            $paid->user_id = Yii::app()->user->id;

            $status = $paid->save();
        }

        $this->render( 'paytip', array( 'model' => $model, 'status' => $status ) );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {

        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_ADD_TIP' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_ADD_TIP' ), 'description' );
        $this->pageTitle = Yii::t( 'tips', 'Добавить совет' );

        $model = new Tips('create');

        if (isset($_POST[ 'Tips' ])) {
            $model->attributes = $_POST[ 'Tips' ];
            $model->tipster_id = Yii::app()->user->id;
            $model->validate();

            if (!$model->hasErrors()) {

                // prepare date with time
                $model->dateWithTime();

                $model->save();

                Yii::app()->user->setFlash( 'updateSuccess', Yii::t( 'tips', 'Совет успешно добавлен' ) );
                $this->redirect( array( 'update', 'id' => $model->id ) );
            } else {
                Yii::app()->user->setFlash( 'createFailure', Yii::t( 'tips', 'Совет не добавлен' ) );
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
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreateNb()
    {
        $inRunningTip = Yii::app()->request->getQuery( 'in_running', false );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_ADD_TIP' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_ADD_TIP' ), 'description' );

        if ($inRunningTip) {
            $this->pageTitle = Yii::t( 'tips', 'Добавить совет по ходу игры' );
        } else {
            $this->pageTitle = Yii::t( 'tips', 'Добавить совет без ставок' );
        }


        $model = new NbTips('create');

        if (isset($_POST[ 'NbTips' ])) {
            $model->attributes = $_POST[ 'NbTips' ];
            $model->tipster_id = Yii::app()->user->id;
            $model->validate();

            if (!$model->hasErrors()) {

                // prepare date with time
                $model->dateWithTime();
                $model->in_running = $inRunningTip ? 1 : 0;
                $model->save();

                Yii::app()->user->setFlash( 'updateSuccess', Yii::t( 'tips', 'Совет успешно добавлен' ) );
                $this->redirect( array( 'updateNb', 'id' => $model->id ) );
            } else {
                Yii::app()->user->setFlash( 'createFailure', Yii::t( 'tips', 'Совет не добавлен' ) );
            }
        }

        $this->render(
            'create_nb',
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
        $model->scenario = 'create';
        $model->dateWithOutTime();

        if (isset($_POST[ 'Tips' ])) {
            $model->attributes = $_POST[ 'Tips' ];
            $model->validate();

            if (!$model->hasErrors()) {

                // prepare date with time
                $model->dateWithTime();
                $model->save();

                Yii::app()->user->setFlash( 'updateSuccess', Yii::t( 'tips', 'Совет успешно добавлен' ) );
            } else {
                Yii::app()->user->setFlash( 'updateFailure', Yii::t( 'tips', 'Ошибка. Совет не добавлен' ) );
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
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdateNb( $id )
    {
        $model = $this->loadNbModel( $id );
        $model->scenario = 'create';
        $model->dateWithOutTime();

        if (isset($_POST[ 'NbTips' ])) {
            $model->attributes = $_POST[ 'NbTips' ];
            $model->validate();

            if (!$model->hasErrors()) {

                // prepare date with time
                $model->dateWithTime();
                $model->save();

                Yii::app()->user->setFlash( 'updateSuccess', Yii::t( 'tips', 'Совет успешно добавлен' ) );
            } else {
                Yii::app()->user->setFlash( 'updateFailure', Yii::t( 'tips', 'Ошибка. Совет не добавлен' ) );
            }
        }

        $this->render(
            'update_nb',
            array(
                'model' => $model,
            )
        );
    }

    public function actionDelete( $id )
    {

        $model = Tips::model()->findByPk( $id );

        if ($model != null AND $model->AccessManage) {
            $model->delete();
        }

        $this->redirect( Yii::app()->request->urlReferrer );
    }

    public function actionDeleteNb( $id )
    {

        $model = NbTips::model()->findByPk( $id );

        if ($model != null AND $model->AccessManage) {
            $model->delete();
        }

        $this->redirect( Yii::app()->request->urlReferrer );
    }

    public function actionTipsters()
    {

        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_K_STATS_ALL_TIME' ), 'keywords' );
        Yii::app()->clientScript->registerMetaTag( Yii::app()->config->get( 'META_D_STATS_ALL_TIME' ), 'description' );
        $this->pageTitle = Yii::t( 'tips', 'Статистика за все время' );

        $model = User::model()->byRole( User::ROLE_TIPSTER )->with( 'tipster' )->findAll();
        $count = count( $model );
        $bof = array(
            'name'        => Yii::t( 'tips', 'Команда BOF' ),
            'rank'        => '',
            'comment'     => '',
            'profit'      => 0,
            'stake'       => 0,
            'yield'       => 0,
            'tips'        => 0,
            'winrate'     => 0,
            'odds'        => 0,
            'tips'        => 0,
            'activeCount' => 0,
        );

        foreach ($model as $item) {

            $allStake = Yii::app()->db->createCommand()->select( 'SUM(`stake`) AS `sum`' )->from( '{{tips}}' )->where(
                'tipster_id=:ID',
                array( ':ID' => $item->id )
            )->queryRow();

            $bof[ 'stake' ] += $allStake[ 'sum' ];
            $bof[ 'profit' ] += isset($item->tipster) ? $item->tipster->profit : 0;
            $bof[ 'yield' ] += isset($item->tipster) ? $item->tipster->yield : 0;
            $bof[ 'tips' ] += isset($item->tipster) ? $item->tipster->tips : 0;
            $bof[ 'winrate' ] += isset($item->tipster) ? $item->tipster->winrate : 0;
            $bof[ 'odds' ] += isset($item->tipster) ? $item->tipster->odds : 0;
            $bof[ 'activeCount' ] += isset($item->tipster) ? $item->tipster->activeCount : 0;
        }

        $bof[ 'odds' ] = (round( $bof[ 'odds' ] * 100 / $count )) / 100;
        //$bof['yield']   = round(Tips::BANK / $bof['profit'] * 100, 2);
        $bof[ 'yield' ] = round( $bof[ 'profit' ] / $bof[ 'stake' ] * 100, 2 );
        $bof[ 'winrate' ] = (round( $bof[ 'winrate' ] * 100 / $count )) / 100;

        $this->render( 'tipsters', array( 'model' => $model, 'bof' => $bof ) );
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Tips the loaded model
     * @throws CHttpException
     */
    public function loadModel( $id )
    {
        $model = Tips::model()->findByPk( $id );
        if ($model === null) {
            throw new CHttpException(404, Yii::t( 'tips', 'Запрошенная страница не существует.' ));
        }
        return $model;
    }

    public function loadNbModel( $id )
    {
        $model = NbTips::model()->findByPk( $id );
        if ($model === null) {
            throw new CHttpException(404, Yii::t( 'tips', 'Запрошенная страница не существует.' ));
        }
        return $model;
    }
}