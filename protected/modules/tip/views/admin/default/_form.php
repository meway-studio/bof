<?php
/* @var $this TipsController */
/* @var $model Tips */
/* @var $form CActiveForm */

Yii::import( 'ext.redactor.redactor' );
Yii::import( 'ext.msDropdown.msDropdown' );
Yii::import( 'ext.blueimp.FileUploadWidget' );
Yii::app()->clientScript->registerCss( 'dp', '.ui-datepicker-trigger {padding: 0 0 10px 5px;}' );

$languages = array_flip( Yii::app()->urlManager->languages );
unset($languages[ Yii::app()->language ]);

$tbMenuItems = array(
    array(
        'label'       => Yii::t( 'languages', Yii::app()->language ),
        'url'         => '#',
        'active'      => true,
        'itemOptions' => array(
            'class' => 'switch_lang',
            'id'    => 'lang_' . Yii::app()->language
        ),
    ),
);

foreach (Yii::app()->urlManager->languages as $lang) {
    if ($lang != Yii::app()->language) {
        $tbMenuItems[ ] = array(
            'label'       => Yii::t( 'languages', $lang ),
            'url'         => '#',
            'itemOptions' => array(
                'class' => 'switch_lang',
                'id'    => 'lang_' . $lang
            ),
        );
    }
}
?>

<?php $this->widget(
    'bootstrap.widgets.TbMenu',
    array(
        'type'    => 'tabs', // '', 'tabs', 'pills' (or 'list')
        'stacked' => false, // whether this is a stacked menu
        'items'   => $tbMenuItems,
    )
); ?>
<script>
    $(document).ready(function() {
        $('.switch_lang').click(function() {
            $('.lang').hide();
            $('.' + $(this).attr('id')).show();
            $('.switch_lang').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>
<div id="tabs">
    <?php $form = $this->beginWidget(
        'bootstrap.widgets.TbActiveForm',
        array(
            'id'                   => 'tips-form',
            'enableAjaxValidation' => false,
        )
    ); ?>

    <p class="help-block"><?=
        Yii::t(
            'tips',
            'Поля с {s} обязательны для заполнения.',
            array( '{s}' => '<span class="required">*</span>' )
        ); ?></p>

    <?= $form->errorSummary( $model ); ?>

    <?= $form->labelEx( $model, 'status' ); ?>
    <?=
    $form->dropDownList(
        $model,
        'status',
        $model->statusList,
        array_merge( array( 'class' => 'span5' ), $model->disabledForManager( 'status' ) )
    ); ?>

    <?= $form->labelEx( $model, 'type' ); ?>
    <?=
    $form->dropDownList(
        $model,
        'type',
        $model->typeList,
        array_merge( array( 'class' => 'span5' ), $model->disabledForManager( 'type' ) )
    ); ?>

    <?=
    $form->textFieldRow(
        $model,
        'price',
        array_merge( array( 'class' => 'span5', 'maxlength' => 10 ), $model->disabledForManager( 'price' ) )
    ); ?>

    <div>
        <?= $form->labelEx( $model, 'format_event_date' ); ?>
        <?php $this->widget(
            'zii.widgets.jui.CJuiDatePicker',
            array(
                'model'       => $model,
                'attribute'   => 'format_event_date',
                'options'     => array(
                    'showAnim'        => 'fold',
                    'showOn'          => 'button',
                    'buttonImage'     => '/themes/classic/css/images/calendar_icon.png',
                    'buttonImageOnly' => true,
                    "dateFormat"      => "dd/mm/yy"
                ),
                'htmlOptions' => $model->disabledForManager( 'format_event_date' ),
            )
        );
        ?>
        <?= $form->error( $model, 'format_event_date' ); ?>
    </div>

    <?= $form->labelEx( $model, 'event_h' ); ?>
    <?=
    $form->dropDownList(
        $model,
        'event_h',
        $model->EventHValues,
        array_merge( array( 'class' => 'ddl' ), $model->disabledForManager( 'event_h' ) )
    ); ?>

    <?= $form->labelEx( $model, 'event_m' ); ?>
    <?=
    $form->dropDownList(
        $model,
        'event_m',
        $model->EventMValues,
        array_merge( array( 'class' => 'ddl' ), $model->disabledForManager( 'event_m' ) )
    ); ?>

    <?= $form->labelEx( $model, 'tipster_id' ); ?>
    <?=
    $form->dropDownList(
        $model,
        'tipster_id',
        $model->TipstersList,
        array_merge( array( 'class' => 'span5' ), $model->disabledForManager( 'tipster_id' ) )
    ); ?>



    <?php foreach (Yii::app()->urlManager->languages as $lang): ?>
        <?php $sufix = ($lang == 'en') ? '' : "_{$lang}"; ?>
        <div class="lang lang_<?= $lang ?>">
            <?=
            $form->textFieldRow(
                $model,
                "club_1{$sufix}",
                array_merge(
                    array( 'class' => 'span5', 'maxlength' => 100, 'style' => 'margin-top: 8px;' ),
                    $model->disabledForManager( "club_1{$sufix}" )
                )
            ); ?>
        </div>
    <?php endforeach ?>
    <?= $form->error( $model, 'flag_1' ); ?>
    <?php $this->widget(
        'msDropdown',
        array(
            'model'       => $model,
            'attribute'   => 'flag_1',
            'htmlOptions' => array_merge( array( 'style' => 'width:300px' ), $model->disabledForManager( 'club_1' ) ),
        )
    ); ?>



    <?php foreach (Yii::app()->urlManager->languages as $lang): ?>
        <?php $sufix = ($lang == 'en') ? '' : "_{$lang}"; ?>
        <div class="lang lang_<?= $lang ?>">
            <?=
            $form->textFieldRow(
                $model,
                "club_2{$sufix}",
                array_merge(
                    array( 'class' => 'span5', 'maxlength' => 100, 'style' => 'margin-top: 8px;' ),
                    $model->disabledForManager( "club_2{$sufix}" )
                )
            ); ?>
        </div>
    <?php endforeach ?>
    <?= $form->error( $model, 'flag_2' ); ?>
    <?php $this->widget(
        'msDropdown',
        array(
            'model'       => $model,
            'attribute'   => 'flag_2',
            'htmlOptions' => array_merge( array( 'style' => 'width:300px' ), $model->disabledForManager( 'club_2' ) ),
        )
    ); ?>

    <div>
        <?= $form->labelEx( $model, 'bet_on' ); ?>
        <br/>
        <?=
        $form->radioButtonList(
            $model,
            'bet_on',
            array( 1 => Yii::t( 'tips', 'Команда 1' ), 2 => Yii::t( 'tips', 'Команда 2' ) ),
            $model->disabledForManager( 'bet_on' )
        ); ?>
        <?= $form->error( $model, 'bet_on' ); ?>
    </div>

    <?php foreach (Yii::app()->urlManager->languages as $lang): ?>
        <?php $sufix = ($lang == 'en') ? '' : "_{$lang}"; ?>
        <div class="lang lang_<?= $lang ?>">
            <?=
            $form->textFieldRow(
                $model,
                "league{$sufix}",
                array_merge( array( 'class' => 'span5', 'maxlength' => 250 ), $model->disabledForManager( 'club_2' ) )
            ); ?>

            <?=
            $form->textAreaRow(
                $model,
                "description{$sufix}",
                array_merge( array( 'rows' => 6, 'cols' => 50, 'class' => 'span8' ), $model->disabledForManager( 'club_2' ) )
            ); ?>

            <div>
                <?= $form->labelEx( $model, 'content' ); ?>

                <?php
                if (sizeof( $model->disabledForManager( 'content' ) ) == 0) {
                    $this->widget(
                        'redactor',
                        array(
                            'model'       => $model,
                            'language'    => Yii::app()->language,
                            'attribute'   => "content{$sufix}",
                            'htmlOptions' => $model->disabledForManager( "content{$sufix}" ),
                            'settings'    => array(
                                'imageUpload' => Yii::app()->createUrl( '/tip/default/redactor' ),
                            ),
                            'plugins'     => array(
                                'fontcolor',
                                'fontcolor',
                                'fontfamily',
                                'clips',
                            )
                        )
                    );
                } else {
                    echo $form->textArea(
                        $model,
                        'content',
                        array_merge(
                            array( 'rows' => 6, 'cols' => 50, 'class' => 'span8' ),
                            $model->disabledForManager( "content{$sufix}" )
                        )
                    );
                }
                ?>
                <?= $form->error( $model, 'content' ); ?>
            </div>
        </div>
    <?php endforeach ?>

    <div>
        <?= $form->labelEx( $model, 'cover' ); ?>
        <?php $this->widget(
            'FileUploadWidget',
            array(
                'model'       => $model,
                'attribute'   => 'cover',
                'action'      => Yii::app()->createUrl( '/tip/default/upload' ),
                'htmlOptions' => $model->disabledForManager( 'cover' ),
                'options'     => "{
				dataType: 'json',
				add: function (e, data) {
					$('#tipCover').attr('src', '/images/loader.gif');
					data.submit();
				},
				done: function (e, data) {
					if(data.result.status==true){
						$('#tipCover').attr('src', data.result.cover.src);
						$('#Tips_cover').val(data.result.cover.filename);
					}else{
						$('#tipCover').attr('src', 'https://cdn1.iconfinder.com/data/icons/phuzion/PNG/Signs%20%26%20Symbols/Error.png');
					}
				}}",
            )
        );
        ?>
        <?= CHtml::image( $model->coverOriginal, '', array( 'id' => 'tipCover' ) ); ?>
        <?= $form->error( $model, 'cover' ); ?>
    </div>

    <?php foreach (Yii::app()->urlManager->languages as $lang): ?>
        <?php $sufix = ($lang == 'en') ? '' : "_{$lang}"; ?>
        <div class="lang lang_<?= $lang ?>">
            <?=
            $form->textFieldRow(
                $model,
                "selection{$sufix}",
                array_merge( array( 'class' => 'span5', 'maxlength' => 100 ), $model->disabledForManager( 'selection' ) )
            ); ?>
        </div>
    <?php endforeach ?>

    <?=
    $form->textFieldRow(
        $model,
        'selection_num',
        array_merge( array( 'class' => 'span5', 'maxlength' => 10 ), $model->disabledForManager( 'selection_num' ) )
    ); ?>

    <?=
    $form->textFieldRow(
        $model,
        'odds',
        array_merge( array( 'class' => 'span5', 'maxlength' => 10 ), $model->disabledForManager( 'odds' ) )
    ); ?>

    <?=
    $form->textFieldRow(
        $model,
        'stake',
        array_merge( array( 'class' => 'span5', 'maxlength' => 50 ), $model->disabledForManager( 'stake' ) )
    ); ?>

    <?=
    $form->textFieldRow(
        $model,
        'profit',
        array_merge( array( 'class' => 'span5', 'maxlength' => 10 ), $model->disabledForManager( 'profit' ) )
    ); ?>

    <?= $form->labelEx( $model, 'tip_result' ); ?>

    <?php foreach (Yii::app()->urlManager->languages as $lang): ?>
        <?php $sufix = ($lang == 'en') ? '' : "_{$lang}"; ?>
        <div class="lang lang_<?= $lang ?>">
            <?=
            $form->dropDownList(
                $model,
                "tip_result{$sufix}",
                $model->tipResultList,
                array_merge(
                    array( 'class' => 'span5' ),
                    $model->TipResultDisabled
                ),
                $model->disabledForManager( 'tip_result' )
            ); ?>
        </div>
    <?php endforeach ?>

    <?=
    $form->textFieldRow(
        $model,
        'match_result',
        array_merge( array( 'class' => 'span5', 'maxlength' => 20 ), $model->disabledForManager( 'match_result' ) )
    ); ?>

    <?php foreach (Yii::app()->urlManager->languages as $lang): ?>
        <?php $sufix = ($lang == 'en') ? '' : "_{$lang}"; ?>
        <div class="lang lang_<?= $lang ?>">
            <?=
            $form->textFieldRow(
                $model,
                "meta_k{$sufix}",
                array_merge( array( 'class' => 'span5', 'maxlength' => 250 ), $model->disabledForManager( 'meta_k' ) )
            ); ?>
            <?=
            $form->textFieldRow(
                $model,
                "meta_d{$sufix}",
                array_merge( array( 'class' => 'span5', 'maxlength' => 250 ), $model->disabledForManager( 'meta_d' ) )
            ); ?>
        </div>
    <?php endforeach ?>

    <?= $form->labelEx( $model, 'comments' ); ?>
    <?=
    $form->dropDownList(
        $model,
        'comments',
        array(
            Yii::t('tips', 'Нет'),
            Yii::t('tips', 'Да'),
        ),
        array( 'class' => 'span5' )
    ); ?>

    <div class="form-actions">
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'buttonType' => 'submit',
                'type'       => 'primary',
                'label'      => $model->isNewRecord ? Yii::t( 'tips', 'Создать' ) : Yii::t( 'tips', 'Сохранить' ),
            )
        ); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>