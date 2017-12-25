<?php
/**
 * Class Authorization
 * USER AUTHORIZATION FUNCTIONS
 * Description:
 *
 */
class	Authorization   {
	/* 1. PROCESS USER INPUT */
	// process user provided login and password and logs him
	public static function	login(PDO $dbh) {
        $status		=	false;	// default status of user login attempt
		// process input data block
		if (isset($_POST['login']) && isset($_POST['password'])) {

			$login		=	$_POST['login'];
			$password	=	$_POST['password'];

			$user		=	callUsers::sortLogin($dbh, $login);

			$i			=	0;		// default counter of user login attempt
			$message		=	'';		// default message to user
			if (isset($user[1]['login'])) {
				// report multiple login attempts to user, hold record
			} else {
				if (isset($user['login'])) {
					$dbSalt     =	$user['salt'];
					$dbPassword	=	md5($user['password'] . SALT . $dbSalt, true);
					$status     =	$password == $dbPassword ? true : false;
				}
			}
			if ($status) {
				$status	=	Authenticator::createSession($dbh, $login);
			} else {
				if ($i < 10){
					$i++;
					$message	=	'Пожалуйста, убедитесь, что все поля заполнены корректно.';
					self::redirectLogin($dbh);
				} else {
					// trigger cooldown. Also, can report on user email. Also can ask password reset.
				}
			}
		} else {
			$message	=	'Пожалуйста, убедитесь, что все поля заполнены.';
			self::redirectLogin($dbh);
		}
		return	$status;
	}	


	/* 2. LOGOUT USER */
	// process user provided login and password
	public static function	logout(PDO $dbh, $login)    {
		session_destroy();	// kills user session
		self::deleteCookie();
		self::deleteRecord($dbh, $login);
		// redirect to index
		return	true;
	}


	/* 3. REDIRECT TO LOGIN */
	// redirects user to login page according to login $status
	public static function	redirectLogin($msg) {
		// redirects user to login page according to $logged status
	}


	/* 4. USER REGISTRATION */
	// process user data from registration form
	public static function	registration(PDO $dbh)  {
		// CODE
	}
}


/* 	OLD CODE:
if (Session::checkLoginState($dbh)){

	header('index.php');

} elseif (isset($_POST['login'] && isset($_POST['password']))) {
		
	$query	=	'SELECT `id`, `login`, `salt`, `password` FROM `users` 
					WHERE `login` = :login AND `password` = :password';

	$login		=	$_POST['login'];
	$password	=	$_POST['password'];

	$stmt	=	$dbh->prepare($query);
	$stmt->execute([':login'	=>	$login, 
					'password'	=>	$password]);

	$row	=	$stmt->fetch(PDO::FETCH_ASSOC);

	if($row['id'] > 0) {

		Session::createRecord($dbh, $row['login'], $row['id']);
		header('location:index.php');
	}

} else {
	// asking user to autorize
}





Session::deleteCookie();
header('location:index.php');
*/