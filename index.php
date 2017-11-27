<!DOCTYPE html>
<html lang="ru">

<head>
	<title>Skillogram</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="reset.css">
	<link rel="stylesheet" type="text/css" href="CSS/main.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<meta name="description" content="Skillogram covers current SkillUp basic PHP course.">
	<style>[data-columns]::before{visibility:hidden;position:absolute;font-size:1px;}</style>
</head>

<div id="warning-container">
	<i data-reactroot=""></i>
</div>

<body>

	<!--::before-->

	<header class="header">

		<?php
		$head = include 'PHP/header.php';
		echo $head;
		?>

	</header>

	<span class="tags_sort">
		<ul>
			<li><button>#1tag</button></li>
			<li><button>#2tag</button></li>
			<li><button>#3tag</button></li>
			<li><button>#4tag</button></li>
			<li><button>#5tag</button></li>
			<li><button>#6tag</button></li>
			<li><button>#7tag</button></li>
			<li><button>#8tag</button></li>
		</ul>
	</span>

	<main class="layout">

		<!--::before-->

		<h2 class="layout_title">Content</h2>

			<?php
			$arti = include 'PHP/article.php';
			echo $arti;
			echo $arti;
			echo $arti;
			echo $arti;
			echo $arti;
			echo $arti;
			?>

		<div class="break"></div>
	</main>
	
	<footer class="footer">

		<?php
		$foot = include 'PHP/footer.php';
		echo $foot;
		?>

	</footer>
</body>
</html>

<!--
http://terminator-gtk3.readthedocs.io/en/latest/	-	terminator man;
https://regex101.com/	-	regular expressions check;
-->
