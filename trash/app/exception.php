<?php

try {
    $title = $_GET['title'];
    if (strlen($title) > 10) {
        throw new CustomException('Заголовок поста слишком длинный', 4);
    }

//.....

} catch (Exception $e) {
    echo 'Ошибка: ' . $e->getMessage();

} catch (Exception $e) {
    echo 'Общая ошибкка: ';
}