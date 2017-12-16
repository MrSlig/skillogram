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

		<h2 class="layout_title">Поддержка проекта</h2>

		<span class="about">
			<div>
				<h3>Спасибо за Вашу поддержку!</h3>
				<p>Благодаря Вашему вниманию и <3 к нашему проекту Skillogram продолжает расти </p>
					<p>и становится лучше с каждым днем. Спасибо Вам! (=^.^=)</p>
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