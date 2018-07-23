<?php

class UserModel extends Model {

    private $_users;
    public function __construct()
    {
        $this->_users = array(
            'admin' => array(
                'login' => 'admin',
                'password' => '202cb962ac59075b964b07152d234b70',
                'role' => Auth::ADMIN_ROLE
            )
        );
    }

    public function loginUser() {
        if(!isset($_POST['login']) OR !isset($_POST['password'])) { return false; }
        $login = $_POST['login'];
        $password = md5($_POST['password']);
        $errorId = false;
        if(isset($this->_users[$login])) {
            $user = $this->_users[$login];
            if($user['password'] == $password) {
                Auth::setLoggedIn($user);
                return true;
            } else {
                $error = Auth::AUTH_ERRORS['WRONG_USER_PASSWORD'];
            }
        } else {
            $error = Auth::AUTH_ERRORS['USER_NOT_FOUND'];
        }
        Auth::setAuthError($login, $error);
        return false;
    }
}

?>