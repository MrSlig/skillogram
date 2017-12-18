<?php

define('SALT', 'qwerty123');

class MyUser
{

    private $id, $name;

    public static $salt = 'S@lt';

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function findById($id)
    {
        $user =  new self;
        return $user;
    }

    public function setName($newName)
    {

        $this->name = trim($newName);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNameLength()
    {
        return str_len($this->getName());
    }

}

$user = MyUser::findById(1);
echo $user->getName();

$user = new User();

$user->setName('Petya');
echo $user->getName();


echo User::$salt;

var_dump($user);

// see namespace

// OK KID - Gute Menschen (Offizielles Video)
// get/set - отдельно, а BD - отдельно