<?php

Class TaskController extends Controller{

    public function __construct() {
        parent::__construct();
    }

    public function create() {
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $data = $_POST['data'];
        }
        $data = array(
            'title' => 'Создание'
        );
        return $this->view->getView('task/create', $data);
    }

}

?>