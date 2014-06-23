<?php /* @var $this Controller */ 

Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerCoreScript('jquery.ui');
Yii::app()->clientScript->registerCssFile('/themes/bootstrap/css/jquery-ui-1.10.0.custom.css');
//Yii::app()->clientScript->registerCssFile(Yii::app()->clientScript->getCoreScriptUrl() . '/jui/css/base/jquery-ui.css');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
<link rel="stylesheet" type="text/css" href="/themes/classic/css/flags.css" media="screen, projection" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<?php Yii::app()->bootstrap->register(); ?>
</head>

<body>

<?php 
/*
$this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
				array(
					'class'=>'bootstrap.widgets.TbMenu',
					'htmlOptions'=>array('class'=>'pull-left'),
					'items'=>array(
						array('label'=>'Tips',         'url'=>array('/tip/admin/default/admin'), 'visible'=>Yii::app()->user->isManager),
						array('label'=>'Purchase',     'url'=>array('/tip/admin/default/purchase'), 'visible'=>Yii::app()->user->isAdmin),
						array('label'=>'Users',        'url'=>array('/user/admin/default/admin'), 'visible'=>Yii::app()->user->isManager),
						array('label'=>'FeedBack',     'url'=>array('/guidline/admin/default/admin'), 'visible'=>Yii::app()->user->isAdmin),
						array('label'=>'Golden Rules', 'url'=>array('/guidline/admin/content/admin'), 'visible'=>Yii::app()->user->isAdmin),
						array('label'=>'Reviews',      'url'=>array('/user/admin/reviews/admin'), 'visible'=>Yii::app()->user->isAdmin),
						array('label'=>'Mailing',      'url'=>array('/tip/admin/mail/admin'), 'visible'=>Yii::app()->user->isAdmin),
						array('label'=>'Settings',     'url'=>array('/tip/admin/default/settings'), 'visible'=>Yii::app()->user->isAdmin),
						array('label'=>'SEO',          'url'=>array('/tip/admin/default/meta'), 'visible'=>Yii::app()->user->isManager),
						array('label'=>'Login',        'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
						//array('label'=>'Operations',   'url'=>array('/admin/pages/default')),
					),
				),
				array(
					'label'=>Yii::app()->user->name.' ('.Yii::app()->user->role.')', 
					'url'=>'#', 
					'class'=>'bootstrap.widgets.TbMenu',
					'htmlOptions'=>array('class'=>'pull-right'),
					'items' => array(
						array('label'=>'Logout', 'url'=>array('/user/default/logout'), 'visible'=>!Yii::app()->user->isGuest, )),
				),
            ),
        ),
    ),
));
*/
?>
<?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'type'=>null, // null or 'inverse'
    'brand'=>'BOF',
    'brandUrl'=>'/admin',
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
						array('label'=>Yii::t('themes', 'Советы'),         'url'=>array('/tip/admin/default/admin'), 'visible'=>Yii::app()->user->isManager),
						array('label'=>Yii::t('themes', 'Покупки'),     'url'=>array('/tip/admin/default/purchase'), 'visible'=>Yii::app()->user->isAdmin),
						array('label'=>Yii::t('themes', 'Пользователи'),        'url'=>array('/user/admin/default/admin'), 'visible'=>Yii::app()->user->isManager),
						array('label'=>Yii::t('themes', 'Связь'),     'url'=>array('/guidline/admin/default/admin'), 'visible'=>Yii::app()->user->isAdmin),
						array('label'=>Yii::t('themes', 'Правила'), 'url'=>array('/guidline/admin/content/admin'), 'visible'=>Yii::app()->user->isAdmin),
						array('label'=>Yii::t('themes', 'FAQ'),          'url'=>array('/guidline/admin/faq/admin'), 'visible'=>Yii::app()->user->isAdmin),
						array('label'=>Yii::t('themes', 'Отзывы'),      'url'=>array('/user/admin/reviews/admin'), 'visible'=>Yii::app()->user->isAdmin),
						array('label'=>Yii::t('themes', 'Рассылка'),      'url'=>array('/tip/admin/mail/admin'), 'visible'=>Yii::app()->user->isAdmin),
						array('label'=>Yii::t('themes', 'Настройки'),     'url'=>array('/tip/admin/default/settings'), 'visible'=>Yii::app()->user->isAdmin),
						array('label'=>Yii::t('themes', 'СЕО'),          'url'=>array('/tip/admin/default/meta'), 'visible'=>Yii::app()->user->isManager),
						array('label'=>Yii::t('themes', 'Кальк.'),          'url'=>array('/tip/admin/default/statistics'), 'visible'=>Yii::app()->user->isAdmin),
						array('label'=>Yii::t('themes', 'Войти'),        'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
						//array('label'=>'Operations',   'url'=>array('/admin/pages/default')),
					),
        ),
        //'<form class="navbar-search pull-left" action=""><input type="text" class="search-query span2" placeholder="Search"></form>',
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(

                array('label'=>Yii::app()->user->name.' ('.Yii::app()->user->role.')', 'url'=>'#', 'items'=>array(
                    array('label'=>Yii::t('themes', 'Профиль'),  'url'=>array('/user/default/update')),
                    array('label'=>Yii::t('themes', 'На сайт'), 'url'=>'/'),
                    '---',
                    array('label'=>Yii::t('themes', 'Выйти'), 'url'=>array('/user/default/logout'), 'visible'=>!Yii::app()->user->isGuest),
                )),
            ),
        ),
    ),
)); ?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

</div><!-- page -->

</body>
</html>
