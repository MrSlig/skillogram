<div>

	<?php echo $categoriesCount; ?>
	<?php foreach ($categories as $category): ?>
			<p><?php echo $category['id'] ?> : <?php echo $category['name'] ?></p>
	<?php endforeach; ?>
</div>