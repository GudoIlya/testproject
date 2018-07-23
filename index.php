<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "core/db.php";
require_once "core/model.php";
require_once "core/view.php";
require_once "core/controller.php";
require_once "core/inits.php";
require_once "core/routing.php";

$router = new simpleRouter();
$router->execute();

?>