<?php

/*
if ( time()>= && time()<= ) {
    echo 'Идет занятие';
} elseif(14 == '14') {
    echo 'Занятие не идет';
} elseif( ) {
    echo 'Занятия закончились';
} else {
    echo 'Занятия не начались';
}


$curTime = (int)date('H'.'i', time());
var_dump($curTime);

if ($curTime >= 1900) {
    if ($curTime <= 2145) {
        echo 'Идет занятие';
        } elseif ($curTime <= 2200) {
            echo 'Занятие заканчивается';
        }
} else {
    echo 'Занятие не идет';
}

echo '</br></br>';

$type = 'select';

switch ($type) {
    case 'select':
        echo 'Запрос на выборку';
        break;
    case 'update':
        echo 'Заппрос на изменение';
        break;
    case 'insert':
        echo 'Заппрос на вставку';
        break;
    case 'delete':
        echo 'Заппрос на удаление';
        break;
    default:
        echo 'Неизвестный заапрос';
        break;
}
 

$var = 'e';

switch ($var) {
    case 1:
        echo 'один';
        break;
    case 2:
        echo 'два';
        break;
    case 3:
    case 4:
    case 5:
        echo 'три-пять';
        break;
    default:
        echo 'неизвестно';
        break;
}



for($i = 0; $i <= 10; $i++) {
    if ($i < 5) {
        continue;
    }
    if ($i == 7) {
        break;
    }
    echo $i.'</br>';
}



for($i = 0, $sum = 0; $i <= 100; $i++) {
    $sum += $i;
}
echo '<h1>'.$sum.'</h1>';

*/

$posts = [
    [
        'id' => 2,
        'title' => 'Как играть на гитаре',
    ],
    [
        'id' => 3,
        'title' => 'земля плоская',
    ],
];

foreach ($posts as $post) {
    echo $post['id']." ".$post['title'].'</br>';
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */