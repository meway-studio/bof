<?php

return array(
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => Yii::t('user','Гость'),
        'bizRule' => null,
        'data' => null
    ),
    'user' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => Yii::t('user','Пользователь'),
        'children' => array(
            'guest', // унаследуемся от гостя
        ),
        'bizRule' => null,
        'data' => null
    ),
    'tipster' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => Yii::t('user','Аналитик'),
        'children' => array(
            'user', // унаследуемся от пользователя
        ),
        'bizRule' => null,
        'data' => null
    ),
    'moderator' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => Yii::t('user','Модератор'),
        'children' => array(
            'tipster',
        ),
        'bizRule' => null,
        'data' => null
    ),
	'manager' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => Yii::t('user','SEO Manager'),
        'children' => array(
            'user',
        ),
        'bizRule' => null,
        'data' => null
    ),
	'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => Yii::t('user','Администратор'),
        'children' => array(
            'moderator',
        ),
        'bizRule' => null,
        'data' => null
    ),
);