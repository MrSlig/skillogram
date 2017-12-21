<?php

if (isset($_POST['submit'])) {
    setcookie('colour', $_POST['colour']);
    setcookie('num1', $_POST['num1'] ?? 0);
    setcookie('num2', $_POST['num2'] ?? 0);
}

?>

<form method="post">
    <select name="colour">
        <option value="red">Красный</option>
        <option value="blue">Синий</option>
        <option value="black">Черный</option>
    </select>

<!--task-->

    </br>
    <input type="number" name="num1" />
    </br>
    <input type="number" name="num2" />
    <input type="submit" name="submit" value="Задать числа и цвет" />
</form>

<p>Цвет, записанный в cookie: <?php echo $_COOKIE['colour'] ?? 'Не задан' ?></p>
<p>Сравниваем числа в coookie: <?php 
if (isset($_COOKIE['num1']) && isset($_COOKIE['num2'])) {
    if ($_COOKIE['num1'] > $_COOKIE['num2']) {
        $equate =  $_COOKIE['num1'] . ' > ' . $_COOKIE['num2'];
    } elseif ($_COOKIE['num1'] < $_COOKIE['num2']) {
        $equate = $_COOKIE['num1'] . ' < ' . $_COOKIE['num2'];
    } else {
        $equate = $_COOKIE['num1'] . ' = ' . $_COOKIE['num2'];
    }
    echo $equate;
} else {
    echo 'Числа не заданы';
}
?>
</p>

<p>COOKIES: <?php
    if(is_array($_COOKIE)) {
        $cookie_isset = '';
        foreach ($_COOKIE as $cookie => $val) {
            $cookie_isset .= '<p>' . $cookie . ' = ' . $val . '</p>';
        }
    } else {
        $cookie_isset = 'NO COOKIE';
    }
    echo $cookie_isset;
    ?>
</p>