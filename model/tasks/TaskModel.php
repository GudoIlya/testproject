<?php

class TaskModel extends DataBase{

    public function __construct() {
        parent::construct();
    }

    private function _getTasks() {

        $sql = "SELECT * FROM tasks";
        $this->getDB()->prepare($sql);
        $tasks = $this->getDB()->execute();
        return $tasks;
    }
    public function getTasks() {
        $tasks = $this->_getTasks();
        return $tasks;
    }

}

?>