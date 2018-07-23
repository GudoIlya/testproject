<?php

class DataBase{

    private static $dbobject;
    protected $connection;

    private function __construct() {
        $connection = new PDO(DB_DRIVER.':host='.DB_HOST.' port='.DB_PORT.' dbname='.DB_NAME.' user='.DB_USER.' password='.DB_PASSWORD);
    }

    public static function getDB() {
        if(!isset(self::$dboject)) {
            self::$dbobject = new static;
        }
        return self::$dbobject;
    }

}

?>