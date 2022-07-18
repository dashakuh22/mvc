<?php

//ini_set('display_errors', 1); // убираем перед
//error_reporting(E_ALL); // commit and push

const ROOT = __DIR__;

function file_build_path(...$segments) {
    return join(DIRECTORY_SEPARATOR, $segments);
}

require_once file_build_path(ROOT, 'components', 'Router.php');
require_once file_build_path(ROOT, 'components', 'DB.php');

$router = new Router();
$router->run();
