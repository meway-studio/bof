
<div class="basket auth">
		<div class="site-width">
		
			<ul>
				<li class="active"><a href="/"><?php echo Yii::t('themes', 'Корзина'); ?></a></li>
				<li><a href="#"><?php echo Yii::t('themes', 'Способы оплаты'); ?></a></li>
			</ul>
			
			<?php if($model['totalPrice']>0):?>
			
			<table cellspacing="0">
				<tbody>
					<tr class="colls-name">
						<td class="description"><?php echo Yii::t('themes', 'Описание'); ?></td>
						<td class="period"><?php echo Yii::t('themes', 'Период'); ?></td>
						<td class="price"><?php echo Yii::t('themes', 'Стоимость'); ?></td>
					</tr>
					<tr>
						<td class="bigone" rowspan="<?php echo count($model['cart'])+1;?>">

						<?php foreach($model['cart'] AS $item): ?>

							<div class="cart_user_top">
								<div style="display: inline-block; position: relative;">
									<?php echo CHtml::image($item['tipster']->PhotoThumb,"",array("class"=>"image")); ?>
									<div class="img_pattern"></div>
								</div>
								<?php echo CHtml::link($item['tipster']->FullName,""); ?>
							</div>

							<?php foreach($item['tips'] AS $tip): ?>
							<div class="cart_block">
								<div class="cart_user"></div>
								<div class="cart_item">
									<?php echo CHtml::tag('i', array('class'=>'flag '.$tip->flag_1), '');?>
									<?php echo CHtml::link($tip->club_1.' vs '.$tip->club_2, array('/tip/default/view', 'id'=>$tip->id));?>
									<span class="tip-data"><?php echo $tip->format_event_date; ?></span>

									<?php echo CHtml::link(
										CHtml::image(Yii::app()->theme->baseUrl."/css/images/contacts/close_redbut.png", '', array('style'=>'float:right;margin:5px;') ),
										array('/tip/default/CartDelete', 'id'=>$tip->id)
									); ?>

								</div>
							</div>
							<?php endforeach; ?>

						<?php endforeach; ?>

						</td>
						<td class="empty"></td>
						<td class="empty"></td>
					</tr>

					<?php foreach($model['cart'] AS $item): ?>
					<tr>
						<td class="period"><?php echo Yii::t('themes', 'Один совет'); ?></td>
						<td class="price"><?php echo Yii::t('themes', '€'); ?> <?php echo $item['price']; ?>
							<?php echo CHtml::link(
								CHtml::image(Yii::app()->theme->baseUrl."/css/images/contacts/close_redbut.png", '', array('style'=>'float:right;margin:5px;') ),
								array('/tip/default/CartDelete', 'id'=>trim($item['ids'],';'))
							); ?>
						</td>
					</tr>
					<?php endforeach; ?>

					<tr>
						<td class="total"></td>
						<td class="total"><?php echo Yii::t('themes', 'Итоговая стоимость'); ?></td>
						<td class="total"><?php echo Yii::t('themes', '€'); ?> <?php echo $model['totalPrice']; ?></td>
					</tr>

				</tbody>
			</table>
			<div class="basket-bottom">
				<div class="pay-metod">
					<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/contacts/card1.png"></a>
					<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/contacts/card2.png"></a>
					<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/contacts/card3.png"></a>
					<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/contacts/card4.png"></a>
					<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/contacts/card5.png"></a>
					<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/contacts/card6.png"></a>
					<a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/contacts/card7.png"></a>
				</div>
				<?php echo CHtml::link(Yii::t('themes', 'Оплатить'), array('/tip/default/cart', 'confirm'=>true), array('class'=>'but-checkout'));?>
			</div>
			
			<?php else:?>
				<h3><?php echo Yii::t('themes', 'Ваша корзина пуста'); ?></h3>
			<?php endif;?>
			
			<br/>
			<br/>
			<br/>
			
		</div>
	</div>