<?php
/**
 * GuidlineMenu class file.
 *
 * @author egoss <dev@egoss.ru>
 */

class GuidlineMenu extends CWidget
{

	public function run(){
		$this->getController()->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>Yii::t('GuidlineContent', 'Руководство пользователя'), 'url'=> array('/site/page','view'=>'manual'), 'linkOptions'=>array('class'=>'')),
				array('label'=>Yii::t('GuidlineContent', '12 золотых правил'), 'url'=> array('/guidline/default/index'), 'linkOptions'=>array('class'=>'')),
				array('label'=>Yii::t('GuidlineContent', 'Как это работает и как это использовать'), 'url'=> array('/site/page','view'=>'how'), 'linkOptions'=>array('class'=>'')),
				array('label'=>Yii::t('GuidlineContent', 'Почему вы выбрали BOF'), 'url'=> array('/site/page','view'=>'choose'), 'linkOptions'=>array('class'=>'')),
				array('label'=>Yii::t('GuidlineContent', 'Статьи'), 'url'=> array('/catalog/category/view','name'=>'articles'), 'linkOptions'=>array('class'=>'')),
				//array('label'=>'F.A.Q.', 'url'=> array('/site/page','view'=>'faq'), 'linkOptions'=>array('class'=>'')),
			),
		));
	}

}