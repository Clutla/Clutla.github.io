<?php	
	require "libs/db.php";

	$data = $_POST;
	if (isset($data['do_post']))
	{
		$errors = array();
		if ($data['post'] == '')
		{
			$errors[] = 'Введите должность сотрудника!';
		}
		if ($data['fio'] == '')
		{
			$errors[] = 'Введите ФИО сотрудника!';
		}

		if (empty($errors))
		{
			// Все ок, добавляем
			$post = R::dispense('employees');
			$post->post = $data['post'];
			$post->fio = $data['fio'];
			R::store($post);
			echo '<div style="color: green;">Добавление прошло успешно!</div><hr>';
		}
		else
		{			
			echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
		}

	}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<title>Защита Сервис</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
	<header>
		<div class="logo">
			<a href="index.php"> 
				<img id="logo1" src="img/logo.png" width="200" height="100">
			</a>
		</div>
		<nav class="main_nav">
			<ul>
				<li>
					<a href="/clients.php">КЛИЕНТАМ</a>
				</li>
				<li>
					<a href="/partners.php">ПАРТНЕРЫ</a>
				</li>
				<li>
					<a href="/orders.php">ЗАКАЗЫ</a>
				</li>
				<li>
					<a href="/employees.php">Сотрудники</a>
				</li>
			</ul>
		</nav>
		<div class="slider">
			<div class="slider_title">
				<a href="info.php" class="btn"> УЗНАТЬ БОЛЬШЕ </a>
			</div>
		</div>
		<!--Кнопки Входа, Авторизации -->
	
		<div class="login"> 
	<?php
		if (isset($_SESSION['logged_user'])) 
		{
			echo 'Вы авторизованы как '.$_SESSION['logged_user']->login ;
			echo '<br><a href="logout.php"> Выйти </a>';
		}
		else
		{
			echo 'Вы не авторизованы <br>';
			echo '<a href="login.php">Авторизация </a><br>';
			echo '<a href="signup.php">Регистрация </a>';
		}
			
	?>
	
		</div>

		<footer>
		</footer>
	</header>

<main>
	<?php
		$employees = R::getAssoc('SELECT * FROM employees');
		$idx = 1;
		echo "<table border='1' valign='middle' align='center'>";
		echo "<th>Должность</th><th>ФИО</th>";
		foreach ($employees as $value) {
			printf("<tr><td>%s</td>", $value['post']);
			printf("<td>%s</td></tr>", $value['fio']);

			if ($idx%3 === 0)
			{
				echo "</tr><tr>";
			}
			$idx++;
		}
		echo "</table>";
	?>

<?php // Вывод кнопки "ДОБАВИТЬ СОТРУДНИКА" 
	
	if ($_SESSION['logged_user']->status > 1)
		echo "<form class='employees' action='/employees.php' method='POST'> 
		<p><strong> Должность </strong></p>
			<input type='text' name='post' >
		<p><strong> ФИО сотрудника </strong></p>
		<input type='text' name='fio'>
		<p>
			<button class='addEmployees' type='submit' name='do_post'>Добавить сотрудника</button>
		</p>
		</form>";
	
?>
	

</main>

<footer>
	<div class="footer-left">
	<h4>Защита-Сервис</h4>
	<p class="footer-links"><a href="partners.php">Партнеры</a>
									·	   		
	<a href="orders.php">Заказы</a>
									·
	<a href="employees.php">Сотрудники</a>
									·
	<a href="info.php">Узнать больше</a></p>
	</div>

	<div class="footer-center">
	<p>ИНН:	4711006110</p>
	<p>ОГРН:	1044701613538</p>
	<p>КПП:	471101001</p>
	<p>ОКПО:	23389420</p>
	<p>ОКАТО: 41442000000 </p>
	</div>

	<div class="footer-right">
	<p>Телефон: (81365) 2-59-59</p>
	<p>E-mail: zachita-servisao@yandex.ru</p>
	<p>Дата регистрации: 16 января 2004 года</p>
	</div>
</footer>
</body>
</html>