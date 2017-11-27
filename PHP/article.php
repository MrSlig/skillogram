<?php

$posts = [
    [
        'user' => [
            'ava' => 'https://html5book.ru/wp-content/uploads/2016/10/profile-image.png',
            'name' => 'И.И. Иванов',
        ],
        'date' => '14 Ноября 2017',
        'content' => 'http://4.bp.blogspot.com/-z4sMggeD4dg/UO2TB9INuFI/AAAAAAAAdwc/Kg5dqlKKHrQ/s1600/funny-cat-pictures-032-025.jpg',
        'likes' => 77,
        'tags' => [
            '#1tag',
            '#2tag',
            '#3tag',
            '#4tag',
            '#5tag',
        ],
    ],
    [
        'user' => [
            'ava' => 'https://html5book.ru/wp-content/uploads/2016/10/profile-image.png',
            'name' => 'И.И. Иванов',
        ],
        'date' => '14 Ноября 2017',
        'content' => 'http://4.bp.blogspot.com/-z4sMggeD4dg/UO2TB9INuFI/AAAAAAAAdwc/Kg5dqlKKHrQ/s1600/funny-cat-pictures-032-025.jpg',
        'likes' => 77,
        'tags' => [
            '#1tag',
            '#2tag',
            '#3tag',
            '#4tag',
            '#5tag',
        ],
    ],
    [
        'user' => [
            'ava' => 'https://html5book.ru/wp-content/uploads/2016/10/profile-image.png',
            'name' => 'И.И. Иванов',
        ],
        'date' => '14 Ноября 2017',
        'content' => 'http://4.bp.blogspot.com/-z4sMggeD4dg/UO2TB9INuFI/AAAAAAAAdwc/Kg5dqlKKHrQ/s1600/funny-cat-pictures-032-025.jpg',
        'likes' => 77,
        'tags' => [
            '#1tag',
            '#2tag',
            '#3tag',
            '#4tag',
            '#5tag',
        ],
    ],
    [
        'user' => [
            'ava' => 'https://html5book.ru/wp-content/uploads/2016/10/profile-image.png',
            'name' => 'И.И. Иванов',
        ],
        'date' => '14 Ноября 2017',
        'content' => 'http://4.bp.blogspot.com/-z4sMggeD4dg/UO2TB9INuFI/AAAAAAAAdwc/Kg5dqlKKHrQ/s1600/funny-cat-pictures-032-025.jpg',
        'likes' => 77,
        'tags' => [
            '#1tag',
            '#2tag',
            '#3tag',
            '#4tag',
            '#5tag',
        ],
    ],
    [
        'user' => [
            'ava' => 'https://html5book.ru/wp-content/uploads/2016/10/profile-image.png',
            'name' => 'И.И. Иванов',
        ],
        'date' => '14 Ноября 2017',
        'content' => 'http://4.bp.blogspot.com/-z4sMggeD4dg/UO2TB9INuFI/AAAAAAAAdwc/Kg5dqlKKHrQ/s1600/funny-cat-pictures-032-025.jpg',
        'likes' => 77,
        'tags' => [
            '#1tag',
            '#2tag',
            '#3tag',
            '#4tag',
            '#5tag',
        ],
    ],
    [
        'user' => [
            'ava' => 'https://html5book.ru/wp-content/uploads/2016/10/profile-image.png',
            'name' => 'И.И. Иванов',
        ],
        'date' => '14 Ноября 2017',
        'content' => 'http://4.bp.blogspot.com/-z4sMggeD4dg/UO2TB9INuFI/AAAAAAAAdwc/Kg5dqlKKHrQ/s1600/funny-cat-pictures-032-025.jpg',
        'likes' => 77,
        'tags' => [
            '#1tag',
            '#2tag',
            '#3tag',
            '#4tag',
            '#5tag',
        ],
    ],
];

$i = 0;
$var = '

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
                .'<a href="#">' . $posts[i]['tags'][j] . '</a>,'.
			'</div>

		</figcaption>

	</figure>

	<!--::after-->

</article>

';

$tags = '';
for($i = 0; $i < 6; $i++) {
    for ($j = 0; $j < 6 ; $j++){
        $tags ;
    };
    return $var;
};