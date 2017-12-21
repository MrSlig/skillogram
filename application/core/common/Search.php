<?php
/**
 * Class Search
 */
class	Search  {

	/* 1. SEARCH TAGS CHECK */
	// checks that tags string matches regular expression and splits it in array. Rework this part.
	// also, for now user can post same tags == bad
	public static function	searchRegular($searchTags)  {
		$regExpression		=	"/^(#[[:alnum:]]+)$/";
	    preg_match($regExpression, (string)$searchTags, $regTags); // writing down searched tags if they pass check
	    if (isset($regTags[1])) {	// $regularTags[1] is a first matched tag
	    	$searchValid	=	array_shift($regTags);	// cuts the text that matched the full pattern from $reg_tags[0].
    		//Beware! if tere is 1 tag to serch it will be string instead array
	    } else {
	    	$searchValid	=	false;
	    }
		return	$searchValid;
	}
	// необходимо: возвращать поисковый запрос в форму поиска, указывать пользователю на недопустимые символы, уведомлять о ненайденных тегах и подсвечивать найденные


	/* 2. SEARCH ID'S OF POSTS CONTAINING TAGS ARRAY */
	// searches post id's by given tags (wip: sort them by relevance)
	public static function	searchedIDs($dbh, $searchTags)  {
		$query			=	'SELECT `id`, `tags` FROM `posts` WHERE `tags` = ?';
		$stmt			=	$dbh->prepare($query);
		$searchList		=	implode(', ', (array)$searchTags);
		$stmt->execute([$searchList]);
		$searchedIDs	=	$stmt->fetch(PDO::FETCH_ASSOC);
		if (is_null($searchedIDs)) {
			$searchedIDs	=	false;
		}
		return	$searchedIDs;
	}


	/* 3. STEPPED SEARCH BY TAGS */
	// uses all search step functions
	public static function	steppedSearch($dbh, $searchTags)    {
		// part 1
		if (isset($searchTags)) {
			// think about it, do you really need this check?
			$searchValid	=	self::searchRegular($searchTags);
		} else {
			$searchValid	=	false;	// brakes on this part
			echo 'Упс! Кто-то опять искал <null>!';
		}
		// part 2
		if ($searchValid) {	// if search tags passed regular expression check
			$searchedIDs	=	self::searchedIDs($dbh, $searchValid);
			if ($searchedIDs) {
				$searchedPosts		=	CallPosts::byId($dbh, $searchedIDs);
				if($searchedPosts){
					return	$searchedPosts;	// GOT IT!
				} else {
					$searchedPosts	=	false;
					echo	'Упс! Кто-то случайно базу данных пользовательских публикаций!';
				}
			} else {
				echo	'Таких тегов (' . $_GET['search_tags'] . ') у нас еще не было. (0_o) </br>
						Пожалуйста, уточните свой поисковый запрос или создайте новый пост с таким тегом. (^_^)';
			}
		} else {	// if regular expression check failed
			echo	'Эти теги (' . $_GET['search_tags'] . ') написаны некорректно. (X_x) </br>
					Пожалуйста, скорректируйте свой поисковый запрос. (^_^)';
		}
	}
}