<?php
include_once 'BaseRouter.php';
class SpecialPouter extends Router {
    public function getActionName() {
        return ($_POST['action'] ?? 'Index') . 'Action';
    }
}