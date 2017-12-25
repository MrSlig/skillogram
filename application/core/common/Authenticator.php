<?php
/**
 * Class Authenticator
 *  PERSISTENT LOGIN (COOKIE-BASED)
 *
 *  Description:
 *  The implementation is no more difficult and requires no more resources than Miller's design. From the summary above,
 *  only items 2 and 3 change:
 *
 *  1. When the user successfully logs in with Remember Me checked, a login cookie is issued in addition to the standard
 *     session management cookie.[*]
 *  2. The login cookie contains the user's username, a series identifier, and a token. The series and token are
 *     unguessable random numbers (or sring) from a suitably large space. All three are stored together in a database table.
 *  3. When a non-logged-in user visits the site and presents a login cookie, the username, series, and token are
 *     looked up in the database.
 *
 *  1. If the triplet is present, the user is considered authenticated. The used token is removed from the database.
 *     A new token is generated, stored in database with the username and the same series identifier, and a new login
 *     cookie containing all three is issued to the user.
 *  2. If the username and series are present but the token does not match, a theft is assumed. The user receives
 *     a strongly worded warning and all of the user's remembered sessions are deleted.
 *  3. If the username and series are not present, the login cookie is ignored.
 *
 *  It is critical that the series identifier be reused for each token in a series. If the series identifier were
 *  instead simply another one time use random number, the system could not differentiate between a series/token pair
 *  that had been stolen and one that, for example, had simply expired and been erased from the database.
 *
 *  Conclusion:
 *  This system has all the advantages of Miller's original approach. Additionally:
 *  An attacker is only able to use a stolen cookie until the victim next accesses the web site instead of for the
 *  full lifetime of the remembered session.
 *  When the victim next accesses the web site, he will be informed that the theft occurred.
 *  This system is used by the Persistent Login module for the Drupal content management system.
 *
 *  [*] For the most secure result, the standard session management cookie should be a "session" cookie that expires
 *  as soon as the Web browser is closed. Furthermore, the server should enforce a fairly short maximum lifetime
 *  on sessions even if the browser remains open.
 *
 *  see also: http://jaspan.com/improved_persistent_login_cookie_best_practice
 *  2do: last logged info; user actions log; reset avatar, pass, user info, etc.
 */
class	Authenticator   {
    private $columns	=   '`login`, `token`, `serial`, `date`';	// session data columns

	/* 1. CHECK LOGIN STATUS */
	// logged = true, !logged = false
	public static function  loginStatus(PDO $dbh)   {
		$status =	false; // default logged status

		if (isset($_SESSION['login']) && isset($_SESSION['token'])) {
			// should we tell user if $_SESSION['token']
			// was deleted?

			$query	=	'SELECT `login`, `token`, `date` '
						. 'FROM `sessions` '
						. 'WHERE `login` = ?';
			$login	=	$_SESSION['login'];

			$stmt	=	$dbh->prepare($query);
			$stmt->execute($login);

			$passport	=	$stmt->fetch(PDO::FETCH_ASSOC);

			$status		=	$passport['token']	==	$_SESSION['token'] ? true : false;
			// if there is mismatch what should we do exactly?
		} else {
			$status	    =	authCookie($dbh);
		}
		if (!$status) {
			$msg	    =	'Пожалуйста, выполните вход.';
			Authorization::redirectLogin($msg);
		}
	}


	/* 2. CHECK AUTH COOKIE */
	// description placeholder
	public static function	authCookie(PDO $dbh)    {
		// checks existion:
		if (isset($_COOKIE['login']) && isset($_COOKIE['token']) && isset(($_COOKIE)['serial'])) {

			// if all auth cookie parameters are set, prepare:
			$query	=	'SELECT '
						. self::columns
						. ' FROM `sessions` WHERE `login` = ?';
			$login	=	$_COOKIE['login'];
			$token	=	$_COOKIE['token'];
			$serial	=	$_COOKIE['serial'];
			$date	=	$_COOKIE['date'];

			// looks for equal user_id entry in sql db:
			$stmt	=	$dbh->prepare($query);
			$stmt->execute($login);

			$passport	=	$stmt->fetch(PDO::FETCH_ASSOC);

			if (isset($passport['login'])) {
				// VALIDATES COOKIE DATA:
				// 1. checks token:
				if ($passport['token']	==	$_COOKIE['token'])	{
					// 2. checks serial:
					if ($passport['serial']	==	$_COOKIE['serial'])	{

						// resets user auth cookie and token entry in sql db:
						// delete old auth cookie and record: 
						self::deleteCookie();
                        self::deleteRecord($dbh, $login);

						// reset auth cookie, record, session:
						Session::createSession($dbh, $login);

						return	true;
					} else {
						// FUBAR!; report user last entry date: smbd probably messed with their cookies (read: account)!
						// OR user logged from other device =)
					}
				} else {
					// user auth cookie corrupted; user redirected to login (+add report?)
					return false;
				}
			}
		} else {
			return false;
		}
	}


	/* 3. CREATE SESSION */
	// starts user session
	public static function	createSession(PDO $dbh, $login) {
		session_start(['cookie_lifetime'	=>	20 * MINUTE, ]);	// starting user session; mind of cookies lifetime

		$token	=	Functions::genRandStr(32);	// where is collisions check?!
		$time	=	time();

		$_SESSION['login']	=	$login;
		$_SESSION['token']	=	$token;
		$_SESSION['date' ]	=	date($time);

		// WARNING: record first, because cookie sets data from DB!
        self::createRecord($dbh, $login, $token, $time);
        self::createCookie($dbh, $login);
		return true;
	}


	/* 5. DEL OLD TOKEN FROM DB */
	// deletes our old user token and serial from sql db
	public static function	deleteRecord(PDO $dbh, $login)  {
		$query	=	'DELETE FROM sessions WHERE login= ?';	// is it correct?
		$stmt	=	$dbh->prepare($query);
		$stmt->execute($login);
		return	true;
	}


	/* 6. WRITE NEW TOKEN TO DB */
	// saves our user token and serial to sql db for later comparing with cookies
	public static function	createRecord($dbh, $login, $token, $date)   {
		$serial	=	Functions::genRandStr(32);	// where is collisions check?!

		$query	=	'INSERT INTO `sessions` ('
					. self::columns
					. ') VALUES (:login, :token, :serial, :date);';
		
		$stmt = $dbh->prepare($query);
		$stmt->execute([':login'	=>	$login, 
						':token'	=>	$token, 
						':serial'	=>	$serial,
						':date'		=>	$date, ]);
		return	true;
	}


	/* 7. DEL OLD AUTH COOKIE */
	// unsets user auth cookie data & and kills session
	public static function	deleteCookie()  {
		setcookie('login',	 '', 1, '/');	//existion endpoint sent back in 1970.01.01 00.00.01
		setcookie('token',	 '', 1, '/');
		setcookie('serial',	 '', 1, '/');	//it's also will be good to find
		setcookie('date',	     '', 1, '/');	//examples in google
		return	true;
	}


	/* 8. SET NEW AUTH COOKIE */
	// sets user auth cookie data. Expires MONTH later.
	public static function	createCookie(PDO $dbh, $login)  {
		$query		=	'SELECT '
						. self::columns
						. 'FROM `sessions` WHERE `login` = ?';
		$stmt = $dbh->prepare($query);
		$stmt->execute($login);

		$passport	=	$stmt->fetch(PDO::FETCH_ASSOC);
        //range '/' = whole site:
		setcookie('login',	$passport['login'],		$passport['date'] + MONTH, '/');
		setcookie('token',	$passport['token'],		$passport['date'] + MONTH, '/');
		setcookie('serial',	$passport['serial'],	$passport['date'] + MONTH, '/');
		setcookie('date',	    $passport['date'],		$passport['date'] + MONTH, '/');
		return	true;
	}
}

/* OLD CODE:
// $token = $_SESSION['token'] = md5(uniqid(), true);
// uniqid = gen uniq id with current microsec prefix
// md5 returns row binary (16 symbols instead of 32; base 16)

<section class="parent">
	
	<div class="child">
		
		<?php

			if (!Session::checkLiginState($dbh))
			{
				header("location:login.php");
				exit();
			}
	
			echo 'Welcome' . $_SESSION['login'] . '!';

		?>

	</div>

</section>
*/