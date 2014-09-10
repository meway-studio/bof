<?php
/**
 * Class UserCommand

 */

// PHP Error[8]: Undefined index: SERVER_NAME in CHttpRequest.php at line 305
$_SERVER[ 'SERVER_NAME' ] = 'betonfootball.eu';
$_SERVER[ 'HTTP_HOST' ] = 'betonfootball.eu';

Yii::setPathOfAlias( 'cwebroot', '/var/www' );

class UserCommand extends ConsoleCommand
{
    public function actionStat()
    {

        // Статистика по месяцам
        $m = date( 'm' );
        $y = date( 'Y' );

        Yii::import( 'application.modules.tip.extensions.tipsterStats.tipsterStats' );

        // Получить всех типстеров
        $tipsters = User::model()->active()->tipsterRole()->with( 'tipster' )->findAll();

        $pb = 6000;

        $cnt_itr = 0;

        for ($m; $m < 13; $m++) {

            //if($m > date('m')-1 AND $y==date("Y"))
            if ($m > date( 'm' ) AND $y == date( "Y" )) {
                continue;
            }

            $cnt_itr++;

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

            $all[ 'yield' ] = round( $all[ 'profit' ] / $all[ 'stake' ] * 100, 2 );
            $all[ 'desc' ] = $pb . '/' . $all[ 'bank' ];

            // Проверить статистику на этот месяц
            $check = Tipstats::model()->findByAttributes(
                array(
                    'tipster_id' => 0,
                    'month'      => $m,
                    'year'       => $y,
                )
            );

            $model = $check != null ? $check : new Tipstats();
            $model->attributes = $all;
            $model->save();
            if ($model->hasErrors()) {
                print_r( $model->getErrors() );
            }

            /*
            if($check==null){
                $model = new Tipstats();
                $model->attributes = $all;
                $model->save();
                if($model->hasErrors())
                    print_r($model->getErrors());
            }
            */

            print_r( $all );
            echo "ALL BOF - {$m}/{$y}\n";

            $pb = $all[ 'bank' ];
        }

        $this->calcSummaryTipsterStats( $tipsters );

        echo "\nMonth Iteration: " . $cnt_itr . "\n";
    }

    public function actionIndex2()
    {
        $file = Yii::getPathOfAlias( 'application.data' ) . '/test.csv';
        $handle = fopen( $file, "r" );

        while (($data = fgetcsv( $handle, 1000, ";" )) !== false) {
            $this->createUser( $data );
        }
    }

    public function actionSubexp( $day = 1, $userId = false, $lang = false )
    {
        $this->subExp( $day, $userId, $lang );
    }

    protected function subExp( $day = 7, $userId = false, $lang = false )
    {
        $defaultLang = $lang ? $lang : Yii::app()->language;
        $cr = new CDbCriteria();
        $cr->order = 't.id ASC';

        if ($userId !== false) {
            $cr->compare( 't.id', $userId );
        } else {
            $cr->scopes = array(
                'active',
                'subExp' => array(
                    '(DATEDIFF(FROM_UNIXTIME( sub.expiration_date ), NOW()) - 1) = :day',
                    array( 'day' => $day ),
                )
            );
        }

        $pageSize = 100;
        $countAll = User::model()->count( $cr );
        $countPages = ($countAll - ($countAll % $pageSize)) / $pageSize;
        $countPages += ($countAll % $pageSize) ? 1 : 0;

        echo "\nStart mailing!\n";
        for ($page = 0; $page < $countPages; $page++) {
            $dp = new CActiveDataProvider(new User());
            $dp->criteria = $cr;
            $dp->pagination->pageSize = $pageSize;
            $dp->pagination->currentPage = $page;

            foreach ($dp->getData() as $user) {
                if (!$lang && $user->language) {
                    Yii::app()->language = $user->language;
                }
                echo "\n{$user->id}-|-{$user->ExpDays}";
                $body = $this->renderFile(
                    '/var/www/themes/classic/views/user/mail/' . Yii::app()->language . '/subexp.php',
                    array( 'user' => $user ),
                    true
                );
                $message = new YiiMailMessage;
                $message->setBody( $body, 'text/html' );
                $message->subject = Yii::t( 'user', 'Напоминание об истечении срока подписки' );
                $message->addTo( $user->email );
                $message->setFrom( array( Yii::app()->config->get( 'EMAIL_NOREPLY' ) => Yii::app()->name ) );
                Yii::app()->mail->send( $message );
                Yii::app()->language = $defaultLang;
            }
        }
        echo "\n\nEnd mailing!\n";
    }

    protected function calcSummaryTipsterStats( $tipsters )
    {

        // высчитать правильный профит и елд всем типстерам
        // Получить всех типстеров
        //$tipsters = User::model()->active()->tipsterRole()->with('tipster')->findAll();

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
    }

    protected function createUser( $data )
    {
        echo date( "d-m-Y h:i" ) . "\n";
        //echo "\n".Yii::getPathOfAlias('webroot.themes.classic.views.PreviousTips.mail')."\n";Yii::app()->end();

        //echo "\n".(is_bool($a) ? 'true' : 'false')."\n";Yii::app()->end(); $a = null;

        $model = User::model()->findByAttributes( array( 'email' => $data[ 1 ] ) );

        if ($model != null) {
            echo "User {$model->email} ALREADY added (ExpDays: {$model->ExpDays})\n";
            /*
            var_dump($model->accessViewTips);
            var_dump($model->ExpDays);
            return;
            */
            $this->sendmailWidget( $model );
            return;
        }

        $model = new User('create');
        $model->firstname = $data[ 0 ];
        $model->email = $data[ 1 ];
        $model->password = $model->generatePassword();
        $model->validate();

        if (!$model->hasErrors() AND $model->save()) {
            echo "User {$model->email} added\n";
            $this->sendmailSignup( $model );
        } else {
            echo "ERROR! User {$model->email} not added\n";
        }

        return;
    }

    protected function sendmailSignup( $model )
    {
        // сформировать письмо
        // @todo: Исправить путь
        $body = $this->renderFile(
            '/var/www/themes/classic/views/user/mail/' . Yii::app()->language . '/signup.php',
            array( 'model' => $model ),
            true
        );

        // отправить
        $ymessage = new YiiMailMessage;
        $ymessage->setBody( $body, 'text/html' );
        $ymessage->subject = Yii::t( 'user', 'Registration on' ) . ' ' . Yii::app()->name;
        $ymessage->addTo( $model->email );
        $ymessage->setFrom( array( Yii::app()->config->get( 'EMAIL_NOREPLY' ) => Yii::app()->name ) );

        return Yii::app()->mail->send( $ymessage );
    }

    protected function sendmailWidget( $model )
    {

        // сформировать письмо
        $body = $this->renderFile(
            '/var/www/themes/classic/views/user/mail/' . Yii::app()->language . '/widget.php',
            array( 'model' => $model ),
            true
        );

        // отправить
        $ymessage = new YiiMailMessage;
        $ymessage->setBody( $body, 'text/html' );
        $ymessage->subject = Yii::t( 'user', 'Didgest' ) . ' ' . Yii::app()->name;
        $ymessage->addTo( $model->email );
        $ymessage->setFrom( array( Yii::app()->config->get( 'EMAIL_NOREPLY' ) => Yii::app()->name ) );

        return Yii::app()->mail->send( $ymessage );
    }
}