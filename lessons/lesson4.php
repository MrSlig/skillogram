<?php

$name = "Sasha";

var_dump($name);

echo '<pre>';

print_r($name);

echo '</pre>';

$login = 'admin';
$count = 0015;
$range = 18.89;
$isCheck = true;
$phone = '8800r555';

var_dump($login);
var_dump($login.' '.$count);
var_dump($range + $count);
var_dump($isCheck);
echo $isCheck;
var_dump($isCheck + $count);
var_dump($isCheck + $range);
var_dump((string)$isCheck);
var_dump((int)'a');

define('CONSTANT_PI', 3.14);

//array

$posts = [
    0 => [
        'id' => 45,
        'title' => "My post",
        'text' => "some text",
        'time' => time() - 67 + (int)$phone,
        'tags' => ['#tag1' => 'like', '#tag2' => 'love'],
        'constant' => CONSTANT_PI,
    ],
    1 => [
        'id' => 45,
        'title' => "My post",
        'text' => "some text",
        'time' => time(),
    ],
];

$posts[0]['id'] = 9001;
$posts[0]['tags'][] = '#comment';
$posts[0]['auther'] = 'Misha';

var_dump($posts);

//echo (string)$posts; <=?
echo ($posts[0]['tags'][0]);

$productsIds = [
    123, 45, 74, 14
];
$productsIds[] = 56;


var_dump($productsIds);

$posts = [];
$posts = Array();
$posts[] = [
    $productsIds[1],
];

var_dump($posts);

//echo $posts; <- mistake

echo count($posts);



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

