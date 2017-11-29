<?php

if (file_exists('../assets/post.json')) {   
    $json = file_get_contents('../assets/post.json');
} else {
    //something to be done
    $json = 'warning';
}

$posts = json_decode($json, true);

//$json = json_encode($posts, JSON_UNESCAPED_UNICODE);
//file_put_contents('posts.json', $json);

$i = 0;
$j = 0;
$tags = '';

/* Function for making single post */

function make_article($posts, $i, $j, $tags) {

// Необходимо создать модуль, подтягивающий имя и аватару пользователя по его id, а не зранить это в массиве постов    

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
			<time datetime="2017-11-14">14 Ноября 2017</time>
			<!--<h4 class="post_date">
				' . $posts[$i]['date'] . '
			</h4>-->
		</a>

	</div>

	<figure class="post_main">

		<img class="post_img" src="' . $posts[$i]['content'] . '" alt="Post image (ASCII pic add)"/>

		<figcaption>

			<div class="post_downbar">

				<button class="post_likes">
					' . $posts[$i]['likes'] . '
				</button>
				<button class="post_download">
					
				</button>

			</div>

			<div class="post_tags">'
        . '<a href="#">' . $tags . '</a>' .
        '</div>

		</figcaption>

	</figure>

	<!--::after-->

</article>

';
return $article;
}

/* Getting search tag */

if (isset ($_GET['search_tag'])) {
    //ereg
    preg_match ("/^(#[[:alnum:]]+)$/", $_GET['search_tag'], $s_tags);
} else {
    false;
}

/* Forming posts block */

//$max_tags = 15;

$post_block = '';
$article = '';
$posts_counted = count($posts);
if (isset ($s_tags[0])) {
    for ($i = 0; $i < $posts_counted; $i++) {
        $tags = '';
        $asced = false;
        for ($j = 0, $tags_counted = count($posts[$i]['tags']); $j < $tags_counted; $j++) {
            $tags .= $posts[$i]['tags'][$j] . ', ';
            if ($posts[$i]['tags'][$j] == $s_tags[0]) {
                $asked = true;
            }           
        }
        if ($asked) {
            $tags = substr($tags, 0, -2);
            $article = make_article($posts, $i, $j, $tags);
            $post_block .= $article;
        }
    }
} else {
    for ($i = 0; $i < $posts_counted; $i++) {
        $tags = '';
        for ($j = 0, $tags_counted = count($posts[$i]['tags']); $j < $tags_counted; $j++) {
            $tags .= $posts[$i]['tags'][$j] . ', ';
        }
        $tags = substr($tags, 0, -2);
        $article = make_article($posts, $i, $j, $tags);
        $post_block .= $article;
    }
}
return $post_block;