<div class="active-tip">
	<div class="first-column">
		<div style="display: inline-block; position: relative;">
			<?php echo CHtml::image($data->coverOriginal, '', array('class'=>'image'));?>
			<img class="img_pattern" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/img_pattern_white.png">
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
						Yii::app()->createAbsoluteUrl('/tip/default/NbView', array('id'=>$data->id)),
						array(
							'class'               => 'addthis_button_facebook',
							'addthis:url'         => Yii::app()->createAbsoluteUrl('/tip/default/view', array('id'=>$data->id)),
							'addthis:title'       => CHtml::encode($data->club_1.' vs '.$data->club_2),
							'addthis:description' => CHtml::encode($data->preview),
						)
					);?>
					
					<?php echo CHtml::link(
						CHtml::image(Yii::app()->theme->baseUrl.'/css/images/tips/tw.png'),
						Yii::app()->createAbsoluteUrl('/tip/default/NbView', array('id'=>$data->id)),
						array(
							'class'               => 'addthis_button_twitter',
							'addthis:url'         => Yii::app()->createAbsoluteUrl('/tip/default/view', array('id'=>$data->id)),
							'addthis:title'       => CHtml::encode($data->club_1.' vs '.$data->club_2),
							'addthis:description' => CHtml::encode($data->preview),
						)
					);?>
				</div>
			</div>
			<div class="center">
				<?php echo CHtml::tag('i', array('class'=>'flag '.$data->flag_1), '');?>
				<?php echo CHtml::link($data->title, array('NbView','id'=>$data->id), array('class'=>'tip-club'));?>
				<span class="tip-data"><?php echo $data->format_event_date;?></span>
			</div>
			<span class="bottom"><?php echo CHtml::encode($data->preview);?></span>
		</div>
	</div>
	<div class="second-column">

		<span class="pay"><?php echo Yii::t('tips', 'Бесплатный');?></span>
		
		<?php echo CHtml::link(Yii::t('tips', 'Прочитать совет'),array('NbView','id'=>$data->id), array('class'=>'button green'));?>
		<br />
		<center>
			<?php if($data->accessManage):?>
				<?php echo CHtml::link( CHtml::tag('i', array(), '').Yii::t('tips', 'Редактировать'), array('updateNb', 'id'=>$data->id), array('class'=>'btn-edit'));?>
				<?php echo CHtml::link( CHtml::tag('i', array(), '').Yii::t('tips', 'Удалить'), array('deleteNb', 'id'=>$data->id), array('class'=>'btn-delete', 'confirm'=>'Are you serious?'));?>
			<?php endif;?>
		</center>
		<br/>
	</div>
</div>