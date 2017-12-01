<?php 
$var = '

<!--::before-->

<span class="footer_copy">

    <address class="address">
        <a class="footer_link footer_link--address" href="PHP/contacts.php">Developer © 2017</a>
    </address>

    <span class="footer_mid">
        <nav class="footer_nav">
            <a class="footer_link" href="PHP/about.php">О проекте</a>
            <a class="footer_link" href="PHP/help.php">Помощь</a>
            <a class="footer_link" href="PHP/support_skillogram.php">Поддержать проект</a>
        </nav>
    </span>

    <span class="subscription">
        <form id="sub_form" action="PHP/subscription.php" method="post" target="_self" 
              enctype="text/plain" accept-charset="utf-8" autocomplete="off">
            <fieldset class="footer_sub_form" form="sub_form" name="sub_ffield">
                <input class="footer_sub_form-field" maxlength="64" name="subscription" placeholder="Ваш e-mail, чтобы получать вдохновение"
                       form="sub_form" pattern="^([[:alnum:]\._-]+@[[:alnum:]\._-]+(\.[[:alnum:]]+)+)*$" required="" type="email"/>
                <button class="sub_form_butt" type="submit" form="sub_form">Подписаться</button>
            </fieldset>
        </form>
    </span>

</span>

<!--::after-->

';
 return $var;