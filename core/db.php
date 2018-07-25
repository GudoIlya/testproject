<?php

class DataBase {

    private $lastError;
    protected $connection;

    public function __construct() {
        $dsn = DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME;
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );
        $this->connection = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
    }

    public function setLastError($error) {
        $this->lastError = $error;
    }

    public function getLastError() {
        return  $this->lastError;
    }

    public function parseGet(&$sql) {
        return $sql;
    }
}

?>