<?php	
	require "libs/dbpartners.php";
	
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
</header>
<h1 class="title_partners" align="center">Наши партнеры</h1>
<form action="dell_partners.php" method="post">
	<?php
		$employees = R::getAll('SELECT * FROM partners');
		$idx = 1;
		echo "<table border='1' valign='middle' align='center'>";
		echo "<th>Партнер</th><th>Страна</th><th>Город</th><th>Сайт</th><th>Телефон</th><th>E-mail</th><th>Специализация</th>";
		foreach ($employees as $value) {
			printf("<tr><td><input type='checkbox' name='dell[]' value='%s'></td>", $value['id']);
			printf("<td>%s</td>", $value['partner']);
			printf("<td>%s</td>", $value['country']);
			printf("<td>%s</td>", $value['city']);
			printf("<td>%s</td>", $value['site']);
			printf("<td>%s</td>", $value['phone']);
			printf("<td>%s</td>", $value['mail']);
			printf("<td>%s</td>", $value['specialization']);

			if ($idx%7 === 0)
			{
				echo "</tr><tr>";
			}
			$idx++;
		}
		echo "</table>";
	?>
<p><input type="submit" value="Удалить партнера"></p>
</form>

<?php // обработчик удаления партнеров
	if (!empty($_POST['dell']))
	{
		foreach($_POST['dell'] as $el)
		{
			R::begin();
			try {
			R::exec("DELETE FROM partners WHERE id='$el'");
			echo '<div style="color: green;">Удаление прошло успешно!</div><hr>';
			}
			catch( Exception $e)
			{
			R::rollback();
			echo '<div style="color: red;">'.$e.'</div><hr>';
			}	
		}
		exit("<meta http-equiv='refresh' content='0; url= dell_partners.php'>");
	}
?>

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