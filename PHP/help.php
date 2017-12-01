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

		<h2 class="layout_title">Помощь</h2>

		<span class="about">
			<div>
				<h3>Источники, справочники и другая информация</h3>
				<p>a: <a href="#">1</a></p>
				<p>b: <a href="#">2</a></p>
				<p>c: <a href="#">3</a></p>
				<p>d: <a href="#">4</a></p>
				<p>e: <a href="#">5</a></p>
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