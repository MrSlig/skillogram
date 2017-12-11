<?php

session_start([
    // тут лайфтайм кук
    'cookie_lifetime' => 86400 * 365,
]);

$_SESSION['colour'] = 'magenta';

if (isset($_SESSION['colour'])) {
    echo $_SESSION['colour'];
} else {
    echo 'Цвета в сессии нет.';
}

echo '</br>';
echo '</br>';
// task = count

if (isset($_SESSION['count'])) {
    $_SESSION['count']++;
} else {
    $_SESSION['count'] = 1;
}

echo ' Пользователь заходил ' . $_SESSION['count'] . ' раз.';

$users = [
    'admin' => 'password1',
    'bot' => '123',
    'user' => 'qwerty',
];

if(isset($_GET['login']) && isset($_GET['password'])) {
    if (isset($users[$_GET['login']]) && $users[$_GET['login']] === $_GET['password']) {
        $_SESSION['login'] = $_GET['login'];
    }
}

echo '</br>';

if (isset($_SESSION['login'])) {
    echo 'Logged';
} else {
    echo 'Login or passs is incorrect.';
}

// AUTH

$dsn = 'mysql:dbname=skillogram710;host=localhost';
$user = 'root';
$password = 'root';

$dbh = new PDO($dsn, $user, $password);

$salt = 'qwerty123';

if(isset($_GET['login']) && isset($_GET['password']) && isset($_GET['type'])) {
    if ($_GET['type'] === 'new') {
        $stmt = $dbh->prepare('INSERT INTO users (login, password) VALUES (:login, :password)');
        $stmt->execute([
            ':login' => $_GET['login'],
            ':password' => md5($_GET['password'] . $salt),
        ]);
    }
    
    var_dump($stmt->queryString);
    
    if ($_GET['type'] === 'auth') {
        $stmt = $dbh->prepare('SELECT id, login, password FROM users WHERE login = ?');
        $stmt->execute([$_GET['login']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && $user['password'] === md5($_GET['password']) . $salt) {
            $_SESSION['user_id'] = $user['id'];
        }
        }
}
if (isset($_SESSION['user_id'])) {
    echo 'Авторизован id = ' . $_SESSION['user_id'];
}
    
// https://infoblog1.ru/