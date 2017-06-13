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
	
<h1 class="title_new_order" align="center">Введите данные заказа</h1>

	<form action="neworder.php" method="post" align="center">
	<p>
		<select type="submit" name="select" onchange="this.form.submit()"> 
		<option disabled <?php if(empty($_POST['select'])) echo " selected ";?> >Выберите услугу</option>
		<?php
		$name = R::getAssoc('SELECT * FROM nameprice');
		if (empty($_POST['select']))
		foreach ($name as $value) {
			printf("<option value='%s'>%s</option>", $value['name'],$value['name']);
		}
		else
		{
			printf("<option selected>%s</option>", $_POST['select']);
			foreach ($name as $value) 
			{
				printf("<option name='name'>%s</option>", $value['name']);
			}
		}
		?>
	</select></p>
	
	<p><strong>Цена услуги</strong></p>
	<?php
	if (isset($_POST['select']))
	{
     	$select = $_POST['select'];
     	$price = R::getAssoc("SELECT * FROM nameprice WHERE name='$select'");
     	foreach ($price as $value)
     	{
     		
     		printf("<input type='text' name='price' readonly
 			value='%s'>", $value['price']);
     	}
 	}	
 	else
 		echo "<input type='text'  readonly>";
	?>
	<p><strong>Введите адрес</strong></p>
	<input type="text" name="address">

	<p>
		<button type='submit' name='new_order'>Оформить заказ</button>
	</p>
</form>

<?php //ОБРАБОТКА ФОРМЫ 
	$data = $_POST;
	if (isset($data['new_order']))
	{
		$errors = array();
		if ($data['price'] == '')
		{
			$errors[] = 'Выберите тип услуги!';
		}
		if ($data['address'] == '')
		{
			$errors[] = 'Введите адрес!';
		}

		if (empty($errors))
		{
			// Все ок, добавляем
			$add = R::dispense('services');
			$add->name = $data['select'];
			$add->price = $data['price'];
			$add->address = $data['address'];
			$add->client = $_SESSION['logged_user']->login;
			R::store($add);
			echo '<div style="color: green;">Добавление прошло успешно!</div><hr>';
		}
		else
		{			
			echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
		}
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