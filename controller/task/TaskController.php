<?php
require_once "model/tasks/TaskModel.php";

Class TaskController extends Controller{

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $task = new TaskModel();
            if($task->save()) {
                $message = 'Задача успешно создана';
            } else {
                $error = $task->getLastError();
            }
        }
        $data = array(
            'page' => 'create_task',
            'title' => 'Создание',
            'message' => isset($message) ? $message : '',
            'error'   => isset($error) && $error != false ? $error : ''
        );
        return $this->view->getView('task/create', $data);
    }

}

?>