<div class="site-width">
	<div class="testimonials">

		<div class="title">
			<?php echo Yii::t('themes', '<span class="bold">Отзывы</span> <span> о БОФ</span> '); ?>
		</div>

		<div class="paginator_buttons">
			<span class="prev"><?php echo Yii::t('themes', 'Предыдущая'); ?></span>
			<span class="next"><?php echo Yii::t('themes', 'Слудящая'); ?></span>
		</div>

		<div id="reviewscarousel">
		<ul>
			<?php foreach($model AS $item): ?>
			<li class="testimonial">
				<div class="box">
					<span class="t-comment"><?php echo $item->content; ?></span>
					<span class="t-name"><?php echo $item->userFullName; ?></span>
					<span class="t-title"><?php echo $item->userRank; ?></span>
				</div>
				<div class="t-dialog"></div>
				<div class="t-avatar">
				<div style="display: inline-block; position: relative;text-align: center;left: 0px;">
					<?php echo CHtml::image($item->userAvatar); ?>
					<img class="img_pattern" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/tips/img_pattern_review.png">
				</div>
				</div>
			</li>
			<?php endforeach; ?>
		</ul>
		</div>

	</div>

</div>