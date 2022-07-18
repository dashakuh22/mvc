<?php

//ini_set('display_errors', 1); // убираем перед
//error_reporting(E_ALL); // commit and push

const ROOT = __DIR__;
require_once ROOT . '\components\Router.php';
require_once ROOT . '\components\DB.php';

$router = new Router();
$router->run();
