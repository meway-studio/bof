<?php

/**
 * MetaForm class.
 */
class MetaForm extends CFormModel
{
	public $META_K_INDEX;
	public $META_K_STATS_ALL_TIME;
	public $META_K_PAGE_ABOUT;
	public $META_K_SUBSCRIPTION;
	public $META_K_CONTACTS;
	public $META_K_GUIDELINE;
	public $META_K_PAGE_TERMS;
	public $META_K_ALL_TIPS;
	public $META_K_ALL_TIPS_0;
	public $META_K_ALL_TIPS_1;
	public $META_K_ALL_STATS;
	public $META_K_PROFILE;
	public $META_K_PURCHASE;
	public $META_K_ADD_TIP;
	public $META_K_DRAFTS;
	public $META_K_CART;
	public $META_D_INDEX;
	public $META_D_STATS_ALL_TIME;
	public $META_D_PAGE_ABOUT;
	public $META_D_SUBSCRIPTION;
	public $META_D_CONTACTS;
	public $META_D_GUIDELINE;
	public $META_D_PAGE_TERMS;
	public $META_D_ALL_TIPS;
	public $META_D_ALL_TIPS_0;
	public $META_D_ALL_TIPS_1;
	public $META_D_ALL_STATS;
	public $META_D_PROFILE;
	public $META_D_PURCHASE;
	public $META_D_ADD_TIP;
	public $META_D_DRAFTS;
	public $META_D_CART;
	public $META_K_LOGIN;
	public $META_K_SIGNUP;
	public $META_K_CONFIRM;
	public $META_K_FORGOT;
	public $META_K_RESTORE;
	public $META_K_UNSCRIBE;
	public $META_D_LOGIN;
	public $META_D_SIGNUP;
	public $META_D_CONFIRM;
	public $META_D_FORGOT;
	public $META_D_RESTORE;
	public $META_D_UNSCRIBE;
	
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('META_K_INDEX, META_K_STATS_ALL_TIME, META_K_PAGE_ABOUT, META_K_SUBSCRIPTION, META_K_CONTACTS, META_K_GUIDELINE, META_K_PAGE_TERMS, META_K_ALL_TIPS, META_K_ALL_TIPS_0, META_K_ALL_TIPS_1, META_K_ALL_STATS, META_K_PROFILE, META_K_PURCHASE, META_K_ADD_TIP, META_K_DRAFTS, META_K_CART, META_D_INDEX, META_D_STATS_ALL_TIME, META_D_PAGE_ABOUT, META_D_SUBSCRIPTION, META_D_CONTACTS, META_D_GUIDELINE, META_D_PAGE_TERMS, META_D_ALL_TIPS, META_D_ALL_TIPS_0, META_D_ALL_TIPS_1, META_D_ALL_STATS, META_D_PROFILE, META_D_PURCHASE, META_D_ADD_TIP, META_D_DRAFTS, META_D_CART, META_K_LOGIN, META_K_SIGNUP, META_K_CONFIRM, META_K_FORGOT, META_K_RESTORE, META_K_UNSCRIBE, META_D_LOGIN, META_D_SIGNUP, META_D_CONFIRM, META_D_FORGOT, META_D_RESTORE, META_D_UNSCRIBE', 'safe'),
		);
	}
	
	public function attributeLabels()
	{
		return array(
			'META_K_INDEX'          => Yii::t('tips', 'Основная'),
			'META_K_STATS_ALL_TIME' => Yii::t('tips', 'Статистика за все время'),
			'META_K_PAGE_ABOUT'     => Yii::t('tips', 'О нас'),
			'META_K_SUBSCRIPTION'   => Yii::t('tips', 'Подписка'),
			'META_K_CONTACTS'       => Yii::t('tips', 'Контакты'),
			'META_K_GUIDELINE'      => Yii::t('tips', 'Гайдлайны'),
			'META_K_PAGE_TERMS'     => Yii::t('tips', 'ПРАВИЛА И УСЛОВИЯ ИСПОЛЬЗОВАНИЯ'),
			'META_K_ALL_TIPS'       => Yii::t('tips', 'Все советы'),
			'META_K_ALL_TIPS_0'     => Yii::t('tips', 'Все последний совет'),
			'META_K_ALL_TIPS_1'     => Yii::t('tips', 'Все активные советы'),
			'META_K_ALL_STATS'      => Yii::t('tips', 'Профиль команды BOF'),
			'META_K_PROFILE'        => Yii::t('tips', 'Профиль'),
			'META_K_PURCHASE'       => Yii::t('tips', 'Покупка'),
			'META_K_ADD_TIP'        => Yii::t('tips', 'Создать совет'),
			'META_K_DRAFTS'         => Yii::t('tips', 'Мои черновики'),
			'META_K_CART'           => Yii::t('tips', 'Корзина'),
			'META_K_LOGIN'          => Yii::t('tips', 'Войти'),
			'META_K_SIGNUP'         => Yii::t('tips', 'Зарегистрироваться'),
			'META_K_CONFIRM'        => Yii::t('tips', 'Подтверждение регистрации'),
			'META_K_FORGOT'         => Yii::t('tips', 'Забыли пароль'),
			'META_K_RESTORE'        => Yii::t('tips', 'Восстановить пароль'),
			'META_K_UNSCRIBE'       => Yii::t('tips', 'Отписаться'),

			'META_D_INDEX'          => Yii::t('tips', 'Основная'),
			'META_D_STATS_ALL_TIME' => Yii::t('tips', 'Статистика за все время'),
			'META_D_PAGE_ABOUT'     => Yii::t('tips', 'О нас'),
			'META_D_SUBSCRIPTION'   => Yii::t('tips', 'Подписка'),
			'META_D_CONTACTS'       => Yii::t('tips', 'Контакты'),
			'META_D_GUIDELINE'      => Yii::t('tips', 'Гайдлайны'),
			'META_D_PAGE_TERMS'     => Yii::t('tips', 'ПРАВИЛА И УСЛОВИЯ ИСПОЛЬЗОВАНИЯ'),
			'META_D_ALL_TIPS'       => Yii::t('tips', 'Все советы'),
			'META_D_ALL_TIPS_0'     => Yii::t('tips', 'Все последний совет'),
			'META_D_ALL_TIPS_1'     => Yii::t('tips', 'Все активные советы'),
			'META_D_ALL_STATS'      => Yii::t('tips', 'Профиль команды BOF'),
			'META_D_PROFILE'        => Yii::t('tips', 'Профиль'),
			'META_D_PURCHASE'       => Yii::t('tips', 'Покупка'),
			'META_D_ADD_TIP'        => Yii::t('tips', 'Создать совет'),
			'META_D_DRAFTS'         => Yii::t('tips', 'Мои черновики'),
			'META_D_CART'           => Yii::t('tips', 'Корзина'),
			'META_D_LOGIN'          => Yii::t('tips', 'Войти'),
			'META_D_SIGNUP'         => Yii::t('tips', 'Зарегистрироваться'),
			'META_D_CONFIRM'        => Yii::t('tips', 'Подтверждение регистрации'),
			'META_D_FORGOT'         => Yii::t('tips', 'Забыли пароль'),
			'META_D_RESTORE'        => Yii::t('tips', 'Восстановить пароль'),
			'META_D_UNSCRIBE'       => Yii::t('tips', 'Отписаться'),
		);
	}
}