<?php

/* Connecting to our sql DB (database) */

try {
	$dsn = SQL . HOST . PORT . DATABASE;
	$user = USER;
	$password = PASSWORD;

    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

} catch (PDOException $e) {
    echo "Не удалось подключится к базе данных сервера."; //   alert to user; make it eyecandy
    file_put_contents('logs/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
    die();
}