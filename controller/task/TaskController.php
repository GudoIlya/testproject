<?php
require_once "model/tasks/TaskModel.php";

Class TaskController extends Controller{

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $task = new TaskModel();
            $task->fill();
            $task->save();
        }
        $data = array(
            'page' => 'create_task',
            'title' => 'Создание'
        );
        return $this->view->getView('task/create', $data);
    }

}

?>