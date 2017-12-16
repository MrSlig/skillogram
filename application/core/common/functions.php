<?php

// PLEASE, REORGANIZE TO CATEGORYS AND NUMBERED LISTS. ADD DESCRIPTION AND VALID NAMES. DOUBLECHECK WORKABILITY.

/* 1. PASSED TIME */
// приводит timestamp к виду "опубликовано N <greaterDataUnits> назад" + 'Y-m-d H:i:s'
public function formatDate($timestamp) {
    if(isset($timestamp)) {	// !NULL check

        $timer = time() - $timestamp;
        $passedTime = 'опубликовано ';
        $units = 0;	// counts greaterDataType units passed

        if (($units = $timer % YEAR) > 0) {
            $units = ($timer - $units) / YEAR;
            $passedTime .= (string)$units;
            $passedTime .= $units <= 4 ? ' года' :' лет';
            $passedTime .= ' назад';

        } elseif (($units = $timer % MONTH) > 0) {
            $units = ($timer - $units) / MONTH;
            $passedTime .= (string)$units;
            $passedTime .= $units <= 4 ? ' месяца' : ' месяцев';
            $passedTime .= ' назад';

        } elseif (($units = $timer % DAY) > 0) {
            $units = ($timer - $units) / DAY;
            $passedTime .= (string)$units;
            $passedTime .= $units <= 4 ? ' дня' : ' дней';
            $passedTime .= ' назад';

        } elseif (($units = $timer % HOUR) > 0) {
            $units = ($timer - $units) / HOUR;
            $passedTime .= (string)$units;
            $passedTime .= $units <= 4 ? ' часа' : ' часов';
            $passedTime .= ' назад';

        } elseif (($units = $timer % MINUTE) > 0) {
            $units = ($timer - $units) / MINUTE;
            $passedTime .= (string)$units;
            $passedTime .= $units <= 4 ? ' минуты' : ' минут';
            $passedTime .= ' назад';

        } else {
            $passedTime = 'только что ' . $passedTime;
        }
    } else {	// happens, when there is no timestamp
    	$passedTime = 'опубликовано давным-давно в далекой далекой галактике...';
    }
    $date['posted'] = date('Y-m-d H:i:s', time());
    $date['passed'] = $passedTime;
    
    return $postDate;
}
// next step: make it tiny and cute, but more precise + localization check (advanced)


/* 2. SEARCH TAGS CHECK */
// checks that tags string matches regular expression and splits it in array. Rework this part.
// also, for now user can post same tags == bad
public function searchRegular((string)$searchTags) {
    preg_match ("/^(#[[:alnum:]]+)$/", $searchTags, $regularTags); // writing down searched tags if they pass check
    if (isset($regularTags[1])) {	// $regularTags[1] is a first matched tag
    	$searchValid = array_shift($regularTags); // cuts the text that matched the full pattern from $reg_tags[0]. Beware! if tere is 1 tag to serch it will be string instead array
    } else {
    	$searchValid = false;
    }
	return $searchValid;
}
// необходимо: возвращать поисковый запрос в форму поиска, указывать пользователю на недопустимые символы, уведомлять о ненайденных тегах и подсвечивать найденные


/* 3. SEARCHED POSTS ID */
// searches post id's by given tags (wip: sort them by relevance)
public function searchedIDs($searchValid[]) {
	$stmt = $dbh->prepare('SELECT `id`, `tags` FROM `posts` WHERE `tags` = ?');
	$searchList = implode(', ', (array)$searchValid);
	$stmt->execute([$searchList]);
	$searchedIDs = $stmt->fetch(PDO::FETCH_ASSOC);
	if (is_null($searchedIDs)) {
		$searchedIDs = false;
	}
	return $searchedIDs;
}


/* 4. PREPARE POSTS BY ID */
// returns array of post data asked by id's 
public function CallPostsById($postId[]) {
	$stmt = $dbh->prepare('SELECT `id`, `user_id`, `date`, `image`, `likes`, `tags`, `legend` WHERE `id` = ? LIMIT 0, ' . POSTS_ON_PAGE);
	$searchList = implode(', ', (array)$postId);
	$stmt->execute([$searchList]);
	$askedPosts = $stmt->fetch(PDO::FETCH_ASSOC);
	if (is_null($askedPosts)) {
		$askedPosts = false;
	}
	return $askedPosts;
}


