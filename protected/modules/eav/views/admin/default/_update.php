<h3>Конструктор форм Yiiii!</h3>

<style>
.box {
	border: 1px solid silver;
	min-height: 400px;
	max-height: 400px;
	float:left;
}
#preview {
	width: 300px;
	margin-left: 15px;
	overflow-y:auto;
	overflow-x:hidden;
}
#control {
	width: 500px;
}
</style>


<div id="control" class="box"></div>

<div id="preview" class="box">
	<?php $this->renderPartial('_form',array('model'=>$model)); ?>
</div>

<script>
  $(function() {
    $( "#accordion" ).accordion();
  });
  </script>