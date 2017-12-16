<?php

$json = file_get_contents('posts.json');

$posts = json_decode($json, true);

foreach ($posts as $post) {
    echo $post['title'] . ' ' . $post['text'] . '</br>';
}