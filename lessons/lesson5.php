<?php

if (empty($_GET['login'])) {
    echo 'Пустая';
} else {
    echo 'Есть данные';
}

echo '</br>';

$html = '<a href = "vk.com">VK</a>';
$startPos = strpos($html, '"') + 1;
$hrefOffset = strpos($html, '"', $startPos);
$endPos = $hrefOffset - $startPos;
$link = substr($html, $startPos, $endPos);
echo $link;

echo '</br>';

$login = 'admin';
$password = 'qwerty123';


//сумма четных от 0 до 1000 без учета промежутка [200;400]
$sum = 0;
for ($i = 0; $i <= 1000; $i += 2) {
    $i < 200 || $i > 400 ? $sum += $i : false;
}
echo 'Искомая сумма = ' . $sum . '</br>'. '</br>';

$array = [ -5, 6, 0, 34, -98, 1003, 3, 1212 ];
if (count($array)) {
    $min = $array[0];
    $i = 1;
    foreach ($array as $value) {
        $value < $min ? $min = $value : false;
    };
	echo 'Минимум массива = ' . $min . '</br>';
} else {
    echo 'Нет элементов в массиве.' . '</br>';
}



/*
if ($login == 'admin' && $password == 'qwerty123') {
    echo 'Вход';
} else {
    echo 'Логин или пароль не верны';
}
*/

$getLogin = isset($_GET['login']) ? $_GET['login'] : false;
//echo $getLogin ? $getLogin : 'Логин не указан'; <- работает только в новом PHP
echo '</br>';
$getPassword = isset($_GET['password']) ? 'pass' : false;
echo '</br>';

echo ($login == isset($_GET['login']) && $password == isset($_GET['password'])) ?
    'Вход':
    'Логин не верен';

echo '</br>';


echo '<pre>';
print_r($_REQUEST);
echo '</pre>';
echo '<pre>';
print_r($_GET);
echo '</pre>';
echo '<pre>';
print_r($_SERVER);
echo '</pre>';
echo '</br>';
var_dump($GLOBALS);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

