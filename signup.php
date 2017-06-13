<?php
	require "libs/db.php";
?>
<?php
		$data = $_POST;
	if (isset($data['do_signup']))
	{

		$errors = array();
		if (trim($data['login']) == '')
		{
			$errors[] = 'Введите логин!';
		}
		if ($data['password'] == '')
		{
			$errors[] = 'Введите пароль!';
		}
		if ($data['password_2'] != $data['password'])
		{
			$errors[] = 'Повторный пароль введен неверно!';
		}

		if (R::count('users', "login = ?", array($data['login'])) > 0)
		{
			$errors[] = 'Пользователь с таким логином уже существует!';
		}

		if (empty($errors))
		{
			// Все ок, регистрируем
			$user = R::dispense('users');
			$user->login = $data['login'];
			$user->password = $data['password'];
			$user->join_date = time();
			$user->status = 1;
			R::store($user);
			echo '<div style="color: green;">Регистрация прошла успешно!</div><hr>';
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
					<a href="clients.php">КЛИЕНТАМ</a>
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

<form action="/signup.php" method="POST">

	<p>
		<p><strong> Ваш логин </strong></p>
		<input type="text" name="login" value="<?php echo @$data['login']; ?>">
	</p>

	<p>
		<p><strong> Ваш пароль </strong></p>
		<input type="password" name="password">
	</p>

	<p>
		<p><strong> Введите пароль повторно </strong></p>
		<input type="password" name="password_2">
	</p>

	<p>
		<button type="submit" name="do_signup">Зарегистрироваться</button>
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
