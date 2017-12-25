<?php
/**
 * Class ProcessPost
 */
class   ProcessPost {
    /* 1. PASSED TIME */
    // приводит timestamp к виду "опубликовано N <greaterDataUnits> назад" + 'Y-m-d H:i:s'
    public function     formatDate($timestamp)  {
        if(isset($timestamp)) {	// !NULL check
            $timer      = time() - $timestamp;
            $passedTime = 'опубликовано ';
            $units      = 0;	// counts greaterDataType units passed
            if (($units = $timer % YEAR) > 0) {
                $units = ($timer - $units) / YEAR;
                $passedTime .= (string)$units;
                if ($units <= 4) {
                	$passedTime .= $units == 1 ? ' год' : ' года';
                } else {
                	$passedTime .= ' лет';
                }
                $passedTime     .= ' назад';
            } elseif (($units = $timer % MONTH) > 0) {
                $units = ($timer - $units) / MONTH;
                $passedTime .= (string)$units;
                if ($units <= 4) {
                	$passedTime .= $units == 1 ? ' месяц' : ' месяца';
                } else {
                	$passedTime .= ' месяцев';
                }
                $passedTime     .= ' назад';
            } elseif (($units = $timer % DAY) > 0) {
                $units = ($timer - $units) / DAY;
                $passedTime .= (string)$units;
                if ($units <= 4) {
                	$passedTime .= $units == 1 ? ' день' : ' дня';
                } else {
                	$passedTime .= ' дней';
                }
                $passedTime     .= ' назад';
            } elseif (($units = $timer % HOUR) > 0) {
                $units = ($timer - $units) / HOUR;
                $passedTime .= (string)$units;
                if ($units <= 4) {
                	$passedTime .= $units == 1 ? ' час' : ' часа';
                } else {
                	$passedTime .= ' часов';
                }
                $passedTime     .= ' назад';
            } elseif (($units = $timer % MINUTE) > 0) {
                $units = ($timer - $units) / MINUTE;
                $passedTime .= (string)$units;
                if ($units <= 4) {
                	$passedTime .= $units == 1 ? ' минуту' : ' минуты';
                } else {
                	$passedTime .= ' минут';
                }
                $passedTime     .= ' назад';
            } else {
                $passedTime     = 'только что ' . $passedTime;
            }
        } else {	// happens, when there is no timestamp
        	$passedTime = 'опубликовано давным-давно в далекой далекой галактике...';
        }
        $postDate['posted'] =   date('Y-m-d H:i:s', time());
        $postDate['passed'] =   $passedTime;
        return  $postDate;
    }
    // next step: make it tiny and cute, but more precise + localization check (advanced)


    /* 2. FORMAT TAGS TO LINKS */
    // returns html tags links with search requests according to tags names
    public function formatTags($tags)   {
        $tagsArray  = explode (', ', $tags);
        $tagsAmount = count($tagsArray);
        $tagsLinks  = '';
        for ($i = 0; $i < $tagsAmount; $i++) {  // собираем тэги со встроенной поисковой ссылкой
            $noHash     = substr($tags[$i], 1); // костыль вида %23 == # (и он может должен работать - проверь (режь больше знаков))
            $tagsLinks .= '<a href="/skillogram/main/search?search_tags=%23' . $noHash . '">' . $tags[$i] . '</a>, ';
        }
        $tagsLinks  = substr($tagsLinks, 0, -2); // cutting last comma from the post tags block
        return  $tagsLinks;
    }


    /* 3. MAKE POSTS DATA ARRAY */
    //
    public function postsBlock(PDO $dbh, $posts)    {
        $filled = count((array)$posts); // checking required minimum of posts
        $filled = $filled > POSTS_ON_PAGE ? POSTS_ON_PAGE : $filled;
        for ($i = 0; $i < $filled; $i++) { // перебираем посты
            $user[] = CallUsers::byId($dbh, $posts[$i]['user_id']);   // constructing $user[]; bad case, study sql JOIN
            if (isset($post[$i]['tags'])) { // constructing tagsLinks
                $tagsLinks = $this->formatTags($posts[$i]['tags']);
            } else {
                $tagsLinks = '...'; // shame on author, no post tags
            }
            $date[] = $this->formatDate($posts[$i]['date']);    // constructing $date[]
            // specimen of post data            
            $postUnit = [
                'user'      => [
                    'avatar'    => $user['avatar'],
                    'login'     => $user['login'],
                ],
                'date'      => [
                    'posted'    => $date['posted'],
                    'passed'    => $date['passed'],
                ],
                'content'   => [
                        $posts[$i]['image'],
                        $posts[$i]['legend'],
                        $posts[$i]['likes'],
                        $tagsLinks,
                ],
            ];
            $data[] =   $postUnit;
        }
        return  $data;
    }
}