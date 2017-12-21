<?php

function addMessage($text) {
    $_SESSION['message'] = $text;
}

function getMessage() {
    $text = $_SESSION['message'] ?? null;
    unset($_SESSION['message']);
    return $text;
}

function getView($name) {
    if (isset($name) && file_exists(VIEW_PATH . $name . '.php')) {
        $view = $name;
    } else {
        $view = '404';
    }
    return $view;
}

function render($path, $data = []) {
    extract($data);
    ob_start();
    require $path;
    return ob_get_clean();
}