<?php
require_once "model/tasks/TaskModel.php";

Class IndexController extends Controller{

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $tasksObject = new TaskModel();
        $tasksData = $tasksObject->getTasks();
        $data = array(
            'page' => 'index',
            'title' => 'Главная страница',
            'tasks'  => $tasksData,
            'current_page' => isset($_GET['page']) ? $_GET['page'] : 1
        );
        return $this->view->getView('index', $data);
    }
}

?>