<div>
    <b><h1><?php echo Yii::t( 'masterclass', 'Заявка на мастер-класс' ) ?></h1></b>
    <div></div>
    <p>
        <b><?php echo Yii::t( 'masterclass', 'От' ) ?></b>: <?php echo $model->name ?>
    </p>
    <div></div>
    <p>
        <b><?php echo Yii::t( 'masterclass', 'Email' ) ?></b>: <?php echo $model->email ?>
    </p>
    <div></div>
    <p>
        <b><?php echo Yii::t( 'masterclass', 'Тип' ) ?></b>:
        <?php echo $model->type == 'seminar' ? Yii::t( 'masterclass', 'Семинар' ) : Yii::t( 'masterclass', 'Вебинар' ) ?>
    </p>
    <div></div>
    <p>
        <b><?php echo Yii::t( 'masterclass', 'Удобное время' ) ?></b>: <?php echo $model->time ?>
    </p>
    <div></div>
    <p>
        <b><?php echo Yii::t( 'masterclass', 'Детали' ) ?></b>:
        <br/><?php echo $model->details ?>
    </p>
</div>