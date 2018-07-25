<?php
require_once "model/tasks/TaskModel.php";

Class IndexController extends Controller{

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $tasksObject = new TaskModel();
        $tasks = $tasksObject->getTasks();
        $data = array(
            'page' => 'index',
            'title' => 'Главная страница',
            'tasks'  => $tasks
        );
        return $this->view->getView('index', $data);
    }
}

?>