<?php

/**
 * This is the model class for table "{{nobettips}}".
 * The followings are the available columns in table '{{nobettips}}':
 * @property integer $id
 * @property integer $status
 * @property integer $create_date
 * @property integer $update_date
 * @property integer $event_date
 * @property integer $tipster_id
 * @property string $club_1
 * @property string $flag_1
 * @property string $club_2
 * @property string $flag_2
 * @property string $league
 * @property string $content
 * @property string $cover
 * @property string $meta_k
 * @property string $meta_d
 * @property integer $in_running
 * @property integer $comments
 */
class NbTips extends CActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;
    public $format_event_date;
    public $format_event_date_only;
    public $format_create_date;
    public $format_update_date;
    public $event_h;
    public $event_m;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return NbTips the static model class
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
        return '{{nobettips}}';
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
            array('status, create_date, update_date, event_date, tipster_id, club_1, flag_1, club_2, flag_2, league, content, cover', 'required'),
            array('status, create_date, update_date, event_date, tipster_id', 'numerical', 'integerOnly'=>true),
            array('club_1, club_2', 'length', 'max'=>100),
            array('flag_1, flag_2, cover', 'length', 'max'=>50),
            array('league, meta_k, meta_d', 'length', 'max'=>250),
            */
            array(
                'comments',
                'numerical',
                'integerOnly' => true
            ),

            // create
            array( 'status, club_1, flag_1, club_2, flag_2, content, tipster_id', 'required', 'on' => 'create' ),
            array( 'status, event_h, event_m, in_running, comments', 'numerical', 'integerOnly' => true, 'on' => 'create' ),
            array( 'format_event_date', 'date', 'allowEmpty' => false, 'format' => 'dd/MM/yyyy', 'on' => 'create' ),
            array( 'club_1, club_2', 'length', 'max' => 100, 'on' => 'create' ),
            array( 'flag_1, flag_2, cover', 'length', 'max' => 50, 'on' => 'create' ),
            array( 'league, meta_k, meta_d', 'length', 'max' => 250, 'on' => 'create' ),
            array( 'event_date', 'length', 'max' => 20, 'on' => 'create' ),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'id, status, create_date, update_date, event_date, tipster_id, club_1, flag_1, club_2, flag_2, league, content, cover, meta_k, meta_d, in_running',
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
            'active'     => array(
                'condition' => '( (t.event_date+(120*60)) > UNIX_TIMESTAMP() ) AND ( t.create_date < (t.event_date-3600) )',
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
                'condition' => '( (t.event_date+(120*60)) > UNIX_TIMESTAMP() ) AND ( t.create_date > (t.event_date-3600) )',
                'order'     => 't.event_date DESC',
            ),
            'last'       => array(
                'condition' => 't.event_date+(120*60) < UNIX_TIMESTAMP()',
                'order'     => 't.event_date DESC',
            ),
        );
    }

    public function inRunning( $inRunning = true )
    {
        $this->getDbCriteria()->mergeWith(
            array(
                'condition' => 't.in_running = :in_running',
                'params'    => array( ':in_running' => $inRunning ? 1 : 0 ),
            )
        );
        return $this;
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
            'create_date'       => Yii::t( 'tips', 'Создан' ),
            'update_date'       => Yii::t( 'tips', 'Обнавлен' ),
            'event_date'        => Yii::t( 'tips', 'Дата события' ),
            'tipster_id'        => Yii::t( 'tips', 'Автор' ),
            'club_1'            => Yii::t( 'tips', 'Команда 1' ),
            'flag_1'            => Yii::t( 'tips', 'Флаг' ),
            'club_2'            => Yii::t( 'tips', 'Команда 2' ),
            'flag_2'            => Yii::t( 'tips', 'Флаг' ),
            'league'            => Yii::t( 'tips', 'Лига' ),
            'content'           => Yii::t( 'tips', 'Предварительный просмотр' ),
            'cover'             => Yii::t( 'tips', 'Картинка' ),
            'meta_k'            => Yii::t( 'tips', 'Meta Keywords' ),
            'meta_d'            => Yii::t( 'tips', 'Meta Description' ),
            'format_event_date' => Yii::t( 'tips', 'Дата события' ),
            'event_h'           => Yii::t( 'tips', 'Часы' ),
            'event_m'           => Yii::t( 'tips', 'Минуты' ),
            'in_running'        => Yii::t( 'tips', 'Совет по ходу игры' ),
            'comments'          => Yii::t( 'tips', 'Разрешить комментарии' ),
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

        $criteria->with = array( 'tipster' );

        $criteria->compare( 'id', $this->id );
        $criteria->compare( 'status', $this->status );
        $criteria->compare( 'create_date', $this->create_date );
        $criteria->compare( 'update_date', $this->update_date );
        $criteria->compare( 'event_date', $this->event_date );
        $criteria->compare( 'tipster_id', $this->tipster_id );
        $criteria->compare( 'club_1', $this->club_1, true );
        $criteria->compare( 'flag_1', $this->flag_1, true );
        $criteria->compare( 'club_2', $this->club_2, true );
        $criteria->compare( 'flag_2', $this->flag_2, true );
        $criteria->compare( 'league', $this->league, true );
        $criteria->compare( 'content', $this->content, true );
        $criteria->compare( 'cover', $this->cover, true );
        $criteria->compare( 'meta_k', $this->meta_k, true );
        $criteria->compare( 'meta_d', $this->meta_d, true );
        $criteria->compare( 'comments', $this->comments, true );

        $criteria->compare( 'tipster.firstname', $this->tipster_id, true, 'OR' );
        $criteria->compare( 'tipster.email', $this->tipster_id, true, 'OR' );

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort'     => array(
                'defaultOrder' => 'event_date DESC',
            ),
        ));
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
            )
        );
    }

    protected function afterFind()
    {

        $this->format_event_date = Yii::app()->dateFormatter->format( 'dd/MM/yyyy HH:mm', $this->event_date );
        $this->format_event_date_only = Yii::app()->dateFormatter->format( 'dd/MM/yyyy', $this->event_date );
        $this->format_create_date = Yii::app()->dateFormatter->format( 'dd/MM/yyyy HH:mm', $this->create_date );
        $this->format_update_date = Yii::app()->dateFormatter->format( 'dd/MM/yyyy HH:mm', $this->update_date );

        parent::afterFind(); //To raise the event
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

    public function getFormatCreateDate()
    {
        return Yii::app()->dateFormatter->format( 'd MMM hh:mm', $this->create_date );
    }

    public function getFormatEventDate()
    {
        return Yii::app()->dateFormatter->format( 'd MMM hh:mm', $this->event_date );
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

    public function getTitle()
    {
        return $this->club_1 . ' vs ' . $this->club_2;
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

    public function getPreview()
    {
        return mb_strlen( $this->content ) > 300 ? mb_substr( strip_tags( $this->content ), 0, 300, 'UTF-8' ) . '...' : strip_tags(
            $this->content
        );
    }

    public function getUrl()
    {
        return Yii::app()->createUrl( '/tip/default/NbView', array( 'id' => $this->id ) );
    }
}