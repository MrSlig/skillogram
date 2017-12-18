<?php
/*
	FOR `users` TABLE SQL MANAGMENT
*/
class	CallUsers
{
	// default SELECT sql request for users table:
	$select	=	'SELECT `id`, `login`, `salt`, `password`, `avatar` ';
	// default LIMIT sql request for users table:
	$limit	=	'LIMIT 0, ' . MAX_USER_CALL;

	/* 1. CALL USERS BY ID */
	// returns array of user data asked by users id
	public static function	byId($dbh, $id[]) {
	    // $usersAmount = count($id);	// idk, why i asked amount =/
	    $query	=	$this->select . 'WHERE `id` = ?' . $this->limit;
		$stmt	=	$dbh->prepare($query);
		$stmt->execute([$id]);
		$askedUsers	=	$stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if (is_null($askedUsers)) {
			$askedUsers	=	false;
		}

		return	$askedUsers;
	}


	/* 2. CALL USERS BY LOGINS */
	// returns array of user data asked by users logins
	public static function	byLogin($dbh, $logins[]) {

	    $query	=	$this->select . 'WHERE `login` = ?' . $this->limit;
		$stmt	=	$dbh->prepare($query);
		$stmt->execute([$logins]);
		$askedUsers	=	$stmt->fetchAll(PDO::FETCH_ASSOC);
		
		if (is_null($askedUsers)) {
			$askedUsers	=	false;
		}

		return	$askedUsers;
	}


	/* n. SORT USERS BY LOGIN */
	// returns array of user data asked by users logins in alphabet order
	public static function	sortLogin() {
			// CODE
		}

		return	$askedUsers;
	}
}