<?php if(Yii::app()->user->isGuest):?>

	<div class="login" style="background: none;">
		<?php echo CHtml::link(Yii::t('themes', 'Войти'), array(Yii::app()->user->loginUrl), array('class'=>'log-in') );?>
		<span><?php echo Yii::t('themes', 'или'); ?></span>
		<?php echo CHtml::link(Yii::t('themes', 'Зарегистрироваться'), array('/user/default/signup'), array('class'=>'sign-up') );?>
	</div>

<?php else:?>

	<div class="login" style="overflow: visible;">
		<div style="padding: 0px 10px 0px 0px;">
			<?php echo CHtml::link( $count, array('/tip/default/cart'), array('class'=>'count', 'id'=>'cart-count'));?>
			<div style="display: inline-block; position: relative;">
				<?php echo CHtml::image(Yii::app()->user->photo, '', array('width'=>30));?>
				<div class="img_pattern"></div>
			</div>
			<?php echo CHtml::link(mb_substr(Yii::app()->user->name, 0, 15, "UTF-8"), array('/user/default/update'), array('class'=>'more'));?>
			<span class="menu_button"></span>
		</div>
		<ul class="user_menu">
			<li><?php echo CHtml::link(CHtml::tag('i', array('style'=>'background: url('.Yii::app()->theme->baseUrl.'/css/images/icon_1.png) top center no-repeat;'), '').Yii::t('main', 'Личный кабинет'), array('/user/default/update'));?></li>
			<!--li><?php echo CHtml::link(CHtml::tag('i', array('style'=>'background: url('.Yii::app()->theme->baseUrl.'/css/images/icon_2.png) top center no-repeat;'), '').Yii::t('main', 'Корзина'), array('/tip/default/cart'));?></li-->
			<li><?php echo CHtml::link(CHtml::tag('i', array('style'=>'background: url('.Yii::app()->theme->baseUrl.'/css/images/icon_2.png) top center no-repeat;'), '').Yii::t('main', 'История покупок'), array('/tip/default/purchase'));?></li>
			
			<?php if(Yii::app()->user->isTipster): ?>
			<li><?php echo CHtml::link(CHtml::tag('i', array('style'=>'background: url('.Yii::app()->theme->baseUrl.'/css/images/icon_3.png) top center no-repeat;'), '').Yii::t('main', 'Создать совет'), array('/tip/default/create'));?></li>
			<li><?php echo CHtml::link(CHtml::tag('i', array('style'=>'background: url('.Yii::app()->theme->baseUrl.'/css/images/icon_3.png) top center no-repeat;'), '').Yii::t('main', 'Создать ставки на совет'), array('/tip/default/createNb'));?></li>
			<li><?php echo CHtml::link(CHtml::tag('i', array('style'=>'background: url('.Yii::app()->theme->baseUrl.'/css/images/icon_3.png) top center no-repeat;'), '').Yii::t('main', 'Черновики'), array('/tip/default/drafts'));?></li>
			<?php endif; ?>
			<!--li><?php echo CHtml::link(CHtml::tag('i', array('style'=>'background: url('.Yii::app()->theme->baseUrl.'/css/images/icon_3.png) top center no-repeat;'), '').Yii::t('main', 'Настройки'), array('/user/default/update'));?></li-->
			<li><?php echo CHtml::link(CHtml::tag('i', array('style'=>'background: url('.Yii::app()->theme->baseUrl.'/css/images/icon_4.png) top center no-repeat;'), '').Yii::t('main', 'Выход'), array('/user/default/logout'));?></li>
		</ul>
	</div>

<?php endif;?>