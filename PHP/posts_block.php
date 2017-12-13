<?php

/* this is OLD. Time to swap from file to sql db */
function content_decode ($content_file) {    
if (file_exists($content_file)) {
    $json = file_get_contents($content_file);
} else {
    //something to be done
    $json = 'no file to decode';
}
$posts = json_decode($json, true);
return $posts;
}

$posts = content_decode ('assets/posts.json');
/* end of exttracting posts data from our db */

/* defining date size */
define("YEAR", 362 * 24 * 60 * 60);
define("MONTH", 30 * 24 * 60 * 60);
define("DAY", 24 * 60 * 60);
define("HOUR", 60 * 60);
define("MINUTE", 60);
/* date size defined */

/* Function for making single post (post carcass) */
function make_article($posts, $i, $j, $tags) {

// Необходимо создать модуль, подтягивающий имя и аватару пользователя по его id, а не хранить это в массиве постов
// стоит ли тащить целый массив $posts каждый раз при выполнении  функции? Конечно же нет, исправь
// поправь html-тело поста

$passed_time_ago = passed_time(time()); // временно передаю текущее время вместо таймстампа поста из БД
$post_date = date('Y-m-d H:i:s', time());   // this part is not showed to user; <time datetime="' . $post_date . '">

$article = '

<article class="post">

	<!--::before-->

	<div class="post_header">

		<a class="post_user_link" href="#">

			<img class="post_user_ava" src="' . $posts[$i]['user']['ava'] . '" alt="^_^" />

			<h3 class="post_user_name">
				' . $posts[$i]['user']['name'] . '
			</h3>

		</a>

		<a class="post_date_link" href="#">
                        <h4 class="post_date">
                            <time datetime="' . $post_date . '">' . $passed_time_ago . '</time>
			</h4>
		</a>

	</div>

	<figure class="post_main">

		<img class="post_img" src="' . $posts[$i]['content'] . '" alt="Post image (ASCII pic add)"/>

		<figcaption>
                        
                        <div class="post_legend">'
                            . $posts[$i]['legend'] .
                        '</div>
                        
			<div class="post_downbar">

				<button class="post_likes">'
					. $posts[$i]['likes'] .
				'</button>
				<button class="post_download">
					
				</button>

			</div>
                        
			<div class="post_tags">'
                            . $tags .
                        '</div>

		</figcaption>

	</figure>

	<!--::after-->

</article>';

return $article;
}

/* FORMING POST BLOCK */

/* 1. time post was published */

$passed_time_ago = 'время публикации не указано';
function passed_time($timestamp) {
    if(isset($timestamp)) {
        $passed_time = time() - $timestamp;
        $passed_time_ago = 'опубликовано';
        $n = 0;
        if (($n = $passed_time % YEAR) > 0) {
            $n = ($passed_time - $n) / YEAR;
            $passed_time_ago .= $n < 5 ? (string)$n . 'года назад' : (string)$n . 'лет назад';
        } elseif (($n = $passed_time % MONTH) > 0) {
            $n = ($passed_time - $n) / MONTH;
            $passed_time_ago .= $n < 5 ? (string)$n . 'месяца назад' : (string)$n . 'месяцев назад';
        } elseif (($n = $passed_time % DAY) > 0) {
            $n = ($passed_time - $n) / DAY;
            $passed_time_ago .= $n < 5 ? (string)$n . 'дня назад' : (string)$n . 'дней назад';
        } elseif (($n = $passed_time % HOUR) > 0) {
            $n = ($passed_time - $n) / HOUR;
            $passed_time_ago .= $n < 5 ? (string)$n . 'часа назад' : (string)$n . 'часов назад';
        } elseif (($n = $passed_time % MINUTE) > 0) {
            $n = ($passed_time - $n) / MINUTE;
            $passed_time_ago .= $n < 5 ? (string)$n . 'минуты назад' : (string)$n . 'минут назад';
        } else {
            $passed_time_ago = 'только что опубликован';
        }
    }
    return $passed_time_ago;
}

/* 2. tags check & sort by search*/

/* HAHAHAHAHAHAHAHAAH GETIING %23 instead # => FAIL
 * also, look for ',' and ' ' replacements
 * and, assuming that, write correct regular expression input check
 */

if (isset ($_GET['search_tag'])) {
    preg_match ("/^(#[[:alnum:]]+)$/", $_GET['search_tag'], $regular_tags); // writing down searched tags if they pass check
    $s_tags = array_shift($regular_tags); // cuts the text that matched the full pattern from $reg_tags[0]. Beware! if tere is 1 tag to serch it will be string instead array
} else {
    // нужно будет дать сигнал пользователю о некорректном вводе поискового запроса
    false;
}

// counting user searched tags and forming string for exeption throw to user
if (isset($s_tags[0])) {
    $s_tags_counted = count((array)$s_tags); // number of searched tags !!!
    $s_tags_list = implode (', ', (array)$s_tags);  // <- try to find better solution
}   // exeption
// also, notice, that user dont know, which tags we don't have in our sql if one or more tags found

/* 3. data proseeding */

// инициализируем переменные (в пхп можно убрать лишние, стоит ли? NO)
$posts_counted = count($posts);
$post_block = '';
$article = '';

for ($i = 0; $i < $posts_counted; $i++) { // перебираем посты
    
    $tags = '';
    $tags_counted = count($posts[$i]['tags']);  // собираем тэги
    for ($j = 0; $j < $tags_counted; $j++) {
        $no_hash = substr($posts[$i]['tags'][$j], 1);
        $tags .= '<a href="index.php?search_tag=%23' . $no_hash . '">' . $posts[$i]['tags'][$j] . '</a>, ';
        
        // i want to hightlight searched tags, when they are showed on page; mb add class to html code?
        $asked = true;  // проверяем на наличие поискового запроса
        if (isset($s_tags_counted)) {
            for ($k = 0; $k < $s_tags_counted; $k++) {  // проверяем соответствие поисковому запросу
                if ($posts[$i]['tags'][$j] == (array)$s_tags[$k]) { //!!!
                    $asked = true;
                } else {
                    $asked = false;
                }
                break; // прерываем сверку тэгов
            }
        }
    }

    if ($asked) {
        $tags = substr($tags, 0, -2); // cutting last comma from the post tags block
        $article = make_article($posts, $i, $j, $tags, $passed_time_ago); // записывем данные поста в его html-форму
        $post_block .= $article;    // записывем обработанный пост в выводимый контент-лист
    }
}

// 5. search exeption
$post_block .= ($post_block == '') ? 'Таких тегов (' . $s_tags_list . ') у нас еще не было. (0_o) </br> Пожалуйста, уточните свой поисковый запрос или создайте новый пост с таким тегом. (^_^)': '';

return $post_block;