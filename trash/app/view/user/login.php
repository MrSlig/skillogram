<?php /** $user User */ ?>
<?php
var_dump($user);
if($user): ?>
    <p> Вы <?php echo $user->name ?></p>
<?php else: ?>
    <p>Неверный логин или пароль</p>
<?php endif; ?>