/* 5. PREPARE POSTS BY DATE */
// returns array of post data asked by timestamp !wip!
public function CallPostsByDate() {
	$stmt = $dbh->prepare('SELECT `id`, `user_id`, `date`, `image`, `likes`, `tags`, `legend` WHERE `id` = ? LIMIT 0, ' . POSTS_ON_PAGE);
	$stmt->execute([$searchList]);
	$askedPosts = $stmt->fetch(PDO::FETCH_ASSOC);
	if (is_null($askedPosts)) {
		$askedPosts = false;
	}
	return $askedPosts;
}


/* 6. PREPARE POSTS BY RATE */
// returns array of post data asked by rating(likes) !wip!
public function CallPostsByRate() {
	$stmt = $dbh->prepare('SELECT `id`, `user_id`, `date`, `image`, `likes`, `tags`, `legend` WHERE `id` = ? LIMIT 0, ' . POSTS_ON_PAGE);
	$stmt->execute([$searchList]);
	$askedPosts = $stmt->fetch(PDO::FETCH_ASSOC);
	if (is_null($askedPosts)) {
		$askedPosts = false;
	}
	return $searchedPosts;
}


/* 7. FORMAT TAGS TO LINKS */
// returns html tags links with search requests according to tags names
public function formatTags($tags[]) {
    $tagsArray = explode (', ', $tags[]);
    $tagsAmount = count($tagsArray);
    $tagsLinks = '';
    for ($i = 0; $i < $tagsAmount; $i++) {  // собираем тэги со встроенной поисковой ссылкой
        $noHash = substr($tags[$i], 1);	// костыль вида %23 == # (и он может должен работать - проверь (режь больше знаков))
        $tagsLinks .= '<a href="/skillogram/main/search?search_tags=%23' . $noHash . '">' . $tags[$i] . '</a>, ';
    }
    $$tagsLinks = substr($tagsLinks, 0, -2); // cutting last comma from the post tags block 
    return $tagsLinks;
}

/* 8. CALL USER BY ID */
// !wip!
public function CallUserById($id[]) {

}

/* 9. MAKE POSTS DATA ARRAY */
//
public function postsBlock($posts[]) {

	$filled = count($posts);	// checking required minimum of posts
	$filled = $filled > POSTS_ON_PAGE ? POSTS_ON_PAGE : $filled;

	for ($i = 0; $i < $filled; $i++) { // перебираем посты

		$user = CallUserById;	// constructing $user[]

		if (isset($post['tags'])) {	// constructing tagsLinks
			$tagsLinks = formatTags($post['tags']);
		} else {
			$tagsLinks = '...';	// shame on auther, no post tags
		}

	    $date = formatDate($post['date']);	// constructing $date[]

		// specimen of post data	        
	    $postUnit = [
	    	'user' => [
	    		'avatar' => $user['avatar'],
	    		'login' => $user['login'],
	    	],
	    	'date' => [
	    		'posted' => $date['posted'],
	    		'passed' => $date['passed'],
	    	],
	    	'content' => [
	    		$post['image'],
	    		$post['legend'],
	    		$post['likes'],
	    		$tagsLinks,
	    	],
	    ];
	    $data[] = $postUnit;
	}
	return $data;
}

/* 10. STEPPED SEARCH */
// uses all search step functions
public function steppedSearch($searchTags[]) {
	// part 1
	if (isset($searchTags)) {
		// think about it, do you really need this check?
		$searchValid = searchRegular($searchTags);
	} else {
		$searchValid = false;	// brakes on this part
		echo 'Упс! Кто-то опять искал <null>!';
	}

	// part 2
	if ($searchValid) {	// if search tags passed regular expression check
		$searchedIDs = searchedIDs($searchValid);
		if ($searchedIDs) {
			$searchedPosts = CallPostsById($searchedIDs);
			if($searchedPosts){
				return $searchedPosts;	// GOT IT!
			} else {
				$searchedPosts = false;
				echo 'Упс! Кто-то случайно базу данных пользовательских публикаций!';
			}
		} else {
			echo 'Таких тегов (' . $_GET['search_tags'] . ') у нас еще не было. (0_o) </br>
			Пожалуйста, уточните свой поисковый запрос или создайте новый пост с таким тегом. (^_^)';
		}
	} else {	// if regular expression check failed
		echo 'Эти теги (' . $_GET['search_tags'] . ') написаны некорректно. (X_x) </br>
		Пожалуйста, скорректируйте свой поисковый запрос. (^_^)';
	}
}