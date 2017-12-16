<?php

function addMessage($text) {
    $_SESSION['message'] = $text;
}

function getMessage() {
    $text = $_SESSION['message'] ?? null;
    unset($_SESSION['message']);
    return $text;
}

// ^^falsh_message