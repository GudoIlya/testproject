<?php

class Auth {

    const ADMIN_ROLE = 1;
    const ADMIN_LOGIN = 'admin';
    const ADMIN_PASSWORD = '';

    public function __construct() {

    }

    static function setLoggedIn($user) {
        $_SESSION['logged_in'] = true;
        $_SESSION['login'] = $user['login'];
        $_SESSION['role'] = $user['role'];
    }

    static function checkAuth() {
        if($_SESSION['logged_in'] == true) {
            return true;
        }
        return false;
    }

    static function checkIsAdmin() {
        if($_SESSION['role'] == ADMIN_ROLE) {
            return true;
        }
        return false;
    }

    static function loggenIn() {
        if(isset($_SESSION['logged_in']) AND $_SESSION['logged_in'] == true) {
            return true;
        }
        return false;
    }

    static function logOut() {
        $_SESSION['logged_in'] = false;
        $_SESSION['login'] = '';
        $_SESSION['role'] = '';
    }
}

?>