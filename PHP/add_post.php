<?php

// Нужно привести к виду: SQL-запрс id пользователя -> name & ava
// Необходима проверка формы id !
$get_id = isset($_POST['id']) ? $_POST['id'] : false;
// $max_legend = (int)size;

/* Подключаем БД */

try {
    $DBH = new PDO("mysql:host=$host;dbname=$dbname", 'root', 'root');
    $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    
    // $STH = $DBH->prepare('SELECT id FROM users WHERE id = (name=":id")')->execute();
    // $STH->execute($get_id);
} catch (PDOException $ex) {
    //echo "Хьюстон, у нас проблемы."; //   alert to user
    file_put_contents('logs/PDOErrors.txt', $ex->getMessage(), FILE_APPEND);
}

// $get_ava = isset($_POST['ava']) ? $_POST['ava'] : false;
// $get_name = isset($_POST['name']) ? $_POST['name'] : false;

// Уникальные данные нового поста

$get_time = time(); // timestamp

$upload_dir = 'assets/images/posts/';
$image_path = $upload_dir . basename($_FILES['userfile']['name']);
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $image_path)) {
    echo "Файл корректен и был успешно загружен.\n";
} else {
    false;
    // echo "Возможная атака с помощью файловой загрузки!\n";
}

// Необходима проверка формы tags !
$get_tags = isset($_POST['tag_input']) ? explode(',', $_POST['tag_input']) : false; // приводим тэги из строчного вида к массиву
// $max_tags = 16;
// Необходима проверка формы legend !
$get_legend = isset($_POST['legend_input']) ? $_POST['legend_input'] : false;
// $max_legend = (int)size;

$new_post = [
    [
        /*
        'name' => [
            'ava' => $get_ava,
            'name' => $get_name,
        ],
        */
        'user_id' => $get_id,
        'date' => $get_time, // timestamp
        'content' => $image_path, // link to post_image file
        'likes' => 0, // set likes counter to 0
        'tags' => $get_tags, // => array
        'legend' => $get_legend,
    ],
];

/* Пишем пост в БД */

try {
    $STH = $DBH->prepare("INSERT INTO posts (user_id, date, content, likes, tags, legend) values (:user_id, :date, :content, :likes, :tags, :legend)");
    $STH->execute($new_post);
    $DBH = null;
} catch (PDOException $ex) {
    file_put_contents('logs/PDOErrors.txt', $ex->getMessage(), FILE_APPEND);
}

//$json = json_encode($new_post, JSON_UNESCAPED_UNICODE);
//file_put_contents('posts.json', $json);