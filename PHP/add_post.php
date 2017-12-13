<?php

// Нужно привести к виду: SQL-запрс id пользователя -> name & ava
// Необходима проверка формы id !
$get_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
// $max_legend = (int)size;

/* Подключаем БД */

try {
    $DBH = new PDO("mysql:host=$host;dbname=$dbname", 'root', 'root');
    $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    
    // $STH = $DBH->prepare('SELECT id FROM users WHERE id = (name=":id")')->execute();
    // $STH->execute($get_id);
} catch (PDOException $ex) {
    echo "Не удалось подключится к базе данных сервера."; //   alert to user; make it eyecandy
    file_put_contents('logs/PDOErrors.txt', $ex->getMessage(), FILE_APPEND);
}

// Уникальные данные нового поста

$get_time = time(); // timestamp

$upload_dir = 'assets/images/posts/';
$image_path = $upload_dir . basename($_FILES['userfile']['name']); //   (current size = 256 char)
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $image_path)) {
    echo "Файл корректен и был успешно загружен.\n";
} else {
    false;
    // echo "Возможная атака с помощью файловой загрузки!\n";
}

// Необходима проверка формы tags (by regular expression) ! (current size = 256 char); sql default is set to (varchar)#tabula rasa
// You can always try to call tags from sql db by it's id, should you do it?
// приводим тэги из строчного вида к массиву (1)разбиваем по запятой и обрезаем пробелы 2)убираем повторы):
$get_tags = isset($_POST['tag_input']) ? array_unique(array_walk(explode(',', $_POST['tag_input']), 'trim_value')) : false;
$tags_length = count($get_tags);    // array size
$tags_length > 16 ? array_splice ($get_tags, ($tags_length - 1)) : false;   // cheking tags array size (in theory it would remove all tags after N16)

// Необходима проверка формы legend !  (current size = 256 char); sql default is set to NULL
$get_legend = isset($_POST['legend_input']) ? $_POST['legend_input'] : false;
// $max_legend = (int)size;

$new_post = [
    [
        'user_id' => $get_id,
        'date' => $get_time, // timestamp; sql default is set to (timestamp)current_timestamp
        'content' => $image_path, // link to post_image file
        'likes' => 0, // set likes counter to 0; sql default is set to (int)0
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

/* OLD! Adding new post to posts.json
 * 
 * $json = json_encode($new_post, JSON_UNESCAPED_UNICODE);
 * file_put_contents('posts.json', $json);
 */