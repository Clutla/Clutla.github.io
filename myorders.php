<?php	
	require "libs/dborders.php";
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
	</header>

<main>
<?php
	echo "<h1 align='center'>Активные заказы</h1>"; 
	$login = $_SESSION['logged_user']->login;
	$orders = R::getAssoc("SELECT * FROM services WHERE client='$login' AND status='1'");
	$idx = 1;
	echo "<table border='1' valign='middle' align='center'>";
	echo "<th>Вид услуги</th><th>Цена</th><th>Адрес</th><th>Пользователь</th>";
	foreach ($orders as $value) {
		printf("<tr><td>%s</td>", $value['name']);
		printf("<td>%s</td>", $value['price']);
		printf("<td>%s</td>", $value['address']);
		printf("<td>%s</td></tr>", $value['client']);
		if ($idx%4 === 0)
		{
			echo "</tr><tr>";
		}
		$idx++;
	}
	echo "</table>";

	echo "<br>";
	echo "<h1 align='center'>Завершенные заказы</h1>"; 
	$login = $_SESSION['logged_user']->login;
	$orders = R::getAssoc("SELECT * FROM services WHERE client='$login' AND status='0'");
	$idx = 1;
	echo "<table border='1' valign='middle' align='center'>";
	echo "<th>Вид услуги</th><th>Цена</th><th>Адрес</th><th>Пользователь</th>";
	foreach ($orders as $value) {
		printf("<tr><td>%s</td>", $value['name']);
		printf("<td>%s</td>", $value['price']);
		printf("<td>%s</td>", $value['address']);
		printf("<td>%s</td></tr>", $value['client']);
		if ($idx%4 === 0)
		{
			echo "</tr><tr>";
		}
		$idx++;
	}
	echo "</table>";
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