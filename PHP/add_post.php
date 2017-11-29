<?php

$get_ava = isset($_POST['ava']) ? $_POST['ava'] : false;
$get_name = isset($_POST['name']) ? $_POST['name'] : false;
$get_date = date('Y-m-d H:i:s');
$get_image = isset($_POST['img_input']) ? $_POST['img_input'] : false;
$get_tags = isset($_POST['tag_input']) ? $_POST['tag_input'] : false;
$get_legend = isset($_POST['legend_input']) ? $_POST['legend_input'] : false;

$new_post = [
    [
        'user' => [
            'ava' => $get_ava,
            'name' => $get_name,
        ],
        'date' => $get_date,
        'content' => $get_image,
        'likes' => 0,
        'tags' => $get_tags,
        'legend' => $get_legend,
    ],
];

$json = json_encode($new_post, JSON_UNESCAPED_UNICODE);
//file_put_contents('posts.json', $json);