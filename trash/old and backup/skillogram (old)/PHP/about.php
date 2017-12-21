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

		<h2 class="layout_title">О Skillogram</h2>

		<span class="about">
			<h3>Информация о проекте</h3>
			<div>
				<p>Данный сайт является результатом прохождения курса программирования на языке PHP, созданного командой SkillUp.</p>
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