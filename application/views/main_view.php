<span class="tags_sort">
        <!-- here will be hidden search form wich can't be used by user & will _GET #tag from button 
        or (better?) every button will be this form. Every form needs securecheck at backend -->
        <!-- tags buttons will be formed by php with SQL #tag COUNT(*) ASC (i hope therefore i form request) -->
        <ul>
            <li><button>#1tag</button></li>
            <li><button>#2tag</button></li>
            <li><button>#3tag</button></li>
            <li><button>#4tag</button></li>
            <li><button>#5tag</button></li>
            <li><button>#6tag</button></li>
            <li><button>#7tag</button></li>
            <li><button>#8tag</button></li>
        </ul>
</span>
<!--http://skillogram/index.php?search_tag=%231tag-->

<main class="layout">
	<!--::before-->
    <h2 class="layout_title">Content</h2>
    <?php

	foreach($data as $post)
	{
		echo '
		<article class="post">

		<!--::before-->

		<div class="post_header">

			<a class="post_user_link" href="#">
				<img class="post_user_ava" src="' . $post['user']['ava'] . '" alt="^_^" />
				<h3 class="post_user_name">' . $post['user']['name'] . '</h3>
			</a>

			<a class="post_date_link" href="#">
                <h4 class="post_date">
                    <time datetime="' . $post_date . '">' . $passed_time_ago . '</time>
				</h4>
			</a>

		</div>

		<figure class="post_main">

			<img class="post_img" src="' . $post['content'] . '" alt="Post image (ASCII pic add)"/>

			<figcaption>
	                        
                <div class="post_legend">' . $post['legend'] . '</div>
	                        
				<div class="post_downbar">
					<button class="post_likes">' . $post['likes'] . '</button>
					<button class="post_download">
						'/* here will be download link */'
					</button>
				</div>
	                        
				<div class="post_tags">' . $tags . '</div>

			</figcaption>

		</figure>

		<!--::after-->

	</article>';

	}
	
	?>
    <div class="break"></div>
</main>