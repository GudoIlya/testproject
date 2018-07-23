<?php

require_once 'model/user/UserModel.php';

Class AuthController extends Controller {

    private $_loggedIn = false;

    public function __construct() {
        $this->_loggedIn = Auth::loggedIn();
        parent::__construct();
    }

    public function login() {

        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $auth = new UserModel();
            $this->_loggedIn = $auth->loginUser();
        }

        if($this->_loggedIn) {
            header('Location: /');
        }

        $data = array(
            'page' => 'login',
            'title' => 'Войти'
        );
        return $this->view->getView('auth/login', $data);
    }

    public function logout() {
        Auth::logOut();
        header('Location: /');
    }
}

?>