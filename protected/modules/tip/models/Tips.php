<?php

/**
 * This is the model class for table "{{tips}}".
 * The followings are the available columns in table '{{tips}}':
 * @property integer $id
 * @property integer $status
 * @property integer $type
 * @property integer $bod
 * @property string $price
 * @property integer $create_date
 * @property integer $update_date
 * @property integer $event_date
 * @property integer $tipster_id
 * @property string $club_1
 * @property string $flag_1
 * @property string $club_2
 * @property string $flag_2
 * @property string $bet_on
 * @property string $bookmaker
 * @property string $league
 * @property string $description
 * @property string $content
 * @property string $cover
 * @property string $selection
 * @property string $selection_num
 * @property float $odds
 * @property float $stake
 * @property string $c_profit
 * @property float $profit
 * @property float $yield
 * @property integer $tip_result
 * @property string $match_result
 * @property string $bank_was
 * @property string $meta_k
 * @property string $meta_d
 * @property integer $calculated
 * @property User $tipster
 * @property float $tempProfit
 * @method Tips published()
 * @method Tips draft()
 * @method Tips bodtips()
 * @method Tips active()
 * @method Tips onStatPage()
 * @method Tips allActive()
 * @method Tips soon()
 * @method Tips last()
 * @method Tips free()
 * @method Tips paid()
 * @method Tips closed()
 */
class Tips extends CActiveRecord
{
    const BOD_NO = 0;
    const BOD_YES = 1;
    const TYPE_FREE = 0;
    const TYPE_PAID = 1;
    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;
    const TIP_RESULT_DRAW = 0;
    const TIP_RESULT_VOID = 1;
    const TIP_RESULT_WON = 2;
    const TIP_RESULT_LOST = 3;
    const TIP_RESULT_HALF = 4;
    const TIP_RESULT_HALF_LOST = 5;
    const BOOKMAKER_BETFAIR = 1;
    const BOOKMAKER_SBOBET = 2;
    const BOOKMAKER_BET365 = 3;
    const BOOKMAKER_PINNACLE = 4;
    const TIP_LAST_COUNT = 7;
    const BANK = 1000;
    public $format_event_date;
    public $format_event_date_only;
    public $format_create_date;
    public $format_update_date;
    public $count_won;
    public $count_void;
    public $count_lost;
    public $event_h;
    public $event_m;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Tips the static model class
     */
    public static function model( $className = __CLASS__ )
    {
        return parent::model( $className );
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{tips}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            /*
            array('status, type, price, create_date, update_date, event_date, tipster_id, club_1, flag_1, club_2, flag_2, description, content, cover, selection, selection_num, odds, stake, profit, tip_result, match_result', 'required'),
            array('status, type, create_date, update_date, event_date, tipster_id, tip_result', 'numerical', 'integerOnly'=>true),
            array('price, selection, odds, profit', 'length', 'max'=>10),
            array('club_1, club_2', 'length', 'max'=>100),
            array('flag_1, flag_2, cover, stake', 'length', 'max'=>50),
            array('match_result', 'length', 'max'=>20),
            */

            // create
            array(
                'status, type, club_1, flag_1, club_2, flag_2, description, content, selection, odds, stake,tipster_id',
                'required',
                'on' => 'create'
            ),
            array(
                'status, type, tip_result, bet_on, calculated, event_h, event_m, bod, bookmaker',
                'numerical',
                'integerOnly' => true,
                'on'          => 'create'
            ),
            array( 'format_event_date', 'date', 'allowEmpty' => false, 'format' => 'dd/MM/yyyy', 'on' => 'create' ),
            array( 'price, odds, c_profit, profit, bank_was, yield', 'length', 'max' => 10, 'on' => 'create' ),
            array( 'club_1, club_2, selection', 'length', 'max' => 100, 'on' => 'create' ),
            array( 'flag_1, flag_2, stake, cover', 'length', 'max' => 50, 'on' => 'create' ),
            array( 'league, meta_k, meta_d', 'length', 'max' => 250, 'on' => 'create' ),
            array( 'match_result, event_date', 'length', 'max' => 20, 'on' => 'create' ),
            array( 'selection_num', 'length', 'max' => 5, 'on' => 'create' ),
            //seo
            array( 'meta_k, meta_d', 'length', 'max' => 250, 'on' => 'seo' ),
            // import
            array( 'status, type, club_1, club_2, bet_on, selection, odds, tipster_id', 'required', 'on' => 'import' ),
            array(
                'status, type, tip_result, bet_on, calculated, tipster_id, event_date, create_date',
                'numerical',
                'integerOnly' => true,
                'on'          => 'import'
            ),
            array( 'price, odds, profit, bank_was, yield', 'length', 'max' => 10, 'on' => 'import' ),
            array( 'club_1, club_2, selection', 'length', 'max' => 100, 'on' => 'import' ),
            array( 'flag_1, flag_2, stake, cover', 'length', 'max' => 50, 'on' => 'import' ),
            array( 'league', 'length', 'max' => 250, 'on' => 'import' ),
            array( 'description, content', 'length', 'max' => 8000, 'on' => 'import' ),
            array( 'match_result', 'length', 'max' => 20, 'on' => 'import' ),
            array( 'selection_num', 'length', 'max' => 5, 'on' => 'import' ),
            // update

            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'id, status, type, price, create_date, update_date, event_date, tipster_id, club_1, flag_1, club_2, flag_2, description, content, cover, selection, odds, stake, profit, tip_result, match_result',
                'safe',
                'on' => 'search'
            ),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'tipster' => array( self::BELONGS_TO, 'User', 'tipster_id' ),
        );
    }

    public function scopes()
    {
        return array(
            'published'  => array(
                'condition' => 't.status=1',
                'order'     => 't.event_date DESC',
            ),
            'draft'      => array(
                'condition' => 't.status=0',
                'order'     => 't.event_date DESC',
            ),
            'bodtips'    => array(
                'condition' => '( (t.event_date+(120*60)) > UNIX_TIMESTAMP() ) AND ( t.create_date < (t.event_date-3600) ) AND (t.bod!=0)',
                'order'     => 't.event_date DESC',
            ),
            'active'     => array(
                'condition' => '( (t.event_date+(120*60)) > UNIX_TIMESTAMP() ) AND ( t.create_date < (t.event_date-3600) ) AND (t.bod=0)',
                'order'     => 't.event_date DESC',
            ),
            'onStatPage' => array(
                'condition' => '( (t.event_date+(120*60)) > UNIX_TIMESTAMP() )',
                'order'     => 't.event_date DESC',
            ),
            'allActive'  => array( // alias for onStatPage
                'condition' => '( (t.event_date+(120*60)) > UNIX_TIMESTAMP() )',
                'order'     => 't.event_date DESC',
            ),
            'soon'       => array(
                'condition' => '( (t.event_date+(120*60)) > UNIX_TIMESTAMP() ) AND ( t.create_date > (t.event_date-3600) ) AND (t.bod=0)',
                'order'     => 't.event_date DESC',
            ),
            'last'       => array(
                'condition' => 't.event_date+(120*60) < UNIX_TIMESTAMP()',
                'order'     => 't.event_date DESC',
            ),
            'free'       => array(
                'condition' => 't.type=0',
                'order'     => 't.event_date DESC',
            ),
            'paid'       => array(
                'condition' => 't.type=1',
                'order'     => 't.event_date DESC',
            ),
            'closed'     => array(
                'condition' => 't.calculated=1',
                'order'     => 't.event_date DESC',
            ),

        );
    }

    public function byTipster( $id )
    {
        $this->getDbCriteria()->compare( 'tipster_id', $id );
        return $this;
    }

    public function setOffset( $offset )
    {
        $this->getDbCriteria()->offset = $offset;
        return $this;
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'                => Yii::t( 'tips', 'ID' ),
            'status'            => Yii::t( 'tips', 'Статус' ),
            'type'              => Yii::t( 'tips', 'Платная' ),
            'bod'               => Yii::t( 'tips', 'Ставка дня' ),
            'price'             => Yii::t( 'tips', 'Цена' ),
            'create_date'       => Yii::t( 'tips', 'Создан' ),
            'update_date'       => Yii::t( 'tips', 'Обновлен' ),
            'event_date'        => Yii::t( 'tips', 'Дата события' ),
            'tipster_id'        => Yii::t( 'tips', 'Автор' ),
            'club_1'            => Yii::t( 'tips', 'Команда 1' ),
            'flag_1'            => Yii::t( 'tips', 'Флаг' ),
            'club_2'            => Yii::t( 'tips', 'Команда 2' ),
            'flag_2'            => Yii::t( 'tips', 'Флаг' ),
            'bet_on'            => Yii::t( 'tips', 'Ставка на' ),
            'league'            => Yii::t( 'tips', 'Лига' ),
            'description'       => Yii::t( 'tips', 'Краткое описание' ),
            'content'           => Yii::t( 'tips', 'Предварительный просмотр' ),
            'cover'             => Yii::t( 'tips', 'Картинка' ),
            'selection'         => Yii::t( 'tips', 'Выбор' ),
            'selection_num'     => Yii::t( 'tips', 'Выбрать' ),
            'selectionf'        => Yii::t( 'tips', 'Выборать (только рисунок)' ),
            'odds'              => Yii::t( 'tips', 'Шансы' ),
            'stake'             => Yii::t( 'tips', 'Доля' ),
            'profit'            => Yii::t( 'tips', 'Прибыль' ),
            'tip_result'        => Yii::t( 'tips', 'Результат совета' ),
            'match_result'      => Yii::t( 'tips', 'Результат матча' ),
            'bank_was'          => Yii::t( 'tips', 'Банк' ),
            'event_h'           => Yii::t( 'tips', 'Часов' ),
            'event_m'           => Yii::t( 'tips', 'Минут' ),
            'meta_k'            => Yii::t( 'tips', 'Meta Keywords' ),
            'meta_d'            => Yii::t( 'tips', 'Meta Description' ),
            'format_event_date' => Yii::t( 'tips', 'Дата события' ),
        );
    }

    public function getStatusList()
    {
        return array(
            self::STATUS_DRAFT  => Yii::t( 'tips', 'Черновик' ),
            self::STATUS_ACTIVE => Yii::t( 'tips', 'Опубликован' ),

        );
    }

    public function getStatusName()
    {

        foreach ($this->getStatusList() AS $id => $name) {
            if ($this->status == $id) {
                return $name;
            }
        }

        return Yii::t( 'tips', 'Unknown' );
    }

    public function getTipResultList()
    {
        return $this->resultList();
    }

    public static function resultList()
    {
        return array(
            self::TIP_RESULT_DRAW      => Yii::t( 'tips', 'В эфире' ),
            self::TIP_RESULT_WON       => Yii::t( 'tips', 'Победа' ),
            self::TIP_RESULT_HALF      => Yii::t( 'tips', 'Половина победы' ),
            self::TIP_RESULT_HALF_LOST => Yii::t( 'tips', 'Половину потеряли' ),
            self::TIP_RESULT_VOID      => Yii::t( 'tips', 'Возврат ставки' ),
            self::TIP_RESULT_LOST      => Yii::t( 'tips', 'Свободно' ),

        );
    }

    public function getTipResultName()
    {

        foreach ($this->getTipResultList() AS $id => $name) {
            if ($this->tip_result == $id) {
                return $name;
            }
        }

        return Yii::t( 'tips', 'Неизвестно' );
    }

    public function getCoverPath()
    {
        return Yii::getPathOfAlias( 'webroot.images.user' ) . '/';
    }

    public function getCoverOriginal()
    {
        return $this->cover ? '/images/tips/' . $this->cover : Yii::app()->theme->baseUrl . '/css/images/no_avatar.png';
    }

    public function behaviors()
    {

        return array(
            'CTimestampBehavior' => array(
                'class'           => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'create_date',
                'updateAttribute' => 'update_date',
            ),
            'EavARBehavior'      => array(
                'class' => 'application.modules.eav.behaviors.EavARBehavior',
            ),
        );
    }

    /**
     * This is invoked before the record is saved.
     * @return boolean whether the record should be saved.
     */
    protected function beforeSave()
    {

        if (parent::beforeSave()) {

            if ($this->isNewRecord) {

                // пересчитать банк типстера
                $tipster = Tipsters::model()->findByAttributes( array( 'user_id' => $this->tipster_id ) );

                if ($tipster == null) {
                    $tipster = new Tipsters();
                    $tipster->user_id = $this->tipster_id;
                    $tipster->bank = self::BANK;
                    $tipster->save();
                }

                $tipster->tips = $tipster->tips + 1;
                $tipster->save();
            } else {

                $this->calcStatistic();
            }

            return true;
        } else {
            return false;
        }
    }

    protected function afterSave()
    {
        parent::afterSave();

        if ($this->calculated == 1) {

            $allCount = Tips::model()->byTipster( $this->tipster_id )->count();
            $wonCount = Tips::model()->byTipster( $this->tipster_id )->count(
                'tip_result=:R1 OR tip_result=:R2',
                array( ':R1' => Tips::TIP_RESULT_WON, ':R2' => Tips::TIP_RESULT_HALF )
            );

            $allCount = $allCount == 0 ? 1 : $allCount;
            $wonCount = $wonCount == 0 ? 1 : $wonCount;

            $winrate = round( $wonCount * 100 / $allCount, 0 );

            $this->tipster->tipster->winrate = round( $wonCount * 100 / $allCount, 0 );

            // Сумма всех старовок этого типстера
            $odds = Yii::app()->db->createCommand()->select( 'SUM(`odds`) AS `sum`' )->from( '{{tips}}' )->where(
                'tipster_id=:id',
                array( ':id' => $this->tipster_id )
            )->queryRow();

            // Среднее арифметическое значение ставки
            if ($odds[ 'sum' ] != 0) {
                $this->tipster->tipster->odds = round( $odds[ 'sum' ] / $allCount, 2 );
            }

            $this->tipster->tipster->save();
        }
    }

    protected function afterDelete()
    {
        parent::afterDelete();
        --$this->tipster->tipster->tips;
        $this->tipster->tipster->save();
    }

    protected function calcStatistic()
    {
        if ($this->calculated == 1 OR $this->tip_result == self::TIP_RESULT_DRAW) {
            return false;
        }

        $tipster = $this->tipster->tipster;

        // счетчик типсов по результатам
        SWITCH ($this->tip_result) {
            // Победа
            CASE self::TIP_RESULT_WON:
                ++$tipster->count_won;
                $this->profit = $this->stake * $this->odds - $this->stake;
                $this->c_profit = $this->tempProfit;
                break;
            // Половина победы
            CASE self::TIP_RESULT_HALF:
                ++$tipster->count_won;
                $this->profit = ($this->odds * $this->stake - $this->stake) / 2;
                $this->c_profit = $this->tempProfit;
                break;
            // Поражение
            CASE self::TIP_RESULT_LOST:
                ++$tipster->count_lost;
                $this->profit = $this->stake * -1;
                $this->c_profit = $this->tempProfit;
                break;
            // Половина поражения
            CASE self::TIP_RESULT_HALF_LOST:
                ++$tipster->count_lost;
                $this->profit = (($this->stake * -1) / 2);
                $this->c_profit = $this->tempProfit;
                break;
            CASE self::TIP_RESULT_VOID:
                ++$tipster->count_void;
                break;
            default:
                $this->profit = 0;
        }

        $this->bank_was = $tipster->bank - $this->stake;

        // половина победы
        if ($this->tip_result == self::TIP_RESULT_HALF) {

            $tipster->bank += ($this->stake * $this->odds - $this->stake) / 2;
            //$this->yield                    = ($tipster->bank - self::BANK) / (self::BANK/100);
            //$this->profit += ($this->bank_was + (($this->stake * $this->odds - $this->stake) / 2) - self::BANK) + $this->stake;
            //$this->c_profit = $this->tempProfit;

            $this->yield = ($this->c_profit / 2) / $this->stake * 100;
            // победа
        } elseif ($this->tip_result == self::TIP_RESULT_WON) {

            $tipster->bank += ($this->stake * $this->odds - $this->stake);
            //$this->profit += ($this->bank_was + ($this->stake * $this->odds) - self::BANK);
            //$this->yield                    = ($tipster->bank - self::BANK) / (self::BANK/100);
            //$this->c_profit = $this->tempProfit;

            $this->yield = $this->c_profit / $this->stake * 100;
            // поражение
        } elseif ($this->tip_result == self::TIP_RESULT_LOST) {

            $tipster->bank -= $this->stake;
            //$this->profit = $tipster->bank - self::BANK;
            //$this->yield                   = $this->profit / (self::BANK/100);
            //$this->c_profit = $this->tempProfit;

            $this->yield = $this->stake / 100;
            // Половина поражения
        } elseif ($this->tip_result == self::TIP_RESULT_HALF_LOST) {

            $tipster->bank -= $this->stake / 2;
            //$this->profit = $tipster->bank - self::BANK;
            //$this->yield                   = $this->profit / (self::BANK/100);
            //$this->c_profit = $this->tempProfit;

            $this->yield = $this->stake / -2 / 100;
        } elseif ($this->tip_result == self::TIP_RESULT_VOID) {
            //$tipster->bank += $this->stake;
        }

        $stakeSum = Yii::app()->db->createCommand()->select( 'SUM(`stake`) AS `sum`' )->from( '{{tips}}' )->where(
            'tipster_id=:ID',
            array( ':ID' => $this->tipster_id )
        )->queryRow();
        $stakeSum = $stakeSum ? $stakeSum[ 'sum' ] : 0;

        $tipster->profit += $this->c_profit;
        //$tipster->yield  =  $tipster->profit / self::BANK * 100;
        $tipster->yield = $tipster->profit / $stakeSum * 100;

        $this->calculated = 1;

        $return = $tipster->save();
        /*
        if($tipster->hasErrors()){
            print_r($tipster->getErrors());
            Yii::app()->end();
        }
        */
        return $return;
    }

    protected function afterFind()
    {

        $this->format_event_date = Yii::app()->dateFormatter->format( 'dd/MM/yyyy HH:mm', $this->event_date );
        $this->format_event_date_only = Yii::app()->dateFormatter->format( 'dd/MM/yyyy', $this->event_date );
        $this->format_create_date = Yii::app()->dateFormatter->format( 'dd/MM/yyyy HH:mm', $this->create_date );
        $this->format_update_date = Yii::app()->dateFormatter->format( 'dd/MM/yyyy HH:mm', $this->update_date );

        parent::afterFind(); //To raise the event
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->with = array( 'tipster' );

        $criteria->compare( 'id', $this->id );
        $criteria->compare( 't.status', $this->status );
        $criteria->compare( 'type', $this->type );
        $criteria->compare( 'price', $this->price, true );
        $criteria->compare( 'create_date', $this->create_date );
        $criteria->compare( 'update_date', $this->update_date );
        $criteria->compare( 'event_date', $this->event_date );
        $criteria->compare( 'club_1', $this->club_1, true );
        $criteria->compare( 'flag_1', $this->flag_1, true );
        $criteria->compare( 'club_2', $this->club_2, true );
        $criteria->compare( 'flag_2', $this->flag_2, true );
        $criteria->compare( 'description', $this->description, true );
        $criteria->compare( 'content', $this->content, true );
        $criteria->compare( 'cover', $this->cover, true );
        $criteria->compare( 'selection', $this->selection, true );
        $criteria->compare( 'odds', $this->odds, true );
        $criteria->compare( 'stake', $this->stake, true );
        $criteria->compare( 'profit', $this->profit, true );
        $criteria->compare( 'tip_result', $this->tip_result );
        $criteria->compare( 'match_result', $this->match_result, true );

        $criteria->compare( 'tipster.firstname', $this->tipster_id, true, 'OR' );
        $criteria->compare( 'tipster.email', $this->tipster_id, true, 'OR' );

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'     => array(
                'defaultOrder' => 'event_date DESC',
            ),
        ));
    }

    public function getFormatCreateDate()
    {
        return Yii::app()->dateFormatter->format( 'd MMM hh:mm', $this->create_date );
    }

    public function getFormatEventDate()
    {
        return Yii::app()->dateFormatter->format( 'd MMM hh:mm', $this->event_date );
    }

    public function getFormatPrice()
    {
        return $this->isFree ? Yii::t( 'tips', 'Бесплатно' ) : Yii::t(
            'tips',
            '&euro;&nbsp;{price}',
            array( '{price}' => $this->getViewPrice() )
        );
    }

    public function getViewPrice()
    {

        if (Yii::app()->language == 'ru') {
            return $this->price * Yii::app()->params->rur_eur;
        }

        return $this->price;
    }

    public function getIsFree()
    {

        if ($this->type == self::TYPE_FREE) {
            return true;
        }

        if ($this->event_date + 90 * 60 < date( 'U' )) {
            return true;
        }

        return false;
    }

    public function getAccessView()
    {

        // Если просматривает автор
        if ($this->tipster_id == Yii::app()->user->id) {
            return true;
        }

        // Если просматривает модератор или админ
        if (Yii::app()->user->role == User::ROLE_ADMIN OR Yii::app()->user->role == User::ROLE_MODERATOR) {
            return true;
        }

        // Если не бесплатный
        if (!$this->isFree) {

            // Если запрос от авторизованного пользователя
            if (!Yii::app()->user->isGuest) {

                // получить модель пользователя
                $user = User::model()->findByPk( Yii::app()->user->id );

                if ($user == null) {
                    return false;
                }

                // Если пользователь не на подписке
                if ($user->sub == null OR !$user->sub->active) {

                    $paid = PaidTips::model()->findByAttributes( array( 'user_id' => $user->id, 'tip_id' => $this->id ) );

                    // Если пользователь не покупал прогноз
                    if ($paid == null) {

                        return false;
                    } else {

                        return true;
                    }
                }

                return true;
            } else {
                return false;
            }
        }

        return true;
    }

    public function getAccessManage()
    {

        if (Yii::app()->user->isGuest) {
            return false;
        } else {
            if ($this->tipster_id == Yii::app()->user->id) {
                return true;
            } else {
                if (Yii::app()->user->isEditor) {
                    return true;
                } else {
                    if (Yii::app()->user->RoleId == User::ROLE_MODERATOR) {
                        return true;
                    } else {
                        if (Yii::app()->user->RoleId == User::ROLE_ADMIN) {
                            return true;
                        }
                    }
                }
            }
        }

        return false;
    }

    public function getTipResultSpanTag()
    {
        SWITCH ($this->tip_result) {
            CASE self::TIP_RESULT_WON:
                return CHtml::tag( 'span', array( 'class' => 'won' ), Yii::t( 'tips', 'прошел' ) );
                break;

            CASE self::TIP_RESULT_HALF:
                return CHtml::tag( 'span', array( 'class' => 'won' ), Yii::t( 'tips', 'половина' ) );
                break;

            CASE self::TIP_RESULT_LOST:
                return CHtml::tag( 'span', array( 'class' => 'lost' ), Yii::t( 'tips', 'не прошел' ) );
                break;

            CASE self::TIP_RESULT_HALF_LOST:
                return CHtml::tag( 'span', array( 'class' => 'lost' ), Yii::t( 'tips', 'половина' ) );
                break;

            CASE self::TIP_RESULT_VOID:
                return CHtml::tag( 'span', array( 'class' => 'void' ), Yii::t( 'tips', 'расход' ) );
                break;
        }

        return CHtml::tag( 'span', array( 'class' => 'unknow' ), Yii::t( 'tips', 'Неизвестно' ) );
    }

    public function getTipProfitSpanTag()
    {
        SWITCH ($this->tip_result) {
            CASE self::TIP_RESULT_WON:
                return CHtml::tag( 'span', array( 'class' => 'won' ), $this->tempProfit );
                break;

            CASE self::TIP_RESULT_HALF:
                return CHtml::tag( 'span', array( 'class' => 'won' ), $this->tempProfit );
                break;

            CASE self::TIP_RESULT_LOST:
                return CHtml::tag( 'span', array( 'class' => 'lost' ), $this->tempProfit );
                break;

            CASE self::TIP_RESULT_HALF_LOST:
                return CHtml::tag( 'span', array( 'class' => 'lost' ), $this->tempProfit );
                break;

            CASE self::TIP_RESULT_VOID:
                return CHtml::tag( 'span', array( 'class' => 'void' ), $this->tempProfit );
                break;
        }
        return CHtml::tag( 'span', array( 'class' => 'unknow' ), $this->tempProfit );
    }

    public function getBestOdds()
    {

        $model = Yii::app()->db->createCommand()->select( 'MAX(`odds`) AS `best`, `firstname`' )->from( $this->tableName() . ' tp' )->join(
            'me_users u',
            'u.id=tp.tipster_id'
        )->where(
                'event_date=:E AND club_1=:C1 AND club_2=:C2',
                array( ':E' => $this->event_date, ':C1' => $this->club_1, ':C2' => $this->club_2 )
            )->queryRow();

        if (!isset($model[ 'best' ])) {
            return CHtml::tag( 'span', array( 'class' => 'not-found' ), Yii::t( 'tips', 'Нет данных' ) );
        }

        return Yii::t(
            'tips',
            '{odds} {at} {betfair}',
            array(
                '{odds}'    => CHtml::tag( 'span', array( 'class' => 'small-info' ), $model[ 'best' ] ),
                '{name}'    => CHtml::tag( 'span', array(), $model[ 'firstname' ] ),
                '{at}'      => CHtml::tag( 'span', array( 'style' => 'font-size: 16px;' ), '@' ),
                '{betfair}' => CHtml::image( Yii::app()->theme->baseUrl . $this->bookmakerImage, '', array( 'height' => 50 ) ),
            )
        );
    }

    public function getBetOnClub()
    {

        switch ($this->bet_on) {
            CASE 0:
                return $this->selection;
                break;
            CASE 1:
                return $this->club_1;
                break;
            CASE 2:
                return $this->club_2;
                break;
        }
        //return $this->bet_on==1 ? $this->club_1 : $this->club_2;
    }

    public function getTypeList()
    {
        return array(
            self::TYPE_FREE => Yii::t( 'tips', 'Бесплатно' ),
            self::TYPE_PAID => Yii::t( 'tips', 'Платно' ),
        );
    }

    public function getTypeName()
    {
        $list = $this->getTypeList();
        return isset($list[ $this->type ]) ? $list[ $this->type ] : Yii::t( 'tips', 'Неизвестно' );
    }

    public function getTitle()
    {
        return $this->club_1 . ' vs ' . $this->club_2;
    }

    public function getImgFlag1()
    {
        return $this->getFlagImg( $this->flag_1 );
    }

    public function getImgFlag2()
    {
        return $this->getFlagImg( $this->flag_2 );
    }

    protected function getFlagImg( $c )
    {
        return CHtml::tag( 'i', array( 'class' => 'flag ' . ((string)$c) ) );
    }

    public function getTipstersList()
    {
        $model = User::model()->byRole( User::ROLE_TIPSTER )->with( 'tipster' )->findAll();
        return CHtml::listData( $model, 'id', 'FullName' );
    }

    public function getTipResultDisabled()
    {
        return $this->tip_result == self::TIP_RESULT_DRAW ? array() : array( 'disabled' => 'disabled' );
    }

    public function getMatchResult()
    {
        return empty($this->match_result) ? Yii::t( 'tips', 'Неизвестно' ) : $this->match_result;
    }

    public function getTempProfit()
    {
        SWITCH ($this->tip_result) {
            // Победа
            CASE self::TIP_RESULT_WON:
                return $this->odds * $this->stake - $this->stake;
            // Пол победы
            CASE self::TIP_RESULT_HALF:
                return ($this->odds * $this->stake - $this->stake) / 2;
            // Поражение
            CASE self::TIP_RESULT_LOST:
                return $this->stake * -1;
            // Половина поражения
            CASE self::TIP_RESULT_HALF_LOST:
                return (($this->stake * -1) / 2);
            // ...
            CASE self::TIP_RESULT_DRAW:
                return 0;
            default:
                return 0;
        }
    }

    public function getEventHValues()
    {
        return $this->genNums( 24 );
    }

    public function getEventMValues()
    {
        return $this->genNums( 60 );
    }

    public function dateWithTime()
    {
        $tmp = explode( "/", $this->format_event_date );
        $this->event_date = strtotime(
            $tmp[ 2 ] . "-" . $tmp[ 1 ] . "-" . $tmp[ 0 ] . ' ' . $this->event_h . ':' . $this->event_m . ':00'
        );
    }

    public function dateWithOutTime()
    {
        $this->format_event_date = Yii::app()->dateFormatter->format( 'dd/MM/yyyy', $this->event_date );
        $this->event_h = Yii::app()->dateFormatter->format( 'HH', $this->event_date );
        $this->event_m = Yii::app()->dateFormatter->format( 'mm', $this->event_date );
    }

    protected function genNums( $c )
    {
        $result = array();

        for ($i = 0; $i < $c; $i++) {
            $h = strlen( $i ) == 1 ? '0' . $i : $i;
            $result[ $h ] = $h;
        }

        return $result;
    }

    public function getTipResultStr()
    {
        return $this->calculated == 1 ? $this->selection : Yii::t( 'tips', 'Неизвестно' );
    }

    public function getIsClosed()
    {
        return $this->calculated == 1 ? true : false;
    }

    public function getShowResultScore()
    {
        return $this->getIsClosed();
        //return ( $this->calculated==1 AND ($this->event_date+(120*60))>date('U') ) ? true : false;
    }

    public function getSelectionNum()
    {
        return $this->selection_num;
        //return $this->selection_num>0 ? "+".$this->selection_num : $this->selection_num ;
    }

    public function getTeams()
    {
        return require_once Yii::getPathOfAlias( 'application.modules.tip.models.data' ) . DIRECTORY_SEPARATOR . 'teams.php';
    }

    public function disabledForManager( $field )
    {
        if (Yii::app()->user->isAdmin) {
            return array();
        }

        return !in_array( $field, array( 'meta_k', 'meta_d' ) ) ? array( 'disabled' => 'disabled' ) : array();
    }

    public function getTipsterName()
    {
        return $this->tipster == null ? 'UNKNOWN' : $this->tipster->FullName;
    }

    public function getUrl()
    {
        return Yii::app()->createUrl( '/tip/default/view', array( 'id' => $this->id ) );
    }

    public function getMetaKeywords()
    {
        return $this->getMetaDescription();
    }

    public function getMetaDescription()
    {
        return 'Betonfootball ' . $this->getMetaTitle();
    }

    public function getMetaTitle()
    {
        // title= Club vs Club Tip and Preview Date (day month year) from Tipster Country League Football betting tips
        //return $this->club_1.' vs '.$this->club_2.' Tip and Preview '.Yii::app()->dateFormatter->format('dd MMMM yyyy', $this->event_date).' from '.$this->tipster->FullName.' - '.$this->league.' Football betting tips';
        return Yii::t(
            'Tips',
            '{c1} & {c2} Совет и Предварительный просмотр {ed} от {fn} - {leag} Футблольных ставок',
            array(
                '{c1}'   => $this->club_1,
                '{c2}'   => $this->club_2,
                '{ed}'   => Yii::app()->dateFormatter->format( 'dd MMMM yyyy', $this->event_date ),
                '{fn}'   => $this->tipster->FullName,
                '{leag}' => $this->league
            )
        );
    }

    public function getBookmakerImage()
    {

        switch ($this->bookmaker) {
            case self::BOOKMAKER_BETFAIR:
                return '/css/images/betfair_logo.png';
            case self::BOOKMAKER_SBOBET:
                return '/css/images/sb.png';
            case self::BOOKMAKER_BET365:
                return '/css/images/365.png';
            case self::BOOKMAKER_PINNACLE:
                return '/css/images/pin.png';
            default:
                return '/css/images/logo.png';
        }
    }
}