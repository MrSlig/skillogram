<?php

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

//$json = json_encode($posts, JSON_UNESCAPED_UNICODE);
//file_put_contents('posts.json', $json);

$posts = content_decode ('assets/posts.json');

/* Function for making single post */

function make_article($posts, $i, $j, $tags) {

// Необходимо создать модуль, подтягивающий имя и аватару пользователя по его id, а не зранить это в массиве постов
// стоит ли тащить целый массив $posts каждый раз при выполнении  функции? Конечно же нет, исправь
// поправь html-тело поста

$passed_time_ago = passed_time(time()); // временно передаю текущее время вместо таймстампа поста
$post_date = date('Y-m-d H:i:s', time());

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

// вытащить формирование запроса по тэгам в отдельную функцию, чтобы сэкономить строки
// время пойдет в виде таймстэмпа - надо сделать преобразование к виду "n времени назад"

/* time post was published */

define("YEAR", 362 * 24 * 60 * 60);
define("MONTH", 30 * 24 * 60 * 60);
define("DAY", 24 * 60 * 60);
define("HOUR", 60 * 60);
define("MINUTE", 60);

$passed_time_ago = 'время публикации не указано';

function passed_time($timestamp) { // прошерсти название переменных для даты и приведи к нормальному виду
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

/* tags check & sort by search*/

/* HAHAHAHAHAHAHAHAAH GETIING %23 instead # => FAIL */

if (isset ($_GET['search_tag'])) {
    preg_match ("/^(#[[:alnum:]]+)$/", $_GET['search_tag'], $reg_tags); // writing down searched tags if they pass check
    $s_tags = array_shift($reg_tags); // cuts the text that matched the full pattern from $reg_tags[0]. Beware! if tere is 1 tag to serch it will be string instead array
} else {
    // нужно будет дать сигнал пользователю о некорректном вводе поискового запроса
    false;
}

// инициализируем переменные (в пхп можно убрать лишние, стоит ли?)
$post_block = '';
$article = '';

$posts_counted = count($posts);
$s_tags_counted = isset($s_tags[0]) ? count((array)$s_tags) : false;    // number of searched tags !!!
for ($i = 0; $i < $posts_counted; $i++) { // перебираем посты
    
    $tags = '';
    $tags_counted = count($posts[$i]['tags']);  // собираем тэги
    for ($j = 0; $j < $tags_counted; $j++) {
        $no_hash = substr($posts[$i]['tags'][$j], 1);
        $tags .= '<a href="index.php?search_tag=%23' . $no_hash . '">' . $posts[$i]['tags'][$j] . '</a>, ';

        $asked = true;                          // проверяем на наличие поискового запроса
        if (isset($s_tags_counted)) {
            for ($k = 0; $k < $s_tags_counted; $k++) {      // проверяем соответствие поисковому запросу
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
        $tags = substr($tags, 0, -2); // вырезаем запятую
        $article = make_article($posts, $i, $j, $tags, $passed_time_ago); // записывем данные поста в его html-форму
        $post_block .= $article;    // записывем обработанный пост в выводимый контент-лист
    }
}

// exeption
$s_tags_list = implode (', ', (array)$s_tags);  // <- try to find better solution
$post_block .= ($post_block == '') ? 'Таких тегов (' . $s_tags_list . ') у нас еще не было. (0_o) </br> Пожалуйста, уточните свой поисковый запрос или создайте новый пост с таким тегом. (^_^)': '';

return $post_block;