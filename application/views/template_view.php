<!DOCTYPE html>
<html lang="ru">
<!-- ________________________!HEAD!_______________________ -->
<head>
	<title>Skillogram</title>
	<meta charset="utf-8"/>
	<meta name="description" content="Skillogram covers current SkillUp basic PHP course."/>
	<link rel="stylesheet" href="assets/css/reset.css"/>
	<link rel="stylesheet" type="text/css" href="assets/css/main.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>
	<script src="/js/jquery-1.6.2.js" type="text/javascript"></script>	
	<!-- FAVICON -->
	<link rel="apple-touch-icon" sizes="180x180" href="assets/images/favicon/apple-touch-icon.png"/>
	<link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon/favicon-32x32.png"/>
	<link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon/favicon-16x16.png"/>
	<link rel="manifest" href="assets/images/favicon/manifest.json"/>
	<link rel="mask-icon" href="assets/images/favicon/safari-pinned-tab.svg" color="#5bbad5"/>
	<link rel="shortcut icon" href="assets/images/favicon/favicon.ico"/>
	<meta name="msapplication-config" content="assets/images/favicon/browserconfig.xml"/>
	<meta name="theme-color" content="#ffffff"/>
	<!-- /FAVICON -->
	<style>[data-columns]::before{visibility:hidden;position:absolute;font-size:1px;}</style>
</head>

<div id="warning-container">
	<i data-reactroot=""></i>
</div>
<!-- ______________________!HEADER!______________________ -->
<header>

	<h1 class="header_logo">
	    <span class="header_logo-skillogram">SKILLOGRAM</span>
	</h1>
	<!-- ______________________!SORT!____________________ -->
	<span  class="sort_rate">
	    <ul class="sort_rate-butt">
	        <li>
	            <button class="sort_rate-1">По рейтингу</button>
	        </li>
	        <li>
	            <button class="sort_rate-0">Случайно</button>
	        </li>
	    </ul>
	</span>
	<!-- ____________________!SEARCH!____________________ -->
	<span class="search">
	    <form id="search_form" action="/skillogram/main/search" method="get" target="_self" accept-charset="utf-8" autocomplete="on">
	        <fieldset class="header_search_form" form="search_form" name="search_field">
	            <input class="header_search_form-field" maxlength="64" name="search_tags" placeholder="Искать здесь..." form="search_form" pattern="^(#[[:alnum:]]+)$" required="" type="search"/>
	            <button class="header_search_form-butt" type="submit" form="search_form"></button>
	        </fieldset>
	    </form>
	</span>
	<!-- _____________________!AUTH!_____________________ -->
	<span class="auth_user">
	    <ul class="auth_user-butt">
	        <li>
	            <button class="auth_user-butt_log">Вход</button>
	        </li>
	        <li>
	            <button class="auth_user-butt_reg">Регистрация</button>
	        </li>
	    </ul>
	</span>

</header>>
<!-- ______________________!CONTENT!_____________________ -->
<body>
	<?php include 'application/views/' . $content_view; ?>
</body>
<!-- ______________________!FOOTER!______________________ -->
<footer>
	<span class="footer_copy">

	    <address class="address">
	        <a class="footer_link footer_link--address" href="/skillogram/contacts">Developer © 2017</a>
	    </address>

	    <span class="footer_mid">
	        <nav class="footer_nav">
	            <a class="footer_link" href="/skillogram/about">О проекте</a>
	            <a class="footer_link" href="/skillogram/help">Помощь</a>
	            <a class="footer_link" href="/skillogram/contribute">Поддержать проект</a>
	        </nav>
	    </span>
	<!-- __________________!SUBSCRIBE!_________________ -->
	    <span class="subscription">
	        <form id="sub_form" action="#" method="post" target="_self" 
	              enctype="text/plain" accept-charset="utf-8" autocomplete="off">
	            <fieldset class="footer_sub_form" form="sub_form" name="sub_ffield">
	                <input class="footer_sub_form-field" maxlength="64" name="subscription" placeholder="Ваш e-mail, чтобы получать вдохновение"
	                       form="sub_form" pattern="^([[:alnum:]\._-]+@[[:alnum:]\._-]+(\.[[:alnum:]]+)+)*$" required="" type="email"/>
	                <button class="sub_form_butt" type="submit" form="sub_form">Подписаться</button>
	            </fieldset>
	        </form>
	    </span>

	</span>
</footer>

</html>

<? // template_view.php — это шаблон, содержащий общую для всех страниц разметку.