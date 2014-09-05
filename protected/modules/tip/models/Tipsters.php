<?php

/**
 * This is the model class for table "{{tipsters}}".
 * The followings are the available columns in table '{{tipsters}}':
 * @property integer $id
 * @property integer $user_id
 * @property string $rank
 * @property string $comment
 * @property string $profile
 * @property integer $stats
 * @property integer $tips
 * @property integer $articles
 * @property string $profit
 * @property string $yield
 * @property string $winrate
 * @property string $odds
 * @property string $bank
 * @property string $count_active
 * @property string $count_won
 * @property string $count_void
 * @property string $count_lost
 * @property string $editor
 * @property string $bet_on
 * @property string $best_odds
 * @property string $stake
 * @property string $meta_k
 * @property string $meta_d
 * @property integer $sort
 */
class Tipsters extends CActiveRecord
{
    //public $activeCount = 0;
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Tipsters the static model class
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
        return '{{tipsters}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            // disable on console
            //array('rank, comment', 'required'),
            array( 'rank, comment', 'length', 'max' => 250 ),
            array( 'profile', 'length', 'max' => 8000 ),
            array(
                'user_id, stats, tips, articles, count_active, count_won, count_void, count_lost, editor, sort',
                'numerical',
                'integerOnly' => true
            ),
            array( 'profit, yield, winrate, odds, bank', 'length', 'max' => 10 ),
            array( 'meta_k, meta_d', 'length', 'max' => 250 ),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array( 'id, user_id, rank, comment, stats, tips, articles, profit, yield, winrate, odds, sort', 'safe', 'on' => 'search' ),
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
            'posts' => array( self::HAS_MANY, 'Tips', 'tipster_id' ),
            'user'  => array( self::BELONGS_TO, 'Users', 'user_id' ),
            //'activeCount' => array(self::STAT, 'Tips', 'me_tips(tipster_id)'), //, 'condition' => 'event_date+(120*60) > UNIX_TIMESTAMP()'
            /*
            'wonCount'    => array(self::STAT, 'Tips', 'me_tips(tipster_id, user_id)'), // , 'condition' => '(t.tip_result='.Tips::TIP_RESULT_HALF.' OR t.tip_result='.Tips::TIP_RESULT_WON.')'
            */
        );
    }

    public function getActiveCount()
    {
        $count = Yii::app()->db->createCommand()->select( 'COUNT(*) AS `c`' )->from( '{{tips}}' )->where(
            'tipster_id=:ID AND calculated=0 AND status=:S',
            array( ':ID' => $this->user_id, ':S' => Tips::STATUS_ACTIVE )
        )->queryRow();

        return $count ? $count[ 'c' ] : 0;
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'           => Yii::t( 'tipsters', 'ID' ),
            'user_id'      => Yii::t( 'tipsters', 'Пользователь' ),
            'rank'         => Yii::t( 'tipsters', 'Разряд' ),
            'comment'      => Yii::t( 'tipsters', 'Комментарий' ),
            'stats'        => Yii::t( 'tipsters', 'Статистика' ),
            'tips'         => Yii::t( 'tipsters', 'Советов' ),
            'articles'     => Yii::t( 'tipsters', 'Статей' ),
            'profit'       => Yii::t( 'tipsters', 'Выиграл' ),
            'yield'        => Yii::t( 'tipsters', 'Потерял' ),
            'winrate'      => Yii::t( 'tipsters', 'Побед' ),
            'odds'         => Yii::t( 'tipsters', 'Шансы' ),
            'bank'         => Yii::t( 'tipsters', 'Банк' ),
            'editor'       => Yii::t( 'tipsters', 'Редактор' ),
            'meta_k'       => Yii::t( 'tipsters', 'Meta Keywords' ),
            'meta_d'       => Yii::t( 'tipsters', 'Meta Description' ),
            'profile'      => Yii::t( 'tipsters', 'Профиль' ),
            'count_active' => Yii::t( 'tipsters', 'Активных советов' ),
            'sort'         => Yii::t( 'tipsters', 'Сортировка' ),
        );
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

        $criteria->compare( 'id', $this->id );
        $criteria->compare( 'user_id', $this->user_id );
        $criteria->compare( 'rank', $this->rank, true );
        $criteria->compare( 'comment', $this->comment, true );
        $criteria->compare( 'stats', $this->stats );
        $criteria->compare( 'tips', $this->tips );
        $criteria->compare( 'articles', $this->articles );
        $criteria->compare( 'profit', $this->profit, true );
        $criteria->compare( 'yield', $this->yield, true );
        $criteria->compare( 'winrate', $this->winrate, true );
        $criteria->compare( 'odds', $this->odds, true );
        $criteria->compare( 'sort', $this->sort );

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function sort( $direction = 'ASC' )
    {
        if ($direction) {
            $cr = new CDbCriteria();
            $cr->order = "tipster.sort {$direction}";
            $this->dbCriteria->mergeWith( $cr );
        }
        return $this;
    }
}