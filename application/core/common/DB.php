<?php

/**
 * Class DB
 */
class	DB  {
	// connecting to our sql DB (database)
	public static function	connect() {
		try {
			$dsn		=	SQL . HOST . PORT . DATABASE;	//	from constants.php
			$user		=	USER;
			$password	=	PASSWORD;
		    $dbh	=	new PDO($dsn, $user, $password);
		    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		    return	$dbh;
		}	catch	(PDOException $e) {
		        echo "Критическая ошибка. Не удалось подключится к базе данных сервера."; //   alert to user; make it eye   candy
		    	file_put_contents('logs/PDOErrors.txt', $e->getMessage(), FILE_APPEND);
		        die();
		}
	}
}