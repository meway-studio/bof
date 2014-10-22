<tr class="rows">
    <td class="event">
        <?php echo CHtml::tag( 'i', array( 'class' => 'flag ' . $data->flag_1 ), '' ); ?>
        <?php ?>
        <span><?php echo CHtml::link( $data->club_1 . ' vs ' . $data->club_2, array( '/tip/default/view', 'id' => $data->id ) ); ?></span>
    </td>
    <td class="date" style="width: 200px;"><?php echo $data->format_event_date; ?></td>
    <td class="tipster"><?php echo CHtml::link( $data->tipster->FullName, array( '/tip/default/stat', 'id' => $data->tipster_id ) ); ?></td>
    <td class="stake"><?php echo CHtml::link(
            Yii::t( 'tips', 'Читать' ),
            array( '/tip/default/view', 'id' => $data->id ),
            array( 'class' => 'btn-blue' )
        ); ?></td>
</tr>