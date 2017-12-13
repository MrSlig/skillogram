<div>
    <?php echo $categoriesCount; ?>
    <?php foreach ($categories as $category): ?>
        <p><?php $category['id'] ?> : <?php echo $category['name'] ?></p>
    <?php endforeach; ?>
</div>

<!--
<div>
    <?php// echo $data['categoriesCount']; ?>
    <?php// foreach ($data['categories'] as $category): ?>
        <p><?php// $category['id'] ?> : <?php echo $category['name'] ?></p>
    <?php// endforeach; ?>
</div>
-->