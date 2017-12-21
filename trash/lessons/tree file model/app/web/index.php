<?php

session_start();

define('VIEW_PATH', __DIR__ . '/../view/');
require_once __DIR__ . '/../common/db.php';
require_once __DIR__ . '/../common/functions.php';

$view = getView($_GET['action'] ?? 'index');

$data = [];

switch ($view) {
    case 'categories':        
        $data['categories'] = [
            [
                'id' => 1,
                'name' => 'text1',
            ],
            [
                'id' => 2,
                'name' => 'text2',
            ]
        ];
        $data['categoriesCount'] = 18;
    break;
}

$content = render(VIEW_PATH . $view . '.php', $data);

require VIEW_PATH . 'include/content.php';


// also create CONSTANTS.php
// setup phpstorm on arch