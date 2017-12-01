<!DOCTYPE html>
<html lang="ru">

<head>
    <?php
    $arti = include 'PHP/mainpage/mhead.php';
    echo $arti;
    ?>
</head>

<div id="warning-container">
	<i data-reactroot=""></i>
</div>

<body>

	<!--::before-->

	<header class="header">
            <?php
            $arti = include 'PHP/mainpage/mheader.php';
            echo $arti;
            ?>
	</header>

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
                $arti = include 'PHP/posts_block.php';
                echo $arti;
                ?>
                <div class="break"></div>
	</main>
	
	<footer class="footer">
            <?php
            $arti = include 'PHP/mainpage/mfooter.php';
            echo $arti;
            ?>
	</footer>
</body>
</html>

<!--
http://terminator-gtk3.readthedocs.io/en/latest/	-	terminator man;
https://regex101.com/	-	regular expressions check;
-->
