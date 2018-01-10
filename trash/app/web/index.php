<?php

session_start();
require_once __DIR__ . '/../core/DB.php';
require_once __DIR__ . '/../common/functions.php';
require_once __DIR__ . '/../controller/DefaultController.php';
require_once __DIR__ . '/../core/Router.php';

define('VIEW_PATH', __DIR__ . '/../view/');

$router = new Router();

$content = $router->run();
if (is_string($content)) {
    require VIEW_PATH . 'include/content.php';
} else {
    echo json_encode($content);
}