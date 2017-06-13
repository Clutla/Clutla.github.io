<?php
	require "libs/db.php";
	$data = $_POST;
	if (isset($data['do_login']))
	{
		$errors = array();
		$user = R::findOne('users', 'login = ?', array($data['login']));
		if ($user)
		{
			// Логин существует, нужно проверить пароль
			if ( ($data['password']) == $user->password)
			{
				// все ок, логиним пользователя
				$_SESSION['logged_user'] = $user;
				echo '<div style="color: green;">Вы авторизованы!<br> Можно перейти на <a href="/">главную</a> страницу.</div><hr>';
			}
			else
			{
				$errors[] = 'Введен неверный пароль!';
			}
		}
		else
		{
			$errors[] = 'Пользователь с таким логином не найден!';
		}

		if (!empty($errors))
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
					<a href="partners.php">ПАРТНЕРЫ</a>
				</li>
				<li>
					<a href="orders.php">ЗАКАЗЫ</a>
				</li>
				<li>
					<a href="employees.php">Сотрудники</a>
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
		<form action="login.php" method="POST">
			<p>
				<p><strong> Логин </strong></p>
				<input type="text" name="login" value="<?php echo @$data['login']; ?>">
			</p>
			<p>
				<p><strong> Пароль </strong></p>
				<input type="password" name="password" value="<?php echo @$data['password']; ?>">
			</p>
			<p>
				<button type="submit" name="do_login">Авторизоваться</button>
			</p>
		</form>
	</div>
</header>

<main>	
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
