<?php

class TaskModel extends DataBase{

    public function __construct(){
        parent::__construct();
    }

    private function _getTasks() {

        $sql = "SELECT * FROM tasks";
        $this->connection()->prepare($sql);
        $tasks = $this->connection()->execute();
        return $tasks;
    }
    public function getTasks() {
        $tasks = $this->_getTasks();
        return $tasks;
    }

    public function fill() {

    }

    public function save() {
        if(empty($_POST)) {return false;}
        $sql = "INSERT INTO tasks (username, email, description, image) values(?, ?, ?, ?);";
        $this->connection->prepare($sql);

    }
}

?>