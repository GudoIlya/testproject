<?php
require_once "support/Csrf.php";
require_once "support/Auth.php";

$C = Array();
$C['PROJECT_NAME'] = "Тестовое задание";

// DB credentials
$C['DB_DRIVER'] = 'mysql';
$C['DB_HOST'] = 'localhost';
$C['DB_NAME'] = 'testdb';
$C['DB_PORT'] = '3306';
$C['DB_USER'] = 'testuser';
$C['DB_PASSWORD'] = '123';

$C['FILES_IMAGES_URL'] = '/static/images/';
$C['FILES_DIRECTORY_URL'] = '/static/uploadedFiles/';
$C['FILES_DIRECTORY'] = $_SERVER['DOCUMENT_ROOT'].$C['FILES_DIRECTORY_URL'];

@session_start();
Csrf::setCsrfToken();

foreach ($C as $key => $value) {
 	define($key, $value);
 }

?>