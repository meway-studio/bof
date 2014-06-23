<div class="site-width">
	<div class="guidline-us">
		<div class="guidline-left">
			<div class="title">
				<?php echo Yii::t('themes', '<span class="bold">Гайдлайн</span> <span>БОФ</span> '); ?>
			</div>

			<div class="guidline-menu">
				<?php $this->widget('application.modules.guidline.widgets.GuidlineMenu'); ?>
			</div>

		</div>
		<div class="questions">

			<div class="question">
				<h3>Как это работает и как это использовать:</h3>
			</div>
			<table class="how_to">
				<tr>
					<td>
						<?php echo CHtml::image(Yii::app()->theme->baseUrl.'/css/images/how_to/how_icon_1.png');?>
					</td>
					<td>
						<p class="grey_text">
							Зарегистрируйтесь на сайте betonfootball.eu
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo CHtml::image(Yii::app()->theme->baseUrl.'/css/images/how_to/how_icon_2.png');?>
					</td>
					<td>
						<p class="grey_text">
							Оформите подписку на месяц или любой другой временной срок.
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo CHtml::image(Yii::app()->theme->baseUrl.'/css/images/how_to/how_icon_3.png');?>
					</td>
					<td>
						<p class="grey_text">
							Просматривайте прогнозы от ведущих европейских аналитиков BetonFootball прямо на сайте в удобной таблице.
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
							Получайте на Ваш email автоматическую рассылку в 19:00 по будням и в 16:00 по выходным дням (GMT+4, Москва), либо поставьте «галку» в вашем личном кабинете напротив «получать каждый новый прогноз на мой email».
						</p>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo CHtml::image(Yii::app()->theme->baseUrl.'/css/images/how_to/how_icon_5.png');?>
					</td>
					<td>
						<p class="grey_text">
							Используйте полученную информацию для принятия собственного решения, делайте ставки и зарабатывайте на этом!
						</p>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>