<?php 
$var = '

<h1 class="header_logo">
	<span class="header_logo-skillogram">SKILLOGRAM</span>
</h1>

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

<span class="search">
	<form id="search_form" action="/search/" method="get" target="_parent" accept-charset="utf-8" autocomplete="on">
		<fieldset class="header_search_form" form="search_form" name="search_ffield">
			<input class="header_search_form-field" maxlength="64" name="search" placeholder="Искать здесь..." autofocus="on" form="search_form" pattern="^(#[[:alnum:]]+)$" required="" type="search"/>
			<button class="header_search_form-butt" type="submit" form="search_form">
				<!--<img src="img/poisk-300x299.png" width="5%" height="5%" alt="Поиск"/>-->
			</button>
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