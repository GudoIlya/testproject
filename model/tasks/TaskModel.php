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

    private function _saveFiles($taskId) {
        if(empty($_POST['files']) OR empty($taskId)) {return false;}
        foreach ($_POST['files'] as $filename) {
            $sql = "INSERT INTO task_files (task_id, filename) VALUES(:task_id, :filename);";
            $this->connection->prepare($sql);
            $this->connection->execute(array(
                'task_id' => $taskId,
                'filename' => $filename
            ));
        }
        return true;
    }

    /**
     * Сохранить задачу
     * @return bool|string
     */
    public function save() {
        if(empty($_POST)) {return false;}
        $sql = "INSERT INTO tasks (username, email, description, is_done) values(:username, :email, :description, :is_done); returning ID";
        $this->connection->prepare($sql);
        $newTaskTemp = $this->connection->execute(array(
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'description' => $_POST['description'],
            'is_done' => isset($_POST['is_done']) ? $_POST['is_done'] : 0
        ));
        $taskId = $newTaskTemp->fetchAll();
        if($taskId == false) {
            return 'Ошибка сохранения задачи';
        }
        $this->_saveFiles($taskId[0]);
        return true;
    }
}

?>