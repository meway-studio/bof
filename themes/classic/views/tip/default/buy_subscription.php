<?php
Yii::import( 'application.modules.tip.widgets.PlansSubscriptions.PlansSubscriptions' );
Yii::import( 'application.modules.tip.widgets.TrackRecord.TrackRecord' );
?>
    <div class="basket auth">

        <div class="site-width">

            <?php if ($status == null): ?>

                <center style="color:white;">
                    <?php echo CHtml::tag(
                        'h3',
                        array( 'class' => 'price' ),
                        Yii::t(
                            'tips',
                            'Итого: {price}&euro; (План подписки: {plan})',
                            array( '{price}' => $price, '{plan}' => $termDesc )
                        )
                    ); ?>
                    <span><?php echo Yii::t( 'themes', 'Выбрать способ оплаты' ); ?></span>
                </center>

                <br/>
                <br/>

                <div class="payment_method">
                    <div class="pay_icons" id="pay_icons">
                        <ul>
                            <li data-id="<?php echo Purchase::PAYMENT_CARD; ?>">
                                <a><img style="height: 60px;margin-top: 8px;" src="<?php echo Yii::app(
                                    )->theme->baseUrl; ?>/css/images/visa.png"/></a>
                                <span>
                                    <span>VISA</span>
                                </span>
                                <div><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/tips/won.png"></div>
                            </li>
                            <li data-id="<?php echo Purchase::PAYMENT_CARD; ?>">
                                <a><img style="height: 60px;margin-top: 8px;" src="<?php echo Yii::app(
                                    )->theme->baseUrl; ?>/css/images/master.png"/></a>
                                <span>
                                    <span>MasterCard</span>
                                </span>
                                <div><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/tips/won.png"></div>
                            </li>
                            <li data-id="<?php echo Purchase::PAYMENT_ROBOKASSA; ?>">
                                <a><img style="height: 60px;margin-top: 8px;" src="<?php echo Yii::app(
                                    )->theme->baseUrl; ?>/css/images/robo.png"/></a>
                                <span>
                                    <span>Robokassa</span>
                                </span>
                                <div><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/tips/won.png"></div>
                            </li>
                            <li data-id="<?php echo Purchase::PAYMENT_YANDEX; ?>">
                                <a><img style="margin-top: 10px;" src="https://money.yandex.ru/img/yamoney_logo120x60.gif" alt="Я принимаю Яндекс.Деньги" title="Я принимаю Яндекс.Деньги" border="0" width="120" height="60"/></a>
                                <span>
                                    <span>Yandex money</span>
                                </span>
                                <div><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/tips/won.png"></div>
                            </li>
                            <li data-id="<?php echo Purchase::PAYMENT_WEBMONEY; ?>">
                                <a><img style="height: 60px;margin-top: 8px;" src="<?php echo Yii::app(
                                    )->theme->baseUrl; ?>/css/images/webmoney.png"/></a>
                                <span>
                                    <span>Webmoney</span>
                                </span>
                                <div><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/tips/won.png"></div>
                            </li>
                            <?php /*
					<li data-id="<?php echo Purchase::PAYMENT_ZPAY;?>">
						<a><img style="height: 60px;margin-top: 8px;" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/zpay.png" /></a>
						<span ><span>Zpay</span></span>
						<div><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/tips/won.png"></div>
					</li>
					*/
                            ?>
                            <?php /*
					<li data-id="<?php echo Purchase::PAYMENT_RBK;?>">
						<a><img style="height: 60px;margin-top: 8px;" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/rbc.png" /></a>
						<span ><span>RBK Money</span></span>
						<div><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/tips/won.png"></div>
					</li>
					*/
                            ?>
                            <li data-id="<?php echo Purchase::PAYMENT_PAYPALL; ?>">
                                <a><img style="height: 60px;margin-top: 8px;" src="<?php echo Yii::app(
                                    )->theme->baseUrl; ?>/css/images/paypal.png"/></a>
                                <span>
                                    <span>PayPal</span>
                                </span>
                                <div><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/tips/won.png"></div>
                            </li>
                            <li data-id="<?php echo Purchase::PAYMENT_MAILRU; ?>">
                                <a><img style="height: 60px;margin-top: 8px;" src="<?php echo Yii::app(
                                    )->theme->baseUrl; ?>/css/images/mail_money.png"/></a>
                                <span>
                                    <span>Mail.ru money</span>
                                </span>
                                <div><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/tips/won.png"></div>
                            </li>
                            <li data-id="<?php echo Purchase::PAYMENT_LIQPAY; ?>">
                                <a><img style="height: 60px;margin-top: 8px;" src="<?php echo Yii::app(
                                    )->theme->baseUrl; ?>/css/images/liqpay.png"/></a>
                                <span>
                                    <span>Liqpay</span>
                                </span>
                                <div><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/tips/won.png"></div>
                            </li>
                            <li data-id="<?php echo Purchase::PAYMENT_EDK; ?>">
                                <a><img style="height: 60px;margin-top: 8px;" src="<?php echo Yii::app(
                                    )->theme->baseUrl; ?>/css/images/edk.png"/></a>
                                <span>
                                    <span>EDK</span>
                                </span>
                                <div><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/tips/won.png"></div>
                            </li>
                            <?php /*
					<li data-id="<?php echo Purchase::PAYMENT_EASYPAY;?>">
						<a><img style="height: 60px;margin-top: 8px;" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/easy.png" /></a>
						<span ><span>EasyPay</span></span>
						<div><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/tips/won.png"></div>
					</li>
					*/
                            ?>
                            <?php /*
					<li data-id="<?php echo Purchase::PAYMENT_WEBCREDS;?>">
						<a><img style="height: 60px;margin-top: 8px;" src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/webcreds.png" /></a>
						<span ><span>Webcreds</span></span>
						<div><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/tips/won.png"></div>
					</li>
					*/
                            ?>
                            <li data-id="<?php echo Purchase::PAYMENT_QIWI; ?>">
                                <a><img style="height: 60px;margin-top: 8px;" src="http://salebattle.ru/themes/classic/css/images/qiwi.png" alt=""></a>
                                <span>
                                    <span>QIWI</span>
                                </span>
                                <div><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/tips/won.png"></div>
                            </li>

                            <li data-id="<?php echo Purchase::PAYMENT_MB; ?>">
                                <a><img style="height: 60px;margin-top: 8px;" src="<?php echo Yii::app(
                                    )->theme->baseUrl; ?>/css/images/tips/mb.jpg"/></a>
                                <span>
                                    <span>Moneybookers</span>
                                </span>
                                <div><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/images/tips/won.png"></div>
                            </li>

                        </ul>
                    </div>

                    <div id="processPay" class="basket-bottom" style="margin: 0px;">
                        <?php echo CHtml::beginForm(); ?>
                        <div style="border-bottom: 1px solid #656d78;"></div>
                        <?php echo CHtml::errorSummary( $model ); ?>
                        <center>
                            <?php /*<p style="color: #f5f7fa">Click the batton below re-directed to WebMoney website to complete your transiction!</p>*/ ?>
                            <br/>
                            <br/>
                            <?php echo CHtml::activeHiddenField( $model, 'payment_id' ) ?>
                            <?php //echo CHtml::submitButton('Continue', array('class'=>'but-checkout','style'=>'float: none;display:inline-block;')); ?>
                        </center>
                        <?php echo CHtml::endForm(); ?>
                    </div>
                </div>

            <?php elseif ($status == false): ?>

                <h3><?php echo Yii::t( 'themes', 'Произошла ошибка. Повторите попытку позднее!' ); ?></h3>

            <?php
            else: ?>

                <h3 style="color: #fff;"><?php echo Yii::t(
                        'themes',
                        'Чтобы подписаться, пожалуйста, переведите деньги на указанные ниже реквизиты.'
                    ); ?> <?php /*We apologize for inconvenience, in a month we will connect the united payments processing center to make shopping on our site much easier.*/ ?></h3>

                <?php if ($model->payment_id == Purchase::PAYMENT_PAYPALL): ?>
                    <p style="color: #fff;font-size: 34px;"><?php echo Yii::t( 'themes', 'Наш счет Paypal:' ); ?> <?php echo Yii::app(
                        )->config->get( 'ACCOUNT_PAYPALL' ); ?></p>
                <?php elseif ($model->payment_id == Purchase::PAYMENT_MB): ?>
                    <p style="color: #fff;font-size: 34px;"><?php echo Yii::t( 'themes', 'Наш счет Moneybookers:' ); ?> <?php echo Yii::app(
                        )->config->get( 'ACCOUNT_MB' ); ?></p>
                <?php /*elseif($model->payment_id == Purchase::PAYMENT_QIWI):?>
			<p style="color: #fff;font-size: 34px;">Our Qiwi account: <?php echo Yii::app()->config->get('ACCOUNT_QIWI');?></p>
		<?php */
                endif; ?>

                <div class="basket-bottom">
                    <?php echo CHtml::link(
                        Yii::t( 'tips', 'К истории покупок' ),
                        array( "purchase" ),
                        array( 'class' => 'but-checkout' )
                    ); ?>
                </div>

            <?php endif; ?>

        </div>

    </div>

<?php $this->widget( 'PlansSubscriptions' ); ?>

<?php Yii::app()->clientScript->registerScript(
    'pay_icons',
    '
       $(document).ready(function(){
           $(document).on("click touchstart", "#pay_icons ul li", function(){
               var obj = $(this).data("id");
               $("#Purchase_payment_id").val(obj.data("id"));
               $("#pay_icons li").removeClass("selected_icon");
               $(this).addClass("selected_icon");
               $("#processPay").find("form").submit();
               alert("ddd");
           });
       });
   '
);?>