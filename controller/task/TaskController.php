<?php
require_once  $this->_controllerFolder."/error/ErrorController.php";
require_once "model/tasks/TaskModel.php";

Class TaskController extends Controller{
    private $model;
    public function __construct() {
        parent::__construct();
        $this->model = new TaskModel();
    }

    public function create() {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            if($this->model->save()) {
                $message = 'Задача успешно создана';
            } else {
                $error = $this->model->getLastError();
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

    public function edit() {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            if($this->model->save(false)) {
                $message = 'Задача обновлена';
            } else {
                $error = $this->model->getLastError();
            }
        }
        $task = $this->model->getTask();
        if(!$task) {
            $controller = new ErrorController();
            $controller->showError404();
            return;
        }
        $data = array(
            'title' => 'Редактирование задачи',
            'task'  => $task,
            'message' => isset($message) ? $message : '',
            'error'   => isset($error) && $error != false ? $error : ''
        );
        return $this->view->getView('task/create', $data);
    }

}

?>