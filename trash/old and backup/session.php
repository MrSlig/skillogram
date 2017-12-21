<?php
/*
	PRESISTENT LOGIN (COOKIE-BASED)

	see also: http://jaspan.com/improved_persistent_login_cookie_best_practice

	2do: last logged info; user actions log; reset avatar, pass, user info, etc.
*/
class	Session
{
	/* 1. CHECK LOGIN STATUS */
	// description placeholder
	public static function	checkLoginState($dbh)
	{
		
		// starts session:
		if (!isset($_SESSION['id'])) {	// why not Session::createSession ?
			session_start([	// starting user session
		    	'cookie_lifetime'	=>	MONTH,	// cookies lifetime
			]);
		}

		// checks our user auth cookie:
		if (isset($_COOKIE['user_id']) && isset($_COOKIE['token']) && isset($_COOKIE)['serial']) {

			// if all auth cookie parametrs are set:
			$query		=	'SELECT `id`, `user_id`, `token`, `serial`, `date` FROM `sessions` 
								WHERE `user_id` = ?; /*:user_id AND `token` = :token AND `serial` = :serial';*/
			$user_id	=	$_COOKIE['user_id'];
			$token		=	$_COOKIE['token'];
			$serial		=	$_COOKIE['serial'];

			// looks for equal user_id entery in sql db:
			$stmt	=	$dbh->prepare($query);
			/*
			$stmt->execute([':user_id'	=>	$user_id, 
							':token'	=>	$token, 
							':serial'	=>	$serial]);
			*/
			$stmt->execute($user_id);

			$passport	=	$stmt->fetch(PDO::FETCH_ASSOC);

			if ($passport['user_id'] > 0) {	// think about it!
				
				// validates cookie data :
				if ($passport['user_id']	==	$_COOKIE['user_id']	&&
					/*
					$passport['serial']		==	$_COOKIE['serial']	&&
					*/
					$row['token']			==	$_COOKIE['token'])
				{
					if ($passport['serial']	==	$_COOKIE['serial'])	{
						return true;
					}
					// checks session: (whole block is retarded: you need to check that session is set and return true; KISS)
					if ($passport['user_id']	!=	$_SESSION['user_id']	||
						$passport['token']		!=	$_SESSION['token']		||
						$passport['serial']		!=	$_SESSION['serial'])

						// if do:
						$this->createSession(	$_COOKIE['login'],	// but what about found sql entery?!
												$_COOKIE['user_id'], 
												$_COOKIE['token'], 
												$_COOKIE['serial']);
					}

					return	true;
				}

			}
		}
		// $token = $_SESSION['token'] = md5(uniqid(), true);
		// uniqid = gen uniq id with current microsec prefix
		// md5 returns row binary (16 symbols instead of 32; base 16)

	    return	$userId;
	}


	/* 2. WRITE TOKEN TO DB */
	// saves our user token and serial to sql db for later comparasing with cookies
	public static function	createRecord($dbh, $login, $user_id)
	{
		$query	=	'DELETE FROM sessions WHERE user_id= :user_id;';	// is it correct?
		$stmt	=	$dbh->prepare($query);
		$stmt->execute($user_id);

		$token	=	Functions::genRandStr(32);
		$serial	=	Functions::genRandStr(32);
		$date	=	time();

		$this->createCookie($login,	 $user_id, $token, $serial, $date);
		$this->createSession($login, $user_id, $token, $serial, $date);

		$query	=	'INSERT INTO `sessions` (`user_id`, `token`, `serial`, `date`) 
						VALUES (:user_id, :token, :serial, :date);';
		
		$stmt = $dbh->prepare($query);
		$stmt->execute([':user_id'	=>	$user_id, 
						':token'	=>	$token, 
						':serial'	=>	$serial,
						':date'		=>	$date, ]);
	}


	/* 3. SET AUTH COOKIE */
	// sets user auth cookie data. Expires MONTH later.
	public static function	createCookie($login, $user_id, $token, $serial)
	{
		$date	=	time();	// overkill?

		setcookie('user_id', $user_id,	$date + MONTH, '/');	//range '/' = whole site
		setcookie('login',	 $login,	$date + MONTH, '/');
		setcookie('token',	 $token,	$date + MONTH, '/');
		setcookie('serial',	 $serial,	$date + MONTH, '/');
		setcookie('date',	 $date,	$date + MONTH, '/');
	}


	/* 4. DEL AUTH COOKIE */
	// unsets user auth cookie data & and kills session
	public static function	deleteCookie()
	{
		$date	=	time();	// overkill?

		setcookie('user_id', '', $date - DAY, '/');	// existion point sended back in time!
		setcookie('login',	 '', $date - DAY, '/'); 
		setcookie('token',	 '', $date - DAY, '/');	// it's also will be good to find
		setcookie('serial',	 '', $date - DAY, '/');	// examples in google
		setcookie('date',	 '', $date - DAY, '/');

		session_destroy();
	}	


	/* 5. START SESSION */
	// starts user session
	public static function	createSession($login, $user_id, $token, $serial)
	{

		if (!isset($_SESSION['id'])) {	//  || !isset($_COOKIE['PHPSESSID'])
			session_start([	// starting user session
		    	'cookie_lifetime'	=>	MONTH,	// cookies lifetime
			]);
		}

		$_SESSION['login']	=	$login;

		// chek if usless or mistake:
		$date = time();

		setcookie('user_id', $user_id,	$date + MONTH, '/');	//range '/' = whole site
		setcookie('token',	 $token,	$date + MONTH, '/');
		setcookie('serial',	 $serial,	$date + MONTH, '/');	
	}

}