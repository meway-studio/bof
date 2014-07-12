<h1><?php echo Yii::t( 'messages', 'Импорт CSV файла c переводами' ) ?></h1>
<p>
    <?php echo Yii::t( 'messages', 'Формат должен соответствовать:' ) ?>
    <br/>
    <b><?php echo Yii::t( 'messages', 'category,source_lang,Название_языка1_английскими_буквами,Название_языка2_английскими_буквами,...' ) ?></b>
    <br/>
    <b><?php echo Yii::t( 'messages', 'Новая строка' ) ?></b>
    <br/>
    <b><?php echo Yii::t( 'messages', 'Категория_перевода,Оригинальный_псевдоязык,Перевод_для_языка1,Перевод_для_языка2,...' ) ?></b>
</p>
<form method="post" enctype="multipart/form-data">
    <p>
        <?php echo Yii::t( 'messages', 'Разделитель' ) ?>
        <select name="delimiter">
            <option value=";"><b>;</b> (точка с запятой)</option>
            <option value=","><b>,</b> (запятая)</option>
        </select>
    </p>
    <p>
        <input type="file" name="file"/>
    </p>
    <p>
        <input type="submit" value="<?php echo Yii::t( 'messages', 'Загрузить' ) ?>"/>
    </p>
</form>
<p>
    Так же вы можете скачать фаил со всеми переводами
    <b>
        <a href="<?php echo Yii::app()->createUrl('admin/messages/download') ?>">СКАЧАТЬ (,)</a>
        <a href="<?php echo Yii::app()->createUrl('admin/messages/download', array('delimiter' => ';')) ?>">СКАЧАТЬ (;)</a>
    </b>
    в скобочках указан разделитель
</p>