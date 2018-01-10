<?php
include_once 'BaseRouter.php';
class SpecialRouter extends Router {
    public function getActionName() {
        return ($_POSTS['action'] ?? 'Index') . 'Action';
    }
}