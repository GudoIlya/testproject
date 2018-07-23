<?php

Class ErrorController extends Controller{

    public function __construct() {
        parent::__construct();
    }

    public function showError404() {
        $data = array(
            'title' => 'Страница не найдена'
        );
        return $this->view->getView('error/404', $data);
    }
}

?>