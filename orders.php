<?php	
	require "libs/db.php";
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
	</header>

<main>
<?php 
if ($_SESSION['logged_user']->status > 0)
echo "<p>
		<a href='neworder.php'><button class='newOrder' name='newOrder'>Сделать заказ</button></a>
	</p>
	<p>
		<a href='myorders.php'><button class='myOrder' type='submit' name='myOrder'>Мои заказы</button></a>
	</p>";
	
?>
<?php 
	if ($_SESSION['logged_user']->status >= 3)
		echo "<a class='orders_admin' href='orders_admin.php'> Админ панель заказов </a>";
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