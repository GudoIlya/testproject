<?php

class Auth
{

    const ADMIN_ROLE = 1;
    const AUTH_ERRORS = array(
        'USER_NOT_FOUND' => 'Пользователь не найден',
        'WRONG_USER_PASSWORD' => 'Неверный пароль'
    );
    const USER_NOT_FOUND = 'Пользователь не найден!';

    public function __construct()
    {

    }

    static function setLoggedIn($user)
    {
        $_SESSION['logged_in'] = true;
        $_SESSION['login'] = $user['login'];
        $_SESSION['role'] = $user['role'];
        self::clearAuthInfo();
    }

    static function checkIsAdmin()
    {
        if ($_SESSION['role'] == ADMIN_ROLE) {
            return true;
        }
        return false;
    }

    static function loggedIn()
    {
        if (isset($_SESSION['logged_in']) AND $_SESSION['logged_in'] == true) {
            return true;
        }
        return false;
    }

    static function logOut()
    {
        $_SESSION['logged_in'] = false;
        $_SESSION['login'] = '';
        $_SESSION['role'] = '';
    }

    static function clearAuthInfo()
    {
        $_SESSION['auth.old_login'] = '';
        $_SESSION['auth.error'] = '';
    }

    static function setAuthError($old_login, $error) {
        $_SESSION['auth.old_login'] = $old_login;
        $_SESSION['auth.error'] = $error;
    }
}

?>