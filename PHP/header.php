<?php 
$var = '

<h1 class="header_logo">
	<a href="../index.php" class="header_logo-skillogram">SKILLOGRAM</a>
</h1>

<span  class="sort_rate">
	<ul class="sort_rate-butt">
		<li>
			<button class="sort_rate-1" type="sumbit" action="../index.php" method="get">По рейтингу</button>
		</li>
		<li>
			<button class="sort_rate-0" type="sumbit" action="../index.php" method="get">Случайно</button>
		</li>
	</ul>
</span>

<span class="search">
	<form id="search_form" action="../index.php" method="get" target="_self" accept-charset="utf-8" autocomplete="on">
		<fieldset class="header_search_form" form="search_form" name="search_field">
			<input class="header_search_form-field" maxlength="64" name="search_tag" placeholder="Искать здесь..." form="search_form" pattern="^(#[[:alnum:]]+)$" required="" type="search"/>
			<button class="header_search_form-butt" type="submit" form="search_form"></button>
		</fieldset>
	</form>
</span>

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

<!--::after-->

';
return $var;