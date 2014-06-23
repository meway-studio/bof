<div class="site-width">
	<div class="guidline-us">
		<div class="guidline-left">
			<div class="title">
				<span class="bold">Guideline</span>
				<span> BOF</span>
			</div>

			<div class="guidline-menu">
				<?php $this->widget('application.modules.guidline.widgets.GuidlineMenu'); ?>
			</div>

		</div>
		<div class="questions">

			<div class="question">
				<h3>How it work and how to use it</h3>
			</div>
			<table class="how_to">
				<tr>
					<td>
						<?php echo CHtml::image(Yii::app()->theme->baseUrl.'/css/images/how_to/how_icon_1.png');?>
					</td>
					<td>
						<p class="grey_text">
							Sign up on site betonfootball.eu, activate your account.
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo CHtml::image(Yii::app()->theme->baseUrl.'/css/images/how_to/how_icon_2.png');?>
					</td>
					<td>
						<p class="grey_text">
							Subscribe for a month or any other temporal period.
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo CHtml::image(Yii::app()->theme->baseUrl.'/css/images/how_to/how_icon_3.png');?>
					</td>
					<td>
						<p class="grey_text">
							Browse predictions from leading European analysts of BetonFootball right here on the site
						</p>
					</td>
				</tr>
			</table>
			<table class="how_to" style="margin-left: 75px;">
				<tr>
					<td>
						<?php echo CHtml::image(Yii::app()->theme->baseUrl.'/css/images/how_to/how_icon_4.png');?>
					</td>
					<td>
						<p class="grey_text">
							Receive automated distribution on your email at 15:00 on weekdays and at 12:00 on weekends (GMT+0), or put a "tick" in your personal account opposite "to receive every new prediction on my email»
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo CHtml::image(Yii::app()->theme->baseUrl.'/css/images/how_to/how_icon_5.png');?>
					</td>
					<td>
						<p class="grey_text">
							Use the information for making your own decision, make bets and earn on it!
						</p>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>