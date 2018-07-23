<?php

class DataBase {

    protected $connection;

    public function __construct() {
        $dsn = DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME;
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );
        $this->connection = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
    }

}

?>