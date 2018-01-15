<?php
/**
 * Единая точка входа
 */
ini_set('display_errors', true);   // sets PHP config on displaying php. Needs to be checked: if developer
ini_set('display_startup_errors', true);
error_reporting(E_ALL);
require_once 'application/bootstrap.php';   // initiating core