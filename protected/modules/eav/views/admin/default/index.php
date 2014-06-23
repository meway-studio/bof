<h3>Конструктор форм Yiiii!</h3>

<style>
    .box {
        border: 1px solid silver;
        min-height: 400px;
        float: left;
    }

    #preview {
        width: 200px;
        margin-left: 15px;
    }

    #control {
        width: 600px;
    }
</style>


<div id="control" class="box"></div>

<div id="preview" class="box">

    <?php $this->renderPartial( '_form', array( 'model' => $models[ 'EavAttribute' ] ) ); ?>

</div>
