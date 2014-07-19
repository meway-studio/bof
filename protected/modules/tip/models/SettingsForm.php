<?php

/**
 * SettingsForm class.
 */
class SettingsForm extends CFormModel
{
    public $SUBSCRIPTION_TITLE;
    public $SUBSCRIPTION_TEXT;
    public $SUBSCRIPTION_WEEKEND_TEXT;
    public $SUBSCRIPTION_WEEKEND_PRICE;
    public $SUBSCRIPTION_WEEKEND_PRICE_SAVE;
    public $SUBSCRIPTION_MONTH_TEXT;
    public $SUBSCRIPTION_MONTH_PRICE;
    public $SUBSCRIPTION_MONTH_PRICE_SAVE;
    public $SUBSCRIPTION_3MONTH_TEXT;
    public $SUBSCRIPTION_3MONTH_PRICE;
    public $SUBSCRIPTION_3MONTH_PRICE_SAVE;
    public $SUBSCRIPTION_SEASON_TEXT;
    public $SUBSCRIPTION_SEASON_PRICE;
    public $SUBSCRIPTION_SEASON_PRICE_SAVE;
    public $TRACK_RECORD_TITLE;
    public $TRACK_RECORD_TEXT;
    public $TRACK_RECORD_YEAR;
    public $TRACK_RECORD_TIPSTERS;
    public $TRACK_RECORD_TIPS_GIVER;
    public $TRACK_RECORD_TIPS_COME;
    public $TRACK_RECORD_MEMBERS;
    public $POLLS_TITLE;
    public $POLLS_TEXT;
    public $POLLS_CODE;
    public $SITENAME;
    public $COPYRIGHT;
    public $FOOTER_TEXT;
    public $DEFAULT_TITLE;
    public $DEFAULT_META_K;
    public $DEFAULT_META_D;
    public $ACCOUNT_TEXT;
    public $CONTACT_TITLE;
    public $CONTACT_HEADER;
    public $CONTACT_TEXT;
    public $CONTACT_META_K;
    public $CONTACT_META_D;
    public $CONTACT_MESSAGE_SUCCESS;
    public $CONTACT_MESSAGE_FAILURE;
    public $CONTACT_PHONE;
    public $CONTACT_EMAIL_1;
    public $CONTACT_EMAIL_2;
    public $CONTACT_SKYPE;
    public $ACCOUNT_QIWI;
    public $ACCOUNT_MB;
    public $ACCOUNT_PAYPALL;
    public $MASTERCLASS_EMAIL;

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            array(
                'SUBSCRIPTION_TITLE, SUBSCRIPTION_TEXT, SUBSCRIPTION_WEEKEND_TEXT, SUBSCRIPTION_WEEKEND_PRICE, SUBSCRIPTION_WEEKEND_PRICE_SAVE, SUBSCRIPTION_MONTH_TEXT, SUBSCRIPTION_MONTH_PRICE, SUBSCRIPTION_MONTH_PRICE_SAVE, SUBSCRIPTION_3MONTH_TEXT, SUBSCRIPTION_3MONTH_PRICE, SUBSCRIPTION_3MONTH_PRICE_SAVE, SUBSCRIPTION_SEASON_TEXT, SUBSCRIPTION_SEASON_PRICE, SUBSCRIPTION_SEASON_PRICE_SAVE, TRACK_RECORD_TITLE, TRACK_RECORD_TEXT, TRACK_RECORD_YEAR, TRACK_RECORD_TIPSTERS, TRACK_RECORD_TIPS_GIVER, TRACK_RECORD_TIPS_COME, TRACK_RECORD_MEMBERS, POLLS_TEXT, POLLS_TITLE, POLLS_CODE, SITENAME, COPYRIGHT, FOOTER_TEXT, DEFAULT_TITLE, DEFAULT_META_K, DEFAULT_META_D, ACCOUNT_TEXT, CONTACT_TITLE, CONTACT_HEADER, CONTACT_TEXT, CONTACT_META_K, CONTACT_META_D, CONTACT_MESSAGE_SUCCESS, CONTACT_MESSAGE_FAILURE, CONTACT_PHONE, CONTACT_EMAIL_1, CONTACT_EMAIL_2, CONTACT_SKYPE, ACCOUNT_QIWI, ACCOUNT_MB, ACCOUNT_PAYPALL, MASTERCLASS_EMAIL',
                'safe'
            ),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return array(

            'SUBSCRIPTION_TITLE'              => Yii::t( 'settings', 'Заголовок виджета подписки' ),
            'SUBSCRIPTION_TEXT'               => Yii::t( 'settings', 'Текст виджета подписки' ),
            'SUBSCRIPTION_WEEKEND_TEXT'       => Yii::t( 'settings', 'Комментарий подписки на неделею' ),
            'SUBSCRIPTION_WEEKEND_PRICE'      => Yii::t( 'settings', 'Цена подписки на неделю' ),
            'SUBSCRIPTION_WEEKEND_PRICE_SAVE' => Yii::t( 'settings', 'Экономия при подписке на неделю' ),
            'SUBSCRIPTION_MONTH_TEXT'         => Yii::t( 'settings', 'Комментарий подписки на месяц' ),
            'SUBSCRIPTION_MONTH_PRICE'        => Yii::t( 'settings', 'Цена подписки на месяц' ),
            'SUBSCRIPTION_MONTH_PRICE_SAVE'   => Yii::t( 'settings', 'Экономия при подписке на месяц' ),
            'SUBSCRIPTION_3MONTH_TEXT'        => Yii::t( 'settings', 'Комментарий подписки на 3 месяца' ),
            'SUBSCRIPTION_3MONTH_PRICE'       => Yii::t( 'settings', 'Цена подписки на 3 месяц' ),
            'SUBSCRIPTION_3MONTH_PRICE_SAVE'  => Yii::t( 'settings', 'Экономия при подписке на 3 месяца' ),
            'SUBSCRIPTION_SEASON_TEXT'        => Yii::t( 'settings', 'Комментарий подписки на сезон' ),
            'SUBSCRIPTION_SEASON_PRICE'       => Yii::t( 'settings', 'Цена подписки на сезон' ),
            'SUBSCRIPTION_SEASON_PRICE_SAVE'  => Yii::t( 'settings', 'Экономия при подписке на сезон' ),
            // Track record
            'TRACK_RECORD_TITLE'              => Yii::t( 'settings', 'Заголовок виджета Track Record' ),
            'TRACK_RECORD_TEXT'               => Yii::t( 'settings', 'Текст виджета Track Record' ),
            'TRACK_RECORD_YEAR'               => Yii::t( 'settings', 'Количество лет' ),
            'TRACK_RECORD_TIPSTERS'           => Yii::t( 'settings', 'Количество типстеров' ),
            'TRACK_RECORD_TIPS_GIVER'         => Yii::t( 'settings', 'Всего типсов' ),
            'TRACK_RECORD_TIPS_COME'          => Yii::t( 'settings', 'Процент успешных типсов' ),
            'TRACK_RECORD_MEMBERS'            => Yii::t( 'settings', 'Пользователи заработали' ),
            // Опросы
            'POLLS_TITLE'                     => Yii::t( 'settings', 'Заголовок опросов' ),
            'POLLS_TEXT'                      => Yii::t( 'settings', 'Текст опросов' ),
            'POLLS_CODE'                      => Yii::t( 'settings', 'Код опросов' ),
            //
            'SITENAME'                        => Yii::t( 'settings', 'Название сайта' ),
            'COPYRIGHT'                       => Yii::t( 'settings', 'Копирайт' ),
            'FOOTER_TEXT'                     => Yii::t( 'settings', 'Текст в футере' ),
            'DEFAULT_TITLE'                   => Yii::t( 'settings', 'Заголовок страницы по умолчанию' ),
            'DEFAULT_META_K'                  => Yii::t( 'settings', 'Ключевые слова по умолчанию' ),
            'DEFAULT_META_D'                  => Yii::t( 'settings', 'Ключевое описание по умолчанию' ),
            'ACCOUNT_TEXT'                    => Yii::t( 'settings', 'Текст на странице профиля пользователя' ),
            'CONTACT_TITLE'                   => Yii::t( 'settings', 'Заголовок страницы контактов' ),
            'CONTACT_HEADER'                  => Yii::t( 'settings', 'Шапка на странице контактов' ),
            'CONTACT_TEXT'                    => Yii::t( 'settings', 'Текст на странице контактов' ),
            'CONTACT_META_K'                  => Yii::t( 'settings', 'Ключевые слова страницы контактов' ),
            'CONTACT_META_D'                  => Yii::t( 'settings', 'Ключевое описание страницы контактов' ),
            'CONTACT_MESSAGE_SUCCESS'         => Yii::t( 'settings', 'Сообщение при успешной отправке контактной формы' ),
            'CONTACT_MESSAGE_FAILURE'         => Yii::t( 'settings', 'Сообщение при ошибках в контактной формы' ),
            'CONTACT_PHONE'                   => Yii::t( 'settings', 'Телефон' ),
            'CONTACT_EMAIL_1'                 => Yii::t( 'settings', 'Email #1' ),
            'CONTACT_EMAIL_2'                 => Yii::t( 'settings', 'Email #2' ),
            'CONTACT_SKYPE'                   => Yii::t( 'settings', 'Skype' ),
            'ACCOUNT_QIWI'                    => Yii::t( 'settings', 'Qiwi account' ),
            'ACCOUNT_MB'                      => Yii::t( 'settings', 'MoneyBookers account' ),
            'ACCOUNT_PAYPALL'                 => Yii::t( 'settings', 'PayPall account' ),
            'MASTERCLASS_EMAIL'               => Yii::t( 'settings', 'E-mail для мастер классов' ),
        );
    }
}