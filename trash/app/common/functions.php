<?php

function addMessage($text) {
	if (!isset($_SESSION['message'])) {
		$_SESSION['messages'] = [];

	}
	$_SESSION['messages'] [] = $text;
}
function getMessages() {
	$messages = $_SESSION['messages'] ?? [];
	unset($_SESSION['messages']);
	return $messages;
}

function getView($name) {
	if (isset($name) &&
			file_exists(VIEW_PATH . $name . '.php')) {
			return $name;
	} else {
		return '404';
	}
}

function render($path, $data = []) {
		extract($data);
		ob_start();
		require VIEW_PATH . $path . '.php';
		return ob_get_clean();
}