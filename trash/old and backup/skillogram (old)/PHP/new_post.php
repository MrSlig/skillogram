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

		<h2 class="layout_title">Form: adding new post</h2>

		<span class="new_post">
			<form id="new_post_form" action="add_post.php" enctype="multipart/form-data" method="post" target="_self" accept-charset="utf-8" autocomplete="off">
				<fieldset class="new_post_form-fieldset" form="new_post_form" name="new_post_field">
					<legend class="new_post_form-legend">Создать новый пост</legend>
                                        <!-- Необходимо добавить скрытую форму имени пользователя -->
                                        <!-- Необходимо добавить проверку id формы -->
					<p><label for="id_input"><input maxlength="256" name="id_input" form="new_post_form" type="hidden" required="" type="text" /></p>
										<!-- check size (bytes?). On PHP side too -->
					<p><label for="img_input-max_size"><input name="img_input-max_size" form="new_post_form" type="hidden" value="30000" /></p>
					<p><label for="img_input"><input class="new_post_form-img_input" name="img_input" placeholder="Выберите фотографию" form="new_post_form" required="" type="file" accept="image/*" /></label></p>
					<p><label for="tag_input"><input class="new_post_form-tag_input" maxlength="256" name="tag_input" placeholder="#тег1, #тег2, #тег3..." form="new_post_form" multiple="on" pattern="^(#[[:alnum:]]+)$" required="" type="text" /></label></p>
										<!-- Необходимо добавить проверку legend формы -->
					<p><label for="legend_input"><textarea class="new_post_form-legend_input" cols="32" rows="8" maxlength="256" wrap="hard" name="legend_input" placeholder="Поделитесь историей"></textarea></label></p>
					<button class="new_post_form-butt" type="submit" form="new_post_form">Опубликовать</button>
				</fieldset>
			</form>
		</span>

	</main>

	<footer class="footer">
	<?php
	$foot = include 'footer.php';
	echo $foot;
	?>
	</footer>
</body>