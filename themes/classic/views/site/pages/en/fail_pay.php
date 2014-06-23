<div class="basket auth">
	<div class="site-width">
		<div style="margin: 30px 0px;">
			<div style="display: inline-block;vertical-align: middle;width: 485px;">
				<div style="color: #E9573F;text-transform: uppercase;">Unfortunately, something went wrong and the payment failed. Try again, or use another method of payment, or <?php echo CHtml::link("contact","/contacts",array("style"=>"color: #fff;"));?> us and we will try to help you.</div>
			</div>
			<?php echo CHtml::image(Yii::app()->theme->baseUrl."/css/images/itsdone.png","",array("style"=>"vertical-align: middle;"));?>
		</div>
		<div class="basket-bottom" style="margin: 0px;">
			<form action="/" method="post">
				<div style="border-bottom: 1px solid #656d78;"></div>
				<center>
				<br>
				<br>
				<input name="Purchase[payment_id]" id="Purchase_payment_id" type="hidden"><input class="but-checkout" style="float: none;display:inline-block;" type="submit" name="yt0" value="<?php echo Yii::t('themes', 'На главную'); ?>">
				</center>
			</form>
		</div>
	</div>
</div>