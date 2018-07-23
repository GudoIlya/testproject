<?php
require_once "support/Csrf.php";
require_once "support/Auth.php";

$C = Array();
$C['PROJECT_NAME'] = "Тестовое задание";

// DB credentials
$C['DB_DRIVER'] = 'pgsql';
$C['DB_HOST'] = 'localhost';
$C['DB_NAME'] = 'testdb';
$C['DB_PORT'] = '5432';
$C['DB_USER'] = 'postgres';
$C['DB_PASSWORD'] = '';

Csrf::setCsrfToken();

foreach ($C as $key => $value) {
 	define($key, $value);
 }

 function __autoload($classname) {
    $fcn = $classname.".php";
    if(file_exists($fcn)) {
        require_once $fcn;
        return true;
    }
    return false;
 }
?>