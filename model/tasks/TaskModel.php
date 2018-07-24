<?php

class TaskModel extends DataBase{

    private $username;
    private $email;
    private $description;
    /**
     * @var array
     */
    private $photos;

    public function __construct(){
        parent::__construct();
    }

    private function _getTasks() {

        $sql = "SELECT * FROM tasks t
                LEFT task_photo tp ON t.id = tp.task_id";
        $this->parseGet($sql);
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