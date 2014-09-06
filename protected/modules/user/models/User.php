<?php

/**
 * This is the model class for table "{{users}}".
 * The followings are the available columns in table '{{users}}':
 * @property integer $id
 * @property integer $status
 * @property integer $confirm
 * @property integer $create_date
 * @property integer $update_date
 * @property integer $create_ip
 * @property integer $role
 * @property string $email
 * @property string $phone
 * @property string $hash
 * @property string $password
 * @property string $money
 * @property integer $firstname
 * @property string $lastname
 * @property string $middlename
 * @property integer $gender
 * @property integer $birthday
 * @property integer $country_id
 * @property integer $city_id
 * @property string $address
 * @property string $photo
 * @property string $about
 * @property string $has_spam
 * @property string $fast_notice
 * @property string $last_mail
 * @property integer $show_in_statistic
 * @method User showInStatistic()
 * @method User showOutStatistic()
 */
class User extends CActiveRecord
{
    const ROLE_GUEST = 0;
    const ROLE_USER = 1;
    const ROLE_ADMIN = 2;
    const ROLE_TIPSTER = 3;
    const ROLE_MODERATOR = 4;
    const ROLE_MANAGER = 5;
    const  PASS_PATTERN = "/^[\da-zA-Z]{4,16}$/";
    public $temp_password;
    public $city_name;
    public $format_birthday;
    public $update_exp_date;
    public $expiration_date;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
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
        return '{{users}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(

            // defaults
            /*
            array('status, confirm, create_date, update_date, create_ip, role, gender, birthday, country_id, city_id', 'numerical', 'integerOnly'=>true),
            array('email, firstname, lastname, middlename', 'length', 'max'=>50),
            array('hash, password', 'length', 'max'=>32),
            array('money', 'length', 'max'=>10),
            array('address', 'length', 'max'=>250),
            array('photo', 'length', 'max'=>40),
            array('role', 'default', 'value'=>0),
            */

            // mail
            array( 'last_mail', 'safe', 'on' => 'mail' ),
            // create / signup
            array( 'email, password, firstname', 'required', 'on' => 'signup' ),
            array( 'email', 'email', 'on' => 'signup' ),
            array( 'email', 'unique', 'className' => __CLASS__, 'attributeName' => 'email', 'on' => 'signup' ),
            array( 'password', 'length', 'min' => 4, 'max' => 50, 'on' => 'signup' ),
            array( 'phone', 'length', 'max' => 20, 'on' => 'signup' ),
            array( 'has_spam', 'default', 'value' => 1, 'on' => 'signup' ),
            //array('password', 'match', 'pattern'=>self::PASS_PATTERN, 'message'=>Yii::t('user','Пароль должен содержать цифры и заглавные буквы'), 'on'=>'signup'),

            // create / eauth
            array( 'firstname, status', 'required', 'on' => 'eauth' ),
            // confirm
            array( 'password, temp_password, status, confirm', 'safe', 'on' => 'confirm' ),
            // forgot
            array( 'email', 'required', 'on' => 'forgot' ),
            array( 'email', 'email', 'on' => 'forgot' ),
            array( 'email', 'exist', 'attributeName' => 'email', 'className' => __CLASS__, 'on' => 'forgot' ),
            // restore
            array( 'password', 'required', 'on' => 'restore' ),
            array( 'password', 'length', 'min' => 4, 'max' => 50, 'on' => 'restore' ),
            //array('password', 'match', 'pattern'=>self::PASS_PATTERN, 'message'=>Yii::t('user','Пароль должен содержать цифры и заглавные буквы'), 'on'=>'restore'),

            // password
            array( 'temp_password, password', 'required', 'on' => 'password' ),
            array( 'password, temp_password', 'length', 'min' => 4, 'max' => 50, 'on' => 'password' ),
            //array('password, temp_password', 'match', 'pattern'=>self::PASS_PATTERN, 'message'=>Yii::t('user','Пароль должен содержать цифры и заглавные буквы'), 'on'=>'password'),

            // update
            array( 'email, firstname', 'required', 'on' => 'update' ),
            //array('gender', 'in', 'range'=>array(0,1,2), 'on'=>'update'),
            //array('country_id, city_id', 'numerical', 'integerOnly'=>true, 'on'=>'update'),
            array( 'update_exp_date', 'safe', 'on' => 'update' ),
            array( 'fast_notice', 'numerical', 'integerOnly' => true, 'on' => 'update' ),
            array( 'email, firstname', 'length', 'max' => 50, 'on' => 'update' ),
            array( 'phone', 'length', 'max' => 20, 'on' => 'update' ),
            array( 'language', 'length', 'max' => 4 ),
            array( 'email', 'email', 'on' => 'update' ),
            array( 'email', 'unique', 'className' => __CLASS__, 'attributeName' => 'email', 'on' => 'update' ),
            //array('address', 'length', 'max'=>250, 'on'=>'update'),
            array( 'about', 'length', 'max' => 1000, 'on' => 'update' ),
            //array('city_name', 'safe', 'on'=>'update'),
            //array('format_birthday', 'date', 'format'=>'dd-MM-yyyy', 'timestampAttribute'=>'birthday', 'allowEmpty'=>true, 'on'=>'update'),

            // photo
            array( 'photo', 'required', 'on' => 'photo' ),
            // admin_create

            // admin_update
            array( 'email, firstname, phone', 'required', 'on' => 'admin_update' ),
            array( 'update_exp_date', 'safe', 'on' => 'admin_update' ),
            array(
                'role, status, has_spam, fast_notice, confirm, show_in_statistic',
                'numerical',
                'integerOnly' => true,
                'on'          => 'admin_update'
            ),
            array( 'email, firstname', 'length', 'max' => 50, 'on' => 'admin_update' ),
            array( 'phone', 'length', 'max' => 20, 'on' => 'admin_update' ),
            array( 'email', 'email', 'on' => 'admin_update' ),
            array( 'email', 'unique', 'className' => __CLASS__, 'attributeName' => 'email', 'on' => 'admin_update' ),
            array( 'about', 'length', 'max' => 1000, 'on' => 'admin_update' ),
            //array('status, confirm, create_date, update_date, create_ip, role, email, hash, password, money, firstname, lastname, middlename, gender, birthday, country_id, city_id, address, photo, about', 'required'),

            // The following rule is used by search().
            array(
                'id, status, confirm, create_date, update_date, create_ip, role, email, hash, password, money, firstname, lastname, middlename, gender, birthday, country_id, city_id, address, photo, about, expiration_date, language, show_in_statistic',
                'safe',
                'on' => 'search'
            ),
            // The following rule is used by usersearch().
            array(
                'id, status, confirm, create_date, update_date, create_ip, role, email, hash, password, money, firstname, lastname, middlename, gender, birthday, country_id, city_id, address, photo, about, language, show_in_statistic',
                'safe',
                'on' => 'usersearch'
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
            'city'     => array( self::BELONGS_TO, 'City', 'city_id' ),
            'country'  => array( self::BELONGS_TO, 'Country', 'country_id' ),
            'contacts' => array( self::HAS_MANY, 'UserContact', 'user_id' ),
            'settings' => array( self::HAS_ONE, 'UserSettings', 'user_id' ),
            'card'     => array( self::HAS_ONE, 'UsersCreditCard', 'user_id' ),
            'tipster'  => array( self::HAS_ONE, 'Tipsters', 'user_id' ),
            'sub'      => array( self::HAS_ONE, 'UsersSubscription', 'user_id' ),
        );
    }

    public function scopes()
    {
        return array(

            'active'           => array(
                'condition' => 't.status = 1',
            ),
            'tipsterRole'      => array(
                'condition' => 't.role = ' . self::ROLE_TIPSTER,
            ),
            'spamer'           => array(
                'condition' => 't.has_spam = 1 AND t.email!=""',
            ),
            'fast'             => array(
                'condition' => 't.fast_notice = 1',
            ),
            'free'             => array(
                'with'      => array( 'sub' ),
                'condition' => 'expiration_date <' . date( 'U' ),
            ),
            'paid'             => array(
                'with'      => array( 'sub' ),
                'condition' => 'expiration_date >' . date( 'U' ),
            ),
            'showInStatistic'  => array(
                'condition' => 't.show_in_statistic = 1',
            ),
            'showOutStatistic' => array(
                'condition' => 't.show_in_statistic = 0',
            ),
        );
    }

    public function subExp( $date = false, $direction = '>' )
    {
        if ($date !== false) {
            $cr = new CDbCriteria();
            $cr->with = array( 'sub' );
            $cr->condition = "expiration_date {$direction} :expiration_date";
            $cr->params = array( ':expiration_date' => $date );
            $this->dbCriteria->mergeWith( $cr );
        }
        return $this;
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id'                => Yii::t( 'user', 'ID' ),
            'status'            => Yii::t( 'user', 'Статус' ),
            'confirm'           => Yii::t( 'user', 'Акаунт подтвержден' ),
            'create_date'       => Yii::t( 'user', 'Добавлен' ),
            'update_date'       => Yii::t( 'user', 'Обновлен' ),
            'create_ip'         => Yii::t( 'user', 'Ip' ),
            'role'              => Yii::t( 'user', 'Роль' ),
            'email'             => Yii::t( 'user', 'Email' ),
            'phone'             => Yii::t( 'user', 'Телефон' ),
            'hash'              => Yii::t( 'user', 'Хэш' ),
            'password'          => Yii::t( 'user', 'Пароль' ),
            'new_password'      => Yii::t( 'user', 'Новый парорль' ),
            'old_password'      => Yii::t( 'user', 'Старый пароль' ),
            'temp_password'     => Yii::t( 'user', 'Новый парорль' ),
            'money'             => Yii::t( 'user', 'Баланc' ),
            'firstname'         => Yii::t( 'user', 'Имя' ),
            'lastname'          => Yii::t( 'user', 'Фамилия' ),
            'middlename'        => Yii::t( 'user', 'Отчество' ),
            'gender'            => Yii::t( 'user', 'Пол' ),
            'birthday'          => Yii::t( 'user', 'Дата рождения' ),
            'format_birthday'   => Yii::t( 'user', 'Дата рождения' ),
            'country_id'        => Yii::t( 'user', 'Страна' ),
            'city_id'           => Yii::t( 'user', 'Город' ),
            'address'           => Yii::t( 'user', 'Адрес' ),
            'photo'             => Yii::t( 'user', 'Фото' ),
            'about'             => Yii::t( 'user', 'Обзор' ),
            'update_exp_date'   => Yii::t( 'user', 'Обновлен' ),
            'has_spam'          => Yii::t( 'user', 'Подписан' ),
            'fast_notice'       => Yii::t( 'user', 'Уведомления' ),
            'show_in_statistic' => Yii::t( 'user', 'Отображать в статистике' ),
        );
    }

    public static function cryptPassword( $str )
    {
        return md5( Yii::app()->getModule( 'user' )->salt . $str );
    }

    public function getCryptPassword()
    {
        return self::cryptPassword( $this->password );
    }

    public function generatePassword( $number = 8 )
    {
        $arr = array(
            'a',
            'b',
            'c',
            'd',
            'e',
            'f',
            'g',
            'h',
            'i',
            'j',
            'k',
            'l',
            'm',
            'n',
            'o',
            'p',
            'r',
            's',
            't',
            'u',
            'v',
            'x',
            'y',
            'z',
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'G',
            'H',
            'I',
            'J',
            'K',
            'L',
            'M',
            'N',
            'O',
            'P',
            'R',
            'S',
            'T',
            'U',
            'V',
            'X',
            'Y',
            'Z',
            '1',
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9',
            '0',
            '.',
            ',',
            '(',
            ')',
            '[',
            ']',
            '!',
            '?',
            '&',
            '^',
            '%',
            '@',
            '*',
            '$',
            '<',
            '>',
            '/',
            '|',
            '+',
            '-',
            '{',
            '}',
            '`',
            '~'
        );
        // Генерируем пароль
        $pass = "";
        for ($i = 0; $i < $number; $i++) {
            // Вычисляем случайный индекс массива
            $index = rand( 0, count( $arr ) - 1 );
            $pass .= $arr[ $index ];
        }

        return $pass;
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

        $criteria->with = array( 'sub' );
        $criteria->compare( 'sub.expiration_date', $this->expiration_date );

        $criteria->compare( 'id', $this->id );
        $criteria->compare( 'status', $this->status );
        $criteria->compare( 'confirm', $this->confirm );
        $criteria->compare( 'create_date', $this->create_date );
        $criteria->compare( 'update_date', $this->update_date );
        $criteria->compare( 'create_ip', $this->create_ip );
        $criteria->compare( 'email', $this->email, true );
        $criteria->compare( 'hash', $this->hash, true );
        $criteria->compare( 'password', $this->password, true );
        $criteria->compare( 'money', $this->money, true );
        $criteria->compare( 'firstname', $this->firstname, true );
        $criteria->compare( 'lastname', $this->lastname, true );
        $criteria->compare( 'middlename', $this->middlename, true );
        $criteria->compare( 'gender', $this->gender );
        $criteria->compare( 'birthday', $this->birthday );
        $criteria->compare( 'country_id', $this->country_id );
        $criteria->compare( 'city_id', $this->city_id );
        $criteria->compare( 'address', $this->address, true );
        $criteria->compare( 'photo', $this->photo, true );
        $criteria->compare( 'about', $this->about, true );
        $criteria->compare( 'show_in_statistic', $this->show_in_statistic );

        if (Yii::app()->user->isAdmin) {
            $criteria->compare( 'role', $this->role );
        } else {
            $criteria->compare( 'role', self::ROLE_TIPSTER );
        }

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function usersearch()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare( 'id', $this->id );
        $criteria->compare( 'status', $this->status );
        $criteria->compare( 'confirm', $this->confirm );
        $criteria->compare( 'create_date', $this->create_date );
        $criteria->compare( 'update_date', $this->update_date );
        $criteria->compare( 'create_ip', $this->create_ip );
        $criteria->compare( 'role', $this->role );
        $criteria->compare( 'email', $this->email, true );
        $criteria->compare( 'hash', $this->hash, true );
        $criteria->compare( 'password', $this->password, true );
        $criteria->compare( 'money', $this->money, true );
        $criteria->compare( 'firstname', $this->firstname, true );
        $criteria->compare( 'lastname', $this->lastname, true );
        $criteria->compare( 'middlename', $this->middlename, true );
        $criteria->compare( 'gender', $this->gender );
        $criteria->compare( 'birthday', $this->birthday );
        $criteria->compare( 'country_id', $this->country_id );
        $criteria->compare( 'city_id', $this->city_id );
        $criteria->compare( 'address', $this->address, true );
        $criteria->compare( 'photo', $this->photo, true );
        $criteria->compare( 'about', $this->about, true );

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * This is invoked before the record is saved.
     * @return boolean whether the record should be saved.
     */
    protected function beforeSave()
    {

        if (parent::beforeSave()) {

            if ($this->isNewRecord) {
                $this->create_ip = ip2long( Yii::app()->request->userHostAddress );
                $this->hash = md5( uniqid() );
                $this->has_spam = 1;
            }

            return true;
        } else {
            return false;
        }
    }

    public function byRole( $id )
    {
        $this->getDbCriteria()->compare( 'role', $id );
        return $this;
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

    public function getIp()
    {
        return long2ip( $this->create_ip );
    }

    public function getConfirmName()
    {
        return $this->confirm == 1 ? Yii::t( 'user', 'да' ) : Yii::t( 'user', 'нет' );
    }

    public function getGenderList()
    {
        return array(
            0 => Yii::t( 'user', 'Мужской' ),
            1 => Yii::t( 'user', 'Женский' ),
        );
    }

    public function getGenderName()
    {
        $list = $this->GenderList;
        return isset($list[ $this->gender ]) ? $list[ $this->gender ] : Yii::t( 'user', 'Неизвестно' );
    }

    public function getStatusList()
    {
        return array(
            0 => Yii::t( 'user', 'Не активен' ),
            1 => Yii::t( 'user', 'Активен' ),
            2 => Yii::t( 'user', 'Заблокирован' ),
        );
    }

    public function getStatusName()
    {
        $list = $this->StatusList;
        return isset($list[ $this->status ]) ? $list[ $this->status ] : Yii::t( 'user', 'Неизвестно' );
    }

    public function getRoleList()
    {
        return array(
            self::ROLE_GUEST     => Yii::t( 'user', 'Guest' ),
            self::ROLE_USER      => Yii::t( 'user', 'User' ),
            self::ROLE_ADMIN     => Yii::t( 'user', 'Administrator' ),
            self::ROLE_TIPSTER   => Yii::t( 'user', 'Tipster' ),
            self::ROLE_MODERATOR => Yii::t( 'user', 'Moderator' ),
            self::ROLE_MANAGER   => Yii::t( 'user', 'SEO Manager' ),

        );
    }

    public function getRoleName()
    {
        $list = $this->RoleList;
        return isset($list[ $this->role ]) ? $list[ $this->role ] : Yii::t( 'user', 'Неизвестно' );
    }

    public function getAccessRoleList()
    {
        return array(
            self::ROLE_GUEST     => 'guest',
            self::ROLE_USER      => 'user',
            self::ROLE_ADMIN     => 'admin',
            self::ROLE_TIPSTER   => 'tipster',
            self::ROLE_MODERATOR => 'moderator',
            self::ROLE_MANAGER   => 'manager',
        );
    }

    public function getAccessRoleName()
    {
        $list = $this->AccessRoleList;
        return isset($list[ $this->role ]) ? $list[ $this->role ] : 'guest';
    }

    public function getFormatCreateDate()
    {
        return ($this->create_date > 0) ? Yii::app()->dateFormatter->format( "dd.MM.y, HH:mm", $this->create_date ) : Yii::t(
            'user',
            'Неизвестно'
        );
    }

    public function getFormatUpdateDate()
    {
        return ($this->update_date > 0) ? Yii::app()->dateFormatter->format( "dd.MM.y, HH:mm", $this->update_date ) : Yii::t(
            'user',
            'Неизвестно'
        );
    }

    public function getFormatBirthday()
    {
        return ($this->birthday > 0) ? Yii::app()->dateFormatter->format( "dd-MM-yyyy", $this->birthday ) : 0;
    }

    public function getFullName()
    {
        return $this->firstname; //.' '.$this->lastname;
    }

    public function getIsMe()
    {
        return $this->id == Yii::app()->user->id ? true : false;
    }

    public function getIsActive()
    {
        return ($this->status != 1 OR $this->confirm == 0) ? false : true;
    }

    public function getCityName()
    {
        return $this->city != null ? $this->city->Name : '';
    }

    public function getPhotoOriginalPath()
    {
        return Yii::getPathOfAlias( 'webroot.images.user' ) . '/';
    }

    public function getPhotoMediumPath()
    {
        return Yii::getPathOfAlias( 'webroot.images.user.medium' ) . '/';
    }

    public function getPhotoThumbPath()
    {
        return Yii::getPathOfAlias( 'webroot.images.user.thumbnail' ) . '/';
    }

    public function getPhotoOriginal()
    {
        return $this->photo ? '/images/user/' . $this->photo : Yii::app()->theme->baseUrl . '/css/images/menu/no_avatar.png';
    }

    public function getPhotoMedium()
    {
        return $this->photo ? '/images/user/medium/' . $this->photo : Yii::app()->theme->baseUrl . '/css/images/menu/no_avatar.png';
    }

    public function getPhotoThumb()
    {
        return $this->photo ? '/images/user/thumbnail/' . $this->photo : 'https://cdn3.iconfinder.com/data/icons/ballcons/png/classic.png';
    }

    public function getIsTipster()
    {
        return $this->role == self::ROLE_TIPSTER;
    }

    public function getExpDays()
    {

        if ($this->sub == null) {
            return 0;
        }

        $days = round( ($this->sub->expiration_date - date( 'U' )) / (3600 * 24) );

        return $days > 0 ? $days : 0;
    }

    public function getUnscribeHash()
    {
        return self::cryptPassword( $this->email . $this->create_date );
    }

    public function getAccessViewTips()
    {

        if ($this->sub == null) {
            return false;
        }

        if (($this->sub->expiration_date - date( 'U' )) > 0) {
            return true;
        }

        return false;
        //return $this->getExpDays()>0 ? true : false ;
    }

    public function disabledForManager( $field )
    {
        if (Yii::app()->user->isAdmin) {
            return array();
        }

        return !in_array( $field, array( 'meta_k', 'meta_d' ) ) ? array( 'disabled' => 'disabled' ) : array();
    }
}