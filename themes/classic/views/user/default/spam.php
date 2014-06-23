<b>Привет, <?php echo $model->FullName;?></b>

Отправить письмо по макету 
<form method="POST">

	<select name="spamId">
		<option value="widget">Рассылка</option>
		<option value="signup">Регистрация</option>
		<option value="confirm">Подтверждение регистрации</option>
		<option value="forgot">Забыл пароль</option>
		<option value="restore">Восстановление пароля</option>
	</select>

	на <?php echo $model->email; ?> 

	<input type="submit" value="Send" />

</form>