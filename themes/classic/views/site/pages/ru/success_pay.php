<div class="basket auth">
	<div class="site-width">
		<div style="margin: 30px 0px;">
			<div style="display: inline-block;vertical-align: middle;width: 485px;">
				<div style="color: #f5f7fa;text-transform: uppercase;">Congratulations, Your transaction was completed successfully.</div>
				<br/>
				<div style="color: #b1b6be;">
					You purchased the subscription for 1 month. Now You can see all active tips on the home page, as well as receive each new prediction to your email. If you have any difficulties, please <?php echo CHtml::link("contact","/contacts",array("style"=>"color: #fff;"));?> us and we will try to help you.
				</div>
			</div>
			<?php echo CHtml::image(Yii::app()->theme->baseUrl."/css/images/itsdone.png","",array("style"=>"vertical-align: middle;"));?>
		</div>
		<div class="basket-bottom" style="margin: 0px;">
			<form action="/" method="post">
				<div style="border-bottom: 1px solid #656d78;"></div>
				<center>
				<br>
				<br>
				<input name="Purchase[payment_id]" id="Purchase_payment_id" type="hidden"><input class="but-checkout" style="float: none;display:inline-block;" type="submit" name="yt0" value="Go Home">
				</center>
			</form>
		</div>
	</div>
</div>