<?php


$posts = [
    [
        'title' => 'Новый пост',
        'text' => 'Сегодня я ел гречку',
    ],
    [
        'title' => 'Полет на Марс',
        'text' => 'Было дорого',
    ]
];

$json = json_encode($posts, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
file_put_contents('posts.json', $json);


$posts = json_decode('[{"title":"Новый пост","text":"Сегодня я ел гречку"},{"title":"Полет на Марс","text":"Было дорого"}]', true);
var_dump($posts);
echo $posts[0]['title'];

//http://www.jsoneditoronline.org/
//http://json.org/

/*
echo serialize($posts);
$posts = unserialize('a:2:{i:0;a:2:{s:5:"title";s:19:"Новый пост";s:4:"text";s:35:"Сегодня я ел гречку";}i:1;a:2:{s:5:"title";s:24:"Полет на Марс";s:4:"text";s:21:"Было дорого";}}');
echo $posts[0]['title'];
var_dump($posts);
*/