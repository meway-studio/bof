<?php Yii::import( 'ext.blueimp.FileUploadWidget' ); ?>

<div class="my-account">
    <div class="site-width">
        <div class="page-title">
            <span class="title">
                <span><?php echo Yii::t( 'user', 'Мой' ); ?></span><?php echo Yii::t( 'user', 'Профиль' ); ?></span>
            <span class="text">
                <?php echo Yii::t(
                    'user',
                    'Если Вы добавите Ваше Имя, мы будем знать, как обращаться к вам должным образом. Если Вы добавите Ваш адрес электронной почты, мы всегда сможем предоставить Вам самую свежую информацию, и отправить важные новости и прогнозы. Если добавите Ваш номер телефона, мы сможем оповещать Вас с помощью смс. Все ответы на интересующие Вас вопросы Вы всегда сможете получить, воспользовавшись формой обратной связи в разделе контакты.'
                ); ?>
                <br/>
                <?php if (Yii::app()->user->hasFlash( 'updateSuccess' )): ?>
                    <span class="success"><?php echo Yii::app()->user->getFlash( 'updateSuccess' ); ?></span>
                <?php elseif (Yii::app()->user->hasFlash( 'updateFailure' )): ?>
                    <span class="error"><?php echo Yii::app()->user->getFlash( 'updateFailure' ); ?></span>
                <?php endif; ?>
            </span>
        </div>
        <div class="personal">
            <div class="avatar">
                <?php echo CHtml::image( $model->PhotoThumb, '', array( 'id' => 'user_avatar', 'width' => 128 ) ); ?>
                <span>
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/menu/upload.png">
                    <?php echo CHtml::link( Yii::t( 'user', 'Загрузить фото' ), "/" ); ?>

                    <?php $this->widget(
                        'FileUploadWidget',
                        array(
                            'model'     => $model,
                            'attribute' => 'photo',
                            'action'    => Yii::app()->createUrl( '/user/default/upload' ),
                            'options'   => "{
							dataType: 'json',
							add: function (e, data) {
								$('#user_avatar').attr('src', '/images/loader.gif');
								data.submit();
							},
							done: function (e, data) {
								if(data.result.status==true){
									$('#user_avatar').attr('src', data.result.photo.thumbnail);
								}else{
									$('#tipCover').attr('src', 'https://cdn1.iconfinder.com/data/icons/phuzion/PNG/Signs%20%26%20Symbols/Error.png');
								}
							}}",
                        )
                    );
                    ?>

                </span>
                <br/>
                <br/>
                <?php $this->widget( 'application.modules.tip.widgets.Expiries.Expiries' ); ?>
            </div>
            <div class="information">
                <span><?php echo Yii::t( 'user', 'Персональная информация' ); ?></span>
                <?php
                /**
                 * @var $form CActiveForm
                 */
                $form = $this->beginWidget(
                    'CActiveForm',
                    array(
                        'id'                   => 'user-update-form',
                        'enableAjaxValidation' => false,
                    )
                ); ?>

                <?php echo $form->errorSummary( $model ); ?>

                <span class="name">
                    <?php echo $form->textField( $model, 'firstname', array( 'size' => 38 ) ); ?>
                </span>
                <span class="mail">
                    <?php echo $form->textField( $model, 'email', array( 'size' => 38 ) ); ?>
                </span>

                <span class="phone">
                    <?php echo $form->textField( $model, 'phone', array( 'size' => 38 ) ); ?>
                </span>

                <span class="password">
                    <?php echo CHtml::link( Yii::t( 'user', 'Изменить пароль' ), array( '/user/default/password' ) ); ?>
                </span>

                <span class="language">
                    <div class="lang-title"><?php echo Yii::t( 'user', 'Язык на котором я хочу получать письма с сайта' ) ?>:</div>
                    <?php echo $form->radioButtonList(
                        $model,
                        'language',
                        array(
                            'en' => Yii::t( 'user', '<b class="flag us"></b> Английский' ),
                            'ru' => Yii::t( 'user', '<b class="flag ru"></b> Русский' ),
                        ),
                        array(
                            'class'     => 'langradio',
                            'container' => 'div',
                        )
                    ) ?>
                </span>

                <?php echo CHtml::submitButton( Yii::t( 'user', 'Изменить' ), array( 'class' => 'updateprofile-but' ) ); ?>

                <label style="margin-left:30px;"><?php echo $form->checkBox( $model, 'fast_notice' ); ?><?php echo Yii::t(
                        'user',
                        'Получать каждый новый совет по электронной почте'
                    ); ?></label>


                <?php $this->endWidget(); ?>
            </div>
        </div>

        <?php if ($model->isTipster): ?>
            <div class="personal">
                <?php $this->renderPartial( 'tipster_update', array( 'model' => $model->tipster ) ); ?>
            </div>
        <?php else: ?>

            <div class="review">
                <?php /*
				<form>
					<span><?php echo Yii::t('user', 'Write a Review')?></span>
					<textarea>Cloppenberg is not such a bad team as result shows, they have good squard with some good names, some of them just start playing recently after injuries and that should give them some boost when they back in form. At home they have just 0-3-3, but they show with win against Flensburg on road that they can play against every team. Havelse is not same team like last season with very shaky results where they show that also can beat anyone, but also lost against anyone.</textarea>
					<div class="submit">
						<?php echo CHtml::submitButton(Yii::t('user', 'Submit'),array("class"=>"btn-blue")); ?>
						<span>Review, 12th October 2013</span>
					</div>
				</form>
			*/
                ?>

                <?php $form = $this->beginWidget(
                    'CActiveForm',
                    array(
                        'id'                   => 'user-update-review-form',
                        'enableAjaxValidation' => false,
                    )
                ); ?>

                <span><?php echo Yii::t( 'user', 'Написать отзыв' ) ?></span>
                <?php echo $form->textArea( $model, 'about' ); ?>
                <div class="submit">
                    <?php echo CHtml::submitButton( Yii::t( 'user', 'Отправить' ), array( "class" => "btn-blue" ) ); ?>
                    <!--span>Review, 12th October 2013</span-->
                </div>
                </form>
                <?php $this->endWidget(); ?>


            </div>

        <?php endif; ?>

    </div>
</div>