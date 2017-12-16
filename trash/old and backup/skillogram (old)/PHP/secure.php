<?

foreach ($_POST as $inx => $val) {
    $_POST[$inx] = htmlspecialchars ($_POST[$inx]);
    if (!ini_get(magic_quotes_gpc))
        $_POST[$inx] = addslashes ($_POST[$inx]);
}

foreach ($_GET as $inx => $val) {
    $_GET[$inx] = htmlspecialchars ($_GET[$inx]);
    if (!ini_get(magic_quotes_gpc))
        $_GET[$inx] = addslashes ($_GET[$inx]);
}

foreach ($_COOKIE as $inx => $val) {
    $_SAVECOOKIE[$inx] = htmlspecialchars ($_COOKIE[$inx]);
    if (!ini_get(magic_quotes_gpc))
        $_SAVECOOKIE[$inx] = addslashes ($_COOKIE[$inx]);
}
?>