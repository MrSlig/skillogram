<?php
/**
 * Class DB (singletone)
 */
class DB    {
    private static $instance = null;
    private $pdo;
    private function __construct()  {
        $dsn = 'mysql:dbname=localhost1;host=localhost';
        $user = 'root';
        $password = 'root';
        $this->pdo = new PDO($dsn, $user, $password);
    }
    public static function getInstance() {
        if(!self::$instance)    {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function getPDO()    {
        return $this->pdo;
    }
}