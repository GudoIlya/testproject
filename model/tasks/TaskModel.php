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

    private function _getTasksNumber() {
        $sql = "SELECT count(*) as rows_number FROM tasks;";
        $stmt = $this->connection->prepare($sql);
        try{
            $stmt->execute();
            $rows_number = $stmt->fetchAll()[0]['rows_number'];
        } catch(PDOException $e) {
            return false;
        }
        return $rows_number;
    }

    private function _getTaskPhotos($task_id) {
        if (empty($task_id)) {
            return fasle;
        }
        $sql = "SELECT * from task_photo WHERE task_id=" . $task_id;
        $stmt = $this->connection->prepare($sql);
        try {
            $stmt->execute();
            $photos = $stmt->fetchAll();
        } catch (PDOException $e) {
            $photos = false;
        }
        return $photos;
    }

    private function _getTask() {
        if(!isset($_GET['task']) AND !isset($_POST['id'])) {return false;}
        if(isset($_GET['task'])) {
            $task_id = $_GET['task'];
        } else if(isset($_POST['id'])) {
            $task_id = $_POST['id'];
        } else {
            return false;
        }
        $sql = "SELECT * from tasks WHERE id=".$task_id;
        $stmt = $this->connection->prepare($sql);
        try {
            $stmt->execute();
            $task = $stmt->fetchAll()[0];
        } catch (PDOException $e) {
            $task = fasle;
        }
        if($task) {
            $task['photos'] = $this->_getTaskPhotos($task_id);
        }
        return $task;
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

    public function getTask() {
        $task = $this->_getTask();
        if(!is_array($task)) { return false;}
        return $task;
    }
    public function getTasks() {
        $result['taskList'] = $this->_getTasks();
        $result['rows_number'] = $this->_getTasksNumber();
        $result['items_per_page'] = $this->getItemsPerPage();
        return $result;
    }

    private function _deleteFiles($taskId) {
        if(empty($taskId)) { return false; }
        $sql = "DELETE FROM task_photo WHERE task_id=".$taskId;
        $stmt = $this->connection->prepare($sql);
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
        return true;
    }
    private function _saveFiles($taskId) {
        if(empty($_POST['files']) OR empty($taskId)) {return false;}
        $is_main = 1;
        foreach ($_POST['files'] as $filename) {
            if($filename == '') { continue; }
            $sql = "INSERT INTO task_photo (task_id, file_name, is_main) VALUES(:task_id, :filename, :is_main);";
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
    public function save($new = true) {
        if(empty($_POST)) {return false;}
        if($new) {
            $sql = "INSERT INTO tasks (username, email, description, is_done) VALUES(:username, :email, :description, :is_done);";
        } else {
            $sql = "UPDATE tasks set username = :username, email = :email, description = :description, is_done = :is_done WHERE id = :id ";
        }
        $stmt = $this->connection->prepare($sql);
        try{
            $params = array(
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'description' => $_POST['description'],
                'is_done' => isset($_POST['is_done']) AND $_POST['is_done'] == 'on' ? 1 : 0,
            );
            if(!$new) {
                $params['id'] = $_POST['id'];
            }
            $stmt->execute($params);
        } catch(PDOExecption $e) {
            $this->connection->rollback();
            $this->setLastError('Ошибка сохранения задачи');
            return false;
            /* print "Error!: " . $e->getMessage() . "</br>"; */
        }
        if(!$new) {
            $taskId = $_POST['id'];
            $this->_deleteFiles($taskId);
        } else {
            $taskId = $this->connection->lastInsertId();
        }
        $this->_saveFiles($taskId);
        return true;
    }
}

?>