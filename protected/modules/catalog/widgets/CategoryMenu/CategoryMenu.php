<?php
/**
 * Created by PhpStorm.
 * User: egoss
 * Date: 29.04.14
 * Time: 17:31
 */

class CategoryMenu extends CWidget
{

    public $category = '';

    public function run()
    {
        $menu  = array();
        $model = CatalogCategory::model()->findByAttributes(array('name' => $this->category));

        if ($model == null) {
            return null;
            //throw new CHttpException(400, Yii::t('catalog', "Каталог с именем '{$this->category}' не найден."));
        }

        $model = $model->descendants()->findAll();

        foreach ($model AS $item) {
            $menu[] = array('label' => $item->title, 'url' => $item->getUrl());
        }

        $this->getController()->widget('zii.widgets.CMenu',array(
            'htmlOptions' => array('class'=>'main_menu'),
            'items'       => $menu
        ));
    }
}