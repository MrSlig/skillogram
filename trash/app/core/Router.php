<?php
include_once 'BaseRouter.php';
class Router extends BaseRouter {
    public function getControllerName() {
        return ($_GET['controller'] ?? 'Default') . 'Controller';
        //todo доделать
    }
    public function getActionName() {
        return ($_GET['action'] ?? 'index') . 'Action';
    }
}