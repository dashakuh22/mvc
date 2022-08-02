<?php

session_start();

const ROOT = __DIR__;

function file_build_path(...$segments): string
{
    return implode(DIRECTORY_SEPARATOR, $segments);
}

require_once file_build_path(ROOT, '..', 'vendor', 'autoload.php');

use App\components\Router;

$router = new Router();
$router->run();