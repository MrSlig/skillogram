<?php

$dsn = 'mysql:dbname=skillogram_710;host=127.0.0.1';
$user = 'root';
$password = 'root';

$dbh = new PDO($dsn, $user, $password);

$stmt = $dbh->prepare(''
        . 'SELECT * '
        . 'FROM images '
        . 'WHERE type = :type'
        . 'AND id > :id');
$stmt->bindValue('type', 'jpg', PDO::PARAM_STR);
$stmt->bindValue('id', 4, PDO::PARAM_INT);
$stmt->execute();

var_dump($stmt->fetchAll());

/* TASK */

$stmt = $dbh->prepare(''
        . 'SELECT *'
        . 'FROM id'
        . 'WHERE id > :id');
$stmt->bindValue('id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();

/* task end */

$dbh->prepare('UPDATE images SET type = :type WHER id = :id');
$stmt->execute([
    'type' => $_GET['type'],
    'id' => $_GET['id'],$row
]);

$stmt = $dbh->prepare('SELECT * FROM images WHERE id = :id');
$stmt->execute([
    'id' => $_GET['id'],
]);$row
while($row = $stmt->fetch()) {
    var_dump($row);
}
var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));