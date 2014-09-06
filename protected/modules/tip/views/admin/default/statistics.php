<?php
$this->breadcrumbs = array(
    Yii::t( 'tips', 'Советы' ) => array( 'index' ),
    Yii::t( 'tips', 'Вычисление статистики' ),
);
?>

<div style="float: left;">
    <input type="text" class="dp" name="Date[from]" id="from"/>

    <br/>
    <input type="text" class="dp" name="Date[to]" id="to"/>

    <br/>
    <?php echo CHtml::dropDownList(
        'tipster_id',
        '',
        CMap::mergeArray(
            array( Yii::t( 'tips', 'Выберите аналитика' ) ),
            CHtml::listData(
                User::model()->byRole( User::ROLE_TIPSTER )->findAll(),
                'id',
                'FullName'
            )
        ),
        array( 'id' => 'tipster_id' )
    ) ?>
</div><img src="/images/loader.gif" style="width: 75px; height: 75px; margin-left: 20px; display: none;" class="calc-preloader">
<div>&nbsp;</div>
<table class="detail-view table table-striped table-condensed" id="statistics">
    <tbody>
    <tr class="odd">
        <th><?php echo Yii::t( 'tips', 'Все' ); ?></th>
        <td id="count_all"></td>
    </tr>
    <tr class="odd">
        <th><?php echo Yii::t( 'tips', 'Выиграли' ); ?></th>
        <td id="count_won"></td>
    </tr>
    <tr class="even">
        <th><?php echo Yii::t( 'tips', 'Потерял' ); ?></th>
        <td id="count_lost"></td>
    </tr>
    <tr class="odd">
        <th><?php echo Yii::t( 'tips', 'Пустые' ); ?></th>
        <td id="count_void"></td>
    </tr>
    <tr class="even">
        <th><?php echo Yii::t( 'tips', 'Прибыль' ); ?></th>
        <td id="profit_all"></td>
    </tr>
    <tr class="odd">
        <th><?php echo Yii::t( 'tips', 'Доход' ); ?></th>
        <td id="yield_all"></td>
    </tr>
    <tr class="even">
        <th><?php echo Yii::t( 'tips', 'Ставка' ); ?></th>
        <td id="stake_all"></td>
    </tr>
    </tbody>
</table>

<div class="form-actions">
    <button class="btn btn-primary" type="button" id="calculate"><?php echo Yii::t( 'tips', 'Вычислить' ); ?></button>
</div>

<script type="text/javascript">

    $('.dp').datepicker({'showAnim': 'fold', 'showOn': 'button', 'buttonImage': '/themes/classic/css/images/calendar_icon.png', 'buttonImageOnly': true, 'dateFormat': 'dd-mm-yy'});

    $("#calculate").click(function() {

        var from = $("input.hasDatepicker#from").val();
        var to = $("input.hasDatepicker#to").val();
        var tipsterId = $("#tipster_id").val();

        if (from == '' || to == '') {
            return false;
        }

        $('.calc-preloader').show();
        $.post('/admin/tip/default/calc', {from: from, to: to, 'tipster_id': tipsterId},function(json) {

            for (i in json) {
                $("#" + i).text(json[i]);
            }

            $('.calc-preloader').hide();
        }, 'json').always(function() {
            $('.calc-preloader').hide();
        }).fail(function() {
            alert('Error!');
        });

        return false;
    });
</script>

<style type="text/css">
    .ui-datepicker-trigger {
        margin: 0 0 12px 5px;
    }
</style>