<div class="site-width">
    <div class="active-tips">

        <div class="title">
            <span class="bold"><?php echo Yii::t( 'tips', 'Советы по' ); ?></span>
            <span> <?php echo Yii::t( 'tips', 'по ходу игры' ); ?></span>
        </div>


        <?php foreach ($model AS $data): ?>
            <?php $this->render( '_nb_tip', array( 'data' => $data ) ); ?>
        <?php endforeach; ?>

    </div>
</div>