<?php


/**
* 
*/
class Session
{
	
	function start($token)
	{
		session_start([	// запускаем сессию
	    	'cookie_lifetime' => 86400 * 365,	// cookies lifetime
		]);
		$token = $_SESSION['token'] = md5(uniqid(), true);
		// uniqid = gen uniq id with current microsec prefix
		// md5 returns row binary (16 symbols instead of 32; base 16)

	    return $userId;
	}
}