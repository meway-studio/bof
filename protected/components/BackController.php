<?php

/**
 * Created by PhpStorm.
 * User: egoss
 * Date: 12.03.14
 * Time: 18:40
 */
class BackController extends CController
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column3';
    public $sidebar = '';
    public $menu = array();
    public $breadcrumbs = array();

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
                'allow',
                'actions' => array(),
                'roles' => array( 'admin' ),
            ),
            array(
                'deny', // deny all users
                'users' => array( '*' ),
            ),
        );
    }

    public function init()
    {
        Yii::app()->theme = 'bootstrap';
        Yii::app()->setComponents(
            array(
                'bootstrap' => array(
                    'class' => 'bootstrap.components.Bootstrap',
                )
            )
        );
    }
}