<?php


Class IndexController extends Controller{

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array(
            'page' => 'index',
            'title' => 'Главная страница'
        );
        return $this->view->getView('index', $data);
    }
}

?>