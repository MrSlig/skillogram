<!DOCTYPE html>
<html lang="ru">

<head>
    <?php
    $head = include 'head.php';
    echo $head;
    ?>
</head>

<body>
	
	<header class="header">

		<?php
		$head = include 'header.php';
		echo $head;
		?>

	</header>

	<main class="layout">

		<h2 class="layout_title">Contacts</h2>

		<span class="contacts">
			<div>
                <p>Создатель: <a href="https://vk.com/an073r0ne">vk.com/an073r0ne</a></p>
                <p>e-mail: <a href="sligxiii@gmail.com">sligxiii@gmail.com</a></p> <!-- check <a> for mail -->
                <p>Курсы PHP: <a href="#">SkillUp.ru</a></p>
                <p>GitHub repository:</p>
                <p><a href="https://github.com/MrSlig/skillogram">MrSlig/skillogram</a></p>
			</div>
		</span>

	</main>

	<footer class="footer">
	<?php
	$foot = include 'footer.php';
	echo $foot;
	?>
	</footer>
</body>