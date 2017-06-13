<?php	
	require "libs/dborders.php";
	echo "<link rel='stylesheet' type='text/css' href='style.css'>";
	$data = $_POST;
	if (isset($data['add_new_order']))
	{
		$errors = array();
		if ($data['name'] == '')
		{
			$errors[] = 'Введите наименование услуги!';
		}
		if ($data['price'] == '')
		{
			$errors[] = 'Введите цену услуги!';
		}
		if (R::count('nameprice', "name = ?", array($data['name'])) > 0)
		{
			$errors[] = 'Такая услуга уже существует!';
		}

		if (empty($errors))
		{
			// Все ок, добавляем
			$add = R::dispense('nameprice');
			$add->name = $data['name'];
			$add->price = $data['price'];
			R::store($add);
			echo '<div style="color: green;">Добавление прошло успешно!</div><hr>';
		}
		else
		{			
			echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
		}
	}
?>
<?php
echo "<h1>Добавление услуги</h1>";
echo "<div class='services'><form  action='/orders_admin.php' method='POST'> 
		<p><strong> Наименование услуги </strong></p>
			<input type='text' name='name' >
		<p><strong> Цена услуги </strong></p>
			<input type='text' name='price'>
		<p>
			<button class='addNamePrice' type='submit' name='add_new_order'>Добавить услугу</button>
		</p>
		</form></div>";
?>

<!-- СПИСОК АКТИВНЫХ ЗАДАЧ -->
<br> 
<div class"activzad">
<h1>Активные задачи</h1>
<form action="orders_admin.php" method="post">
<?php  // запихать в main
	$orders = R::getAll("SELECT * FROM services WHERE status='0'");
	echo "<table border='1'>";
	foreach ($orders as $value) {
		printf("<tr><td><input type='checkbox' name='dell[]' value='%s'></td>", $value['id']);
		printf("<td>%s</td>", $value['name']);
		printf("<td>%s</td>", $value['price']);
		printf("<td>%s</td>", $value['address']);
		printf("<td>%s</td>", $value['client']);
		echo "</tr>";
		//printf("<td>%s</td>", $value['status']);
	}
	echo "</table>";
?>
<p><input type="submit" value="Завершить"></p>
</form>
</div>
<?php // обработчик завершения Активных Задач
	
	if (!empty($_POST['dell']))
	{
		foreach($_POST['dell'] as $el)
		{
			R::begin();
			try {
				R::exec("UPDATE services SET status = '1' WHERE id='$el'");
				echo '<div style="color: green;">Завершение прошло успешно!</div><hr>';
			}
			catch( Exception $e)
			{
				R::rollback();
				echo '<div style="color: red;">'.$e.'</div><hr>';
			}
		}
		exit("<meta http-equiv='refresh' content='0; url= orders_admin.php'>");
	}
?>



<!-- СПИСОК ЗАВЕРШЕННыХ ЗАДАЧ -->
<br> 
<div class"endzad">
<h1>Завершенные задачи</h1>
<form action="orders_admin.php" method="post">
<?php  
	$orders = R::getAll("SELECT * FROM services WHERE status='1'");
	$idx = 1;
	echo "<table border='1'>";
	foreach ($orders as $value) {
		printf("<tr><td><input type='checkbox' name='dellzad[]' value='%s'></td>", $value['id']);
		printf("<td>%s</td>", $value['name']);
		printf("<td>%s</td>", $value['price']);
		printf("<td>%s</td>", $value['address']);
		printf("<td>%s</td>", $value['client']);
		if ($idx%4 === 0)
		{
			echo "</tr><tr>";
		}
		$idx++;
	}
	echo "</table>";
?>
<p><input type="submit" value="Удалить задачу"></p>
</form>
</div>
<?php // обработчик удаления ЗАВЕРШЕННЫХ ЗАДАЧ
	if (!empty($_POST['dellzad']))
	{
		foreach($_POST['dellzad'] as $el)
		{
			R::begin();
			try {
				R::exec("DELETE FROM services WHERE id='$el'");
				echo '<div style="color: green;">Удаление прошло успешно!</div><hr>';
			}
			catch( Exception $e)
			{
				R::rollback();
				echo '<div style="color: red;">'.$e.'</div><hr>';
			}
		}
		exit("<meta http-equiv='refresh' content='0; url= orders_admin.php'>");
	}
?>



<!-- СПИСОК УСЛУГ -->
<br>
<h1>Список услуг</h1>
<form action="orders_admin.php" method="post">
<?php  // РАЗБИТЬ ВСЕ ПО БЛОКАМ КРАСИВО
	$orders = R::getAll("SELECT * FROM nameprice");
	echo "<table border='1'>";
	foreach ($orders as $value) {
		printf("<tr><td><input type='checkbox' name='dellname[]' value='%s'></td>", $value['id']);
		printf("<td>%s</td>", $value['name']);
		printf("<td>%s</td>", $value['price']);
		echo "</tr>";
	}
	echo "</table>";
?>
<p><input type="submit" value="Удалить"></p>
</form>
<?php // обработчик удаления УСЛУГ
	if (!empty($_POST['dellname']))
	{
		foreach($_POST['dellname'] as $el)
		{ 
			R::begin();
			try {
				R::exec("DELETE FROM nameprice WHERE id='$el'");
				echo '<div style="color: green;">Удаление прошло успешно!</div><hr>';
			}
			catch( Exception $e)
			{
				R::rollback();
				echo '<div style="color: red;">'.$e.'</div><hr>';
			}
		}
		exit("<meta http-equiv='refresh' content='0; url= orders_admin.php'>");
	}
?>
<p><a href="/">На главную </a></p>