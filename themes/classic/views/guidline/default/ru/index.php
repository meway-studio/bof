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
				<?php /*
				<h3>How and why use BetOnFootball:</h3>
				<ul>
					<li>The main rule of  BetOnFootball is nothing extra, but football bets.</li>
					<li>BetOnFootball is a team of football analysts, one for each leading European championship (The UK, Spain, Germany, Italy, France and Holland).</li>
					<li>Paid subscription is effected for all the analysts, but not for each one separately.</li>
					<li>There are different subscription terms: 1 bet (forecast), 1 match day, weekends, a month, 3 months and a season.</li>
					<li>In the user’s personal account, having filled in “E-mail” and “Phone” areas, the subscription for you will look the following way: you receive SMS, which says that the new forecast is added to your personal account and e-mail message is sent to you. You chose yourself the most convenient for you way of making yourself aware of the materials (in your personal account on BOF site or via e-mail).</li>
					<li> For the sake of convenience we have created BOF journal for you, which will be issued on a regular basis on match days and “accumulate” all the forecasts of all the BOF analysts.</li>
					<li>Apart from the journal and “early bets” not included in the journal, there will be forecasts 30 minutes before the match starts, when the team lists for the game are already known and in some cases during the match itself.</li>
					<li> To get free forecasts, as well as to get an opportunity to buy the forecast, each site visitor is offered an easy sign up procedure.</li>
					<li> Please, do not hesitate to address us any of your questions or concerns using feedback form, e-mail, skype or telephone.</li>
					<li>New forecasts as well as the latest 7 matches statistics are always displayed on the main page of our site.</li>
				</ul>
				<p>You may anytime find Statistics on each BOF analyst as well as the whole project in our Statistics section</p>
				<p>Let’s earn together!</p>

				<h3>12 g<span class="gold">olden</span> rules for betting</h3>
				<p>Basing on the understanding that gaming events have always been accompanying human existence and will continue to in future, one can state with confidence that the desire to bet on the outcome of a certain sports contest, bet on the result, win and, unfortunately, lose will always exist. That’s why it’s important to minimize negative consequences of your bets.</p>
				
				<span class="q-little">BetonFootball recommends using services of the Betfair betting exchange created in the UK in 1999. The Betfair has eliminated the traditional bookmaker as an intermediary between bettors and thus made it possible and profitable to place bets skipping the bookmaker office. Since that very moment any player is able to choose himself a person to bet against. Taking into consideration our personal ten-year experience we can well afford to offer a few ideas-rules you always have to keep in mind:</span>
				
				*/?>
				<?php echo $index->content; ?>
			</div>

			<div id="rules" class="question">

				<div  class="rules">

					<div class="rules-column">

					<?php foreach($rules AS $k=>$rule): ?>
						<?php if($k%2==1 OR $rule->is_index==1) continue; ?>
						<div class="some-rule">
							<span class="rule-count"><?php echo $k+1; ?></span>
							<span class="rule-text"><?php echo $rule->content; ?></span>
						</div>
					<?php endforeach; ?>
					</div>

					<div class="rules-column">
					<?php foreach($rules AS $k=>$rule): ?>
						<?php if($k%2==0 OR $rule->is_index==1) continue; ?>
						<div class="some-rule">
							<span class="rule-count"><?php echo $k+1; ?></span>
							<span class="rule-text"><?php echo $rule->content; ?></span>
						</div>
					<?php endforeach; ?>
					</div>
				</div>

				<!-- Start Form -->
				<div id="support" class="help">

				<?php /*if(Yii::app()->user->hasFlash('GuidlineMessagesSuccess')):?>

					<div class="submitted">
						<span><?php echo Yii::app()->user->getFlash('GuidlineMessagesSuccess'); ?></span>
						<?php echo CHtml::link(Yii::t('GuidlineMessages', 'Once more'), array('index')); ?>
					</div>

				<?php elseif(Yii::app()->user->hasFlash('GuidlineMessagesFailure')):?>

					<div class="error">
						<span><?php echo Yii::app()->user->getFlash('GuidlineMessagesFailure'); ?></span>
						<?php echo CHtml::link(Yii::t('GuidlineMessages', 'Try again'), array('index')); ?>
					</div>

				<?php else: ?>

					
					<?php $form=$this->beginWidget('CActiveForm', array(
					    'id'                   => 'guidline-form',
					    'enableAjaxValidation' => false,
					    'action'               => Yii::app()->createAbsoluteUrl('guidline/default/index').'#support',
					)); ?>

						<span class="say-hi">How can we help you?</span>
					    <?php //echo $form->errorSummary($model); ?>

					    <?php //echo $form->labelEx($model,'question'); ?>
					    <?php echo $form->textField($model,'question', array('class'=>'question', 'placeholder'=>'Question')); ?>
					    <?php echo $form->error($model,'question', array('class'=>'oops')); ?>

					    <?php //echo $form->labelEx($model,'details'); ?>
					    <?php echo $form->textArea($model,'details', array('class'=>'details', 'placeholder'=>'Details')); ?>
					    <?php echo $form->error($model,'details', array('class'=>'oops')); ?>

					    <?php //echo $form->labelEx($model,'name'); ?>
					    <?php echo $form->textField($model,'name', array('class'=>'name', 'placeholder'=>'Name')); ?>
					    <?php echo $form->error($model,'name', array('class'=>'oops')); ?>

					    <?php //echo $form->labelEx($model,'email'); ?>
					    <?php echo $form->textField($model,'email', array('class'=>'mail', 'placeholder'=>'Your email addres')); ?>
					    <?php echo $form->error($model,'email', array('class'=>'oops')); ?>

					    <input class="submit" type="submit" value="Submit">

					<?php $this->endWidget(); ?>

				<?php endif;*/ ?>

				</div>
				<!-- End Form -->

			</div>
		</div>
	</div>
</div>