<?php
		Yii::app()->clientScript->registerMetaTag(Yii::app()->config->get('META_K_PAGE_ABOUT'), 'keywords');
		Yii::app()->clientScript->registerMetaTag(Yii::app()->config->get('META_D_PAGE_ABOUT'), 'description');
		$this->pageTitle = 'Sitemap';
?>

<div class="site-width">
	<div class="guidline-us">
		<div class="guidline-left">
			<div class="title">
				<span class="bold">Site</span>
				<span>Map</span>
			</div>

			<div class="guidline-menu">
				
			</div>

		</div>
		<div class="questions">
			
			<ul style="border: 0px;">
				<li>
					<a href="/">Home</a>
					<div class="big_hor" style="width: 40px;"></div>
					<ul style="margin-left: 85px;">
						<li>
							<span class="hor"></span><span class="ver"></span><a href="#">Tipsters</a>
							<div class="big_hor"></div>
							<ul>
								<li><span class="hor"></span><span class="ver"></span><a href="#">Team BOF</a></li>
								<li><span class="hor"></span><span class="ver"></span><a href="#">Oddsmaker_2.0</a></li>
								<li><span class="hor"></span><span class="ver"></span><a href="#">Mantis</a></li>
								<li><span class="hor"></span><span class="ver"></span><a href="#">De Generaal</a></li>
								<li><span class="hor"></span><span class="ver"></span><a href="#">Mikhail</a></li>
								<li><span class="hor"></span><span class="ver"></span><a href="#">Lakini</a></li>
								<li><span class="hor"></span><span class="ver"></span><a href="#">litost</a></li>
							</ul>
						</li>
						<li><span class="hor"></span><span class="ver"></span><a href="#">About Us</a></li>
						<li><span class="hor"></span><span class="ver"></span><a href="#">Video</a></li>
						<li><span class="hor"></span><span class="ver"></span><a href="#">About BOF</a></li>
						<li>
							<span class="hor"></span><span class="ver"></span><a href="#">Guideline</a>
							<div class="big_hor" style="width: 182px;"></div>
							<ul>
								<li><span class="hor"></span><span class="ver"></span><a href="#">How it work and how to use it</a></li>
								<li><span class="hor"></span><span class="ver"></span><a href="#">User’s manual</a></li>
								<li><span class="hor"></span><span class="ver"></span><a href="#">12 golden rules</a></li>
								<li><span class="hor"></span><span class="ver"></span><a href="#">Why you choose the BOF</a></li>
								<li><span class="hor"></span><span class="ver"></span><a href="#">FAQ</a></li>
							</ul>
						</li>
						<li><span class="hor"></span><span class="ver"></span><a href="#">Tipsters stats</a></li>
						<li><span class="hor"></span><span class="ver"></span><a href="#">Contacts</a></li>
						<li><span class="hor"></span><span class="ver"></span><a href="#">Plan subscription</a></li>
						<li><span class="hor"></span><span class="ver"></span><a href="#">Tipsters stats</a></li>
					</ul>
				</li>
			</ul>
			
		</div>
	</div>
</div>
<style>
	.guidline-us a {
		color: #488be2;
	}
	.guidline-us ul {
		border-left: 1px solid #cfd8e6;
	}
	.guidline-us ul li {
		background: none;
		padding: 0px;
	}
	.guidline-us ul ul {
		margin: 0px 0px 0px 300px;
		position: relative;
		top: -19px;
	}
	.hor {
		display: inline-block;
		vertical-align: middle;
		width: 39px;
		height: 1px;
		background: #cfd8e6;
	}
	.big_hor {
		display: inline-block;
		vertical-align: middle;
		width: 187px;
		height: 1px;
		background: #cfd8e6;
	}
	.ver {
		display: inline-block;
		vertical-align: middle;
		width: 1px;
		height: 11px;
		background: #cfd8e6;
		margin-right: 10px;
	}
</style>
