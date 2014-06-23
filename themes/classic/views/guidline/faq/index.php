<?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>

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
			
			<?php foreach($model AS $item):?>
			<div class="question">
				<h3><?php echo $item->title;?></h3>
			</div>
			<div class="accordion">
				<?php foreach($item->p_items AS $faq):?>
				<h3><?php echo $faq->title;?> <span style="font-size: 30px;font-weight: 100;">+</span></h3>
				<div>
					<p><?php echo $faq->content;?></p>
				</div>
				<?php endforeach;?>
			</div>
			<?php endforeach;?>
			
		</div>
	</div>
</div>

<script>$(function() {$( ".accordion" ).accordion({heightStyle: "content"});});</script>