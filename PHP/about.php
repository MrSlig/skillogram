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

		<h2 class="layout_title">About</h2>

		<span class="about">
			Some tips about the project
		</span>

	</main>

	<footer class="footer">
	<?php
	$foot = include 'footer.php';
	echo $foot;
	?>
	</footer>
</body>