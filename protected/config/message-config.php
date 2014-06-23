<?php
/**
 * Created by PhpStorm.
 * User: egoss
 * Date: 15.05.14
 * Time: 16:38
 */

return array(
    'sourcePath'  => Yii::getPathOfAlias('webroot'),
    'messagePath' => Yii::getPathOfAlias('application.messages'),
    'languages'   => array('ru','en'),
    'fileTypes'   => array('php'),
    'exclude'     => array('assets', 'css', 'images', 'js'),
    'translator'  => 'Yii::t',
);