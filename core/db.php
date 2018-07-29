<?php

class DataBase {

    private $lastError;
    protected $connection;

    private $itemsPerPage = "3";

    public function __construct() {
        $dsn = DB_DRIVER.":host=".DB_HOST.";dbname=".DB_NAME;
        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        );
        $this->connection = new PDO($dsn, DB_USER, DB_PASSWORD, $options);
    }

    public function setItemsPerPage($itemsPerPage) {
        $this->itemsPerPage = $itemsPerPage;
        return true;
    }

    public function getItemsPerPage() {
        return $this->itemsPerPage;
    }

    public function setLastError($error) {
        $this->lastError = $error;
    }

    public function getLastError() {
        return  $this->lastError;
    }

    public function parseGet(&$sql) {
        $offset = 0;
        if(isset($_GET['orderby'])) {
            $orderby = " ".$_GET["orderby"]." ";
        } else {
            $orderby = " 1 ";
        }
        if(isset($_GET['order_direction'])) {
            $orderdirection = " ".$_GET['order_direction']." ";
        } else {
            $orderdirection = " ASC ";
        }
        if(isset($_GET['items_per_page'])) {
            $this->setItemsPerPage($_GET['items_per_page']);
        }
        if(isset($_GET['page'])) {
            $offset = $this->itemsPerPage*($_GET['page'] - 1);
        }
        $sql.= " ORDER BY ".$orderby." ".$orderdirection;
        $sql.= " LIMIT ".$this->itemsPerPage." OFFSET ".$offset;
        return $sql;
    }

}

?>