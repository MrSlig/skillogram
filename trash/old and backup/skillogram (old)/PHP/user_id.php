<?php

// AUTH
// what's with cookies? Mind of pros and cons of auth by session/cookies & let user choose in the end

$static_salt = 'qwerty123@canthack';    // look for spicy static salt
// individual user salt
function random_salt()
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ @#%$*^`~?!.,-_=+';
    $random_salt = '';
    for ($i = 0; $i < 32; $i++) {
        $random_salt = $characters[rand(0, strlen($characters))];
    }
    return $randsalt;
}

// $_POST['login'], $_POST['password'], $_POST['type']

function user_id($post_login, $post_password, $post_type, $static_salt) {
    
    $dsn = 'mysql:dbname=skillogram;host=localhost';
    $user = 'root';
    $password = 'root';

    $dbh = new PDO($dsn, $user, $password);
    
    if(isset($post_login) && isset($post_password) && isset($post_type)) {
        // looking for equal login
        $stmt = $dbh->prepare('SELECT id, login, salt, password FROM users WHERE login = ?');
        $stmt->execute([$post_login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC); // what exactly happening in sql request? (my guess: forming array :0)

        if ($_POST['type'] === 'new') {
            if ( ! $user) { // is statement correct?
                $salt = random_salt();
                $stmt = $dbh->prepare('INSERT INTO users (login, password, salt) VALUES (:login, :password, :salt)');
                $stmt->execute([
                    ':login' => $post_login,
                    ':salt' => $salt,
                    ':password' => md5($post_password . $static_salt . $salt),  // !WARNING! md5 useage
            ]);
            } else {
                echo 'Данный логин уже существует!';
            }
        }

        // var_dump($stmt->queryString);    // testing

        if ($post_type === 'auth') {        
            // cheking for password equation
            if ($user && $user['password'] === md5($post_password . $static_salt . $user['salt'])) {  // !WARNING! md5 useage
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user'] = $user['login'];
            } else {
                echo 'Неверный логин или пароль.';  // Необходимо мягко возвращать уведомление пользователю внутри нашей формы
            }
            }
    }
}

// Переделать блокб подтверждающий авторизацию
if (isset($_SESSION['user_id'])) {
    echo 'Авторизован пользователь: ' . $_SESSION['user'];
} else {
    echo 'Авторизация не удалась!';  // Необходимо мягко возвращать уведомление пользователю внутри нашей формы
}