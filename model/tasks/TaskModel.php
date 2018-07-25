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
        $sql = "SELECT t.*, tp.file_name as photo FROM tasks t
                LEFT JOIN task_photo tp ON t.id = tp.task_id AND tp.is_main='1'";
        $this->parseGet($sql);
        $stmt = $this->connection->prepare($sql);
        try {
            $params = array();
            $stmt->execute($params);
        } catch(PDOExecption $e) {
            $this->connection->rollback();
            $this->setLastError('Ошибка получения списка задач');
            return false;
            /* print "Error!: " . $e->getMessage() . "</br>"; */
        }
        $tasks = $stmt->fetchAll();
        return $tasks;
    }

    public function getTasks() {
        $tasks = $this->_getTasks();
        return $tasks;
    }

    private function _saveFiles($taskId) {
        if(empty($_POST['files']) OR empty($taskId)) {return false;}
        $is_main = 1;
        foreach ($_POST['files'] as $filename) {
            if($filename == '') { continue; }
            $sql = "INSERT INTO task_photo (task_id, file_name) VALUES(:task_id, :filename, :is_main);";
            $stmt = $this->connection->prepare($sql);
            try {
                $params = array(
                    ':task_id' => $taskId,
                    ':filename' => $filename,
                    ':is_main'  => $is_main
                );
                $stmt->execute($params);
            } catch(PDOExecption $e) {
                $this->connection->rollback();
                $this->setLastError('Ошибка при сохранении фотографии');
                return false;
                /* print "Error!: " . $e->getMessage() . "</br>"; */
            }
            $is_main = 0;
        }
        return true;
    }

    /**
     * Сохранить задачу
     * @return bool|string
     */
    public function save() {
        if(empty($_POST)) {return false;}
        $sql = "INSERT INTO tasks (username, email, description, is_done) VALUES(:username, :email, :description, :is_done);";
        $stmt = $this->connection->prepare($sql);
        try{
            $params = array(
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'description' => $_POST['description'],
                'is_done' => isset($_POST['is_done']) ? $_POST['is_done'] : 0
            );
            $stmt->execute($params);
        } catch(PDOExecption $e) {
            $this->connection->rollback();
            $this->setLastError('Ошибка сохранения задачи');
            return false;
            /* print "Error!: " . $e->getMessage() . "</br>"; */
        }
        $taskId = $this->connection->lastInsertId();
        $this->_saveFiles($taskId);
        return true;
    }
}

?>