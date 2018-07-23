<?php


Class IndexController extends Controller{

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array(
            'title' => 'Главная страница'
        );
        return $this->view->getView('index', $data);
    }
}

?>