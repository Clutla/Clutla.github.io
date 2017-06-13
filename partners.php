<?php	
	require "libs/dbpartners.php";

	$data = $_POST;
	if (isset($data['do_post']))
	{
		$errors = array();
		if ($data['partner'] == '')
		{
			$errors[] = 'Введите имя партнера!';
		}

		if (empty($errors))
		{
			// Все ок, добавляем
			$partners = R::dispense('partners');
			$partners->partner = $data['partner'];
			$partners->country = $data['country'];
			$partners->city = $data['city'];
			$partners->site = $data['site'];
			$partners->phone = $data['phone'];
			$partners->mail = $data['mail'];
			$partners->specialization = $data['specialization'];
			R::store($partners);
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
	<h1 class="title_partners" align="center">Наши партнеры</h1>
	<?php
		$employees = R::getAssoc('SELECT * FROM partners');

		echo "<table border='1' valign='middle' align='center'>";
		echo "<th>Партнер</th><th>Страна</th><th>Город</th><th>Сайт</th><th>Телефон</th><th>E-mail</th><th>Специализация</th>";
		foreach ($employees as $value) {
			printf("<tr><td>%s</td>", $value['partner']);
			printf("<td>%s</td>", $value['country']);
			printf("<td>%s</td>", $value['city']);
			printf("<td>%s</td>", $value['site']);
			printf("<td>%s</td>", $value['phone']);
			printf("<td>%s</td>", $value['mail']);
			printf("<td>%s</td>", $value['specialization']);
		}
		echo "</table>";
	?>

<?php // Вывод кнопки "ДОБАВИТЬ ПАРТНЕРА" 
	echo "<br><br><br>";
	if ($_SESSION['logged_user']->status >= 3)
	{ 
		echo "<form class='partners' action='/partners.php' method='POST'> 
		<strong class='partner1'> Партнер </strong>
		<div class='partner'><input type='text' name='partner' ></div>
		<strong class='country1'> Страна </strong>
		<div class='country'><input type='text' name='country'></div>
		<strong class='city1'> Город </strong>
		<div class='city'><input type='text' name='city' ></div>
		<strong class='sayt1'>Сайт</strong>
		<div class='sayt'><input type='text' name='site'></div>
		<strong class='phone1'> Телефон </strong> 
		<div class='phone'><input type='text' name='phone' ></div>
		<strong class='mail1'> E-mail </strong> 
		<div class='mail'><input type='text' name='mail'></div>
		<strong class='specialization1'> Специализация </strong>
		<div class='specialization'><input type='text' name='specialization' ></div>
		<p>
			<button class='addPartners' type='submit' name='do_post'>Добавить партнера</button>
		</p>
		</form>";
	
		echo "<p>
			<a href='dell_partners.php' class='dell_partners'>Удалить партнера</a>
			</p>";
	}
	
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