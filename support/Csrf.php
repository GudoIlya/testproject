<?php

class Csrf {
    /**
     *  Генерация маркера защиты от CSRF, если этого не было сделано ранее
     */
    static function setCsrfToken() {
        if ( !isset($_SESSION['csrf_token']) ){
            $_SESSION['csrf_token'] = sha1(uniqid(mt_rand(), TRUE));
        }
    }

    /**
     * Проверка токена csrf защиты
     * @return bool
     */
    static function check() {
        if(!isset($_SESSION['csrf_token']) OR $_POST['token'] !== $_SESSION['csrf_token']) {
            return false;
        }
        return true;
    }
}
?>