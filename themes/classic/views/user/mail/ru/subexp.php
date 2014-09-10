<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
</head>
<body style="margin: 0px; padding: 0px;background-color: #f5f7fa;">
	<div style="width: 100%;margin: 0;padding: 0;font-family: Arial,sans-serif;color: #ffffff;background-color: #f5f7fa;">
		<table width="660" style="display: block;margin: 0 auto;color: #434a54;position: relative; bottom: -30px;">
			<tr>
				<td width="620" style="font-size: 13px;padding: 10px 20px;">
					<div style="float: left;">BetonFootball: Nothing more, just betting on football</div>
					<a style="color: #434a54; float: right;" href="<?php echo Yii::app()->createAbsoluteUrl('/'); ?>/" target="_blank">Go to BetOnFootball</a>
				</td>
			</tr>
			<tr>
				<td style="background: url(<?php echo Yii::app()->createAbsoluteUrl('/'); ?>/images/mail/header.png) center left no-repeat; height: 98px;position: relative;">
					<a href="<?php echo Yii::app()->createAbsoluteUrl('/'); ?>/" target="_blank" style="width: 250px;height: 70px; display: block; position: absolute; top: 0px; left: 0px;"></a>
					<a href="https://www.facebook.com/BetOnFootball" target="_blank" style="width: 32px;height: 32px; display: block; position: absolute; top: 18px; right: 30px;"></a>
					<a href="https://twitter.com/BetonFootball7" target="_blank" style="width: 32px;height: 32px; display: block; position: absolute; top: 18px; right: 76px;"></a>
				</td>
			</tr>
		</table>
		<table width="654" style="display: block;margin: 0 auto;color: #434a54;background-color: #fff;border-style: solid; border-color: #e6e9ed; border-width: 1px 1px 2px 1px;">
			<tr>
				<td style="font-size: 13px;padding: 40px 30px;color: #000;">
					<div style="font-size: 36px;font-weight: bold;">Напоминание об истечении срока подписки</div>
					<br/>
					<div style="font-size: 18px;color: #434a54;">
                        Уважаемый, <?php echo $model->FullName;?>!<br/>
                        Обращаем Ваше внимание, что до окончания срока действия подписки осталось <?php echo $model->ExpDays == 7 ? $model->ExpDays . ' дней' : ($model->ExpDays == 1 ? '24 часа' : '')?>.<br/>
                        <br/>
                        С уважением,<br/>
                        Команда BetonFootball<br/>
					</div>
				</td>
			</tr>
		</table>
		<table width="654" style="display: block;margin: 30px auto;color: #656d78;background-color: #454C58;border-style: solid; border-color: #e6e9ed; border-width: 1px 1px 2px 1px;">
			<tr>
				<td style="font-size: 13px;padding: 40px 30px;color: #000;">
					<div style="color: #fff; font-size: 24px;">Plans Subscriptions</div>
					<div style="color: #aab2bd; font-size: 16px;">Select the subscription plan that best suits you.</div>
					<table width="600" style="background: url(<?php echo Yii::app()->createAbsoluteUrl('/'); ?>/images/mail/tarif.jpg) no-repeat;height: 586px; margin: 0 auto;font-size: 36px;color: #fff;text-align: center;">
						<tr>
							<td height="140" style="vertical-align: middle;" ><span>&euro; <?php echo Yii::app()->config->get('SUBSCRIPTION_WEEKEND_PRICE');?></span></td>
						</tr>
						<tr>
							<td height="140" style="vertical-align: middle;padding-top: 10px;"><span>&euro; <?php echo Yii::app()->config->get('SUBSCRIPTION_MONTH_PRICE');?></span></td>
						</tr>
						<tr>
							<td height="140" style="vertical-align: middle;padding-top: 5px;"><span>&euro; <?php echo Yii::app()->config->get('SUBSCRIPTION_3MONTH_PRICE');?></span></td>
						</tr>
						<tr>
							<td height="140" style="vertical-align: middle;padding-top: 10px;"><span>&euro; <?php echo Yii::app()->config->get('SUBSCRIPTION_SEASON_PRICE');?></span></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<table width="654" style="display: block;margin: 30px auto;color: #656d78;background-color: #fff;border-style: solid; border-color: #e6e9ed; border-width: 1px 1px 2px 1px;">
			<tr>
				<td style="font-size: 13px;padding: 40px 30px;color: #000;">
					<center>
						<span style="color: #656d78;margin: 0px 40px 0px 0px;">SHARE</span>
						<a href="" style="color: #656d78;margin: 0px 20px;"><img align="center" style="margin: 0px 10px 0px 0px;" src="<?php echo Yii::app()->createAbsoluteUrl('/'); ?>/images/mail/twitter.png" />twitter</a>
						<a href="https://www.facebook.com/BetOnFootballBetOnFootball" style="color: #656d78;margin: 0px 20px;"><img align="center" style="margin: 0px 10px 0px 0px;" src="<?php echo Yii::app()->createAbsoluteUrl('/'); ?>/images/mail/facebook.png" />facebook</a>
						<a href="" style="color: #656d78;margin: 0px 20px;"><img align="center" style="margin: 0px 10px 0px 0px;" src="<?php echo Yii::app()->createAbsoluteUrl('/guidline/default/contacts'); ?>/images/mail/hello.png" />Say hello</a>&rarr;
					</center>
					<div style="margin: 20px 0px; border-bottom: 3px solid #e6e9ed;"></div>
					<div style="text-align: center;color: #aab2bd;">Copyright © 2011-<?php echo date("Y");?> BetonFootball, Inc, All rights reserved.<br/>You are receiving this email because you signed up on betonfootball.eu. We hope you love it!</div>
					<div style="text-align: center;color: #656d78;text-transform: uppercase;margin-top: 30px;line-height: 25px;">
						<?php echo CHtml::link('unsubscribe from this list', Yii::app()->createAbsoluteUrl('/user/default/unscribe', array('id'=>$model->id, 'hash'=>$model->unscribeHash)), array('target'=>'_blank', 'style'=>'color: #656d78;')); ?>
					</div>
				</td>
			</tr>
		</table>
	</div>

</body>
</html>
