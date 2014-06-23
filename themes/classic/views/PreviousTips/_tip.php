<div class="active-tip">
	<div class="first-column">
		<div style="display: inline-block; position: relative;">
			<?php echo CHtml::image($data->coverOriginal, '', array('class'=>'image'));?>
			<img class="img_pattern" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/tips/img_pattern_fff.png">
		</div>
		<div class="information">
			<div class="top">
				<div class="left">
					<span class="tip-name"><?php echo $data->tipster->FullName;?></span>
					<span class="tip-title"><?php echo $data->tipster->tipster->rank;?></span>
				</div>
				<div class="right">
					<?php echo CHtml::link(
						CHtml::image(Yii::app()->theme->baseUrl.'/css/images/tips/fb.png'),
						Yii::app()->createAbsoluteUrl('/tip/default/view', array('id'=>$data->id)),
						array(
							'class'               => 'addthis_button_facebook',
							'addthis:url'         => Yii::app()->createAbsoluteUrl('/tip/default/view', array('id'=>$data->id)),
							'addthis:title'       => CHtml::encode($data->club_1.' vs '.$data->club_2),
							'addthis:description' => CHtml::encode($data->description),
						)
					);?>
					
					<?php echo CHtml::link(
						CHtml::image(Yii::app()->theme->baseUrl.'/css/images/tips/tw.png'),
						Yii::app()->createAbsoluteUrl('/tip/default/view', array('id'=>$data->id)),
						array(
							'class'               => 'addthis_button_twitter',
							'addthis:url'         => Yii::app()->createAbsoluteUrl('/tip/default/view', array('id'=>$data->id)),
							'addthis:title'       => CHtml::encode($data->club_1.' vs '.$data->club_2),
							'addthis:description' => CHtml::encode($data->description),
						)
					);?>
				</div>
			</div>
			<div class="center">
				<?php echo CHtml::tag('i', array('class'=>'flag '.$data->flag_1), '');?>
				<?php 
				
					if($data->isFree){
						echo CHtml::link($data->title, array('view','id'=>$data->id), array('class'=>'tip-club'));
						
					}elseif($data->accessView){
					
						echo CHtml::link($data->title, array('view','id'=>$data->id), array('class'=>'tip-club'));
						
					}else{
						
						if(Yii::app()->user->isGuest)
							echo CHtml::link($data->title, Yii::app()->user->loginUrl, array('class'=>'tip-club'));
						else
							echo CHtml::link($data->title, array('view','id'=>$data->id), array('class'=>'tip-club cartAdd', 'data-id'=>$data->id, 'data-url'=>Yii::app()->createUrl('tip/default/cartAdd')));
					}
				
				?>
				<span class="tip-data"><?php echo $data->format_event_date;?></span>
			</div>
			<span class="bottom"><?php echo CHtml::encode($data->description);?></span>
		</div>
	</div>
	<div class="second-column">
		
		<?php if($data->ShowResultScore):?>
			<?php echo $data->TipResultSpanTag;?>
			<span class="matchResult"><?php echo $data->match_result;?></span>
		<?php endif;?>
		
		<span class="pay"><?php echo $data->formatPrice;?></span>
		
		<?php 
		
		/*
		if($data->isFree OR $data->accessView){
			echo CHtml::link(Yii::t('tips', 'Get Tip'),array('view','id'=>$data->id), array('class'=>'button green'));
		}else{
			echo CHtml::link(Yii::t('tips', 'Paid Tip'),array('view','id'=>$data->id), array('class'=>'button cartAdd', 'data-id'=>$data->id, 'data-url'=>Yii::app()->createUrl('tip/default/cartAdd')));
		}
		*/
		
		if($data->isFree){
			echo CHtml::link(Yii::t('tips', 'Получить Совет'),array('view','id'=>$data->id), array('class'=>'button green'));
			
		}elseif($data->accessView){
			echo CHtml::link(Yii::t('tips', 'Платный Совет'),array('view','id'=>$data->id), array('class'=>'button green'));
		}else{
			if(Yii::app()->user->isGuest)
				echo CHtml::link(Yii::t('tips', 'Купить совет'), array(Yii::app()->user->loginUrl), array('class'=>'button'));
			else
				echo CHtml::link(Yii::t('tips', 'Купить совет'),array('view','id'=>$data->id), array('class'=>'button cartAdd', 'data-id'=>$data->id, 'data-url'=>Yii::app()->createUrl('tip/default/cartAdd')));
		}
		
		?>
		<br/>
		<center>
			<?php if($data->accessManage):?>
				<?php echo CHtml::link( CHtml::tag('i', array(), '').Yii::t('tips', 'Редактировать'), array('update', 'id'=>$data->id), array('class'=>'btn-edit'));?>
				<?php echo CHtml::link( CHtml::tag('i', array(), '').Yii::t('tips', 'Удалить'), array('delete', 'id'=>$data->id), array('class'=>'btn-delete', 'confirm'=>'Are you serious?'));?>
			<?php endif;?>
		</center>
		<br/>
	</div>
</div>