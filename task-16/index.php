<?php

function file_build_path(...$segments): string
{
    return implode(DIRECTORY_SEPARATOR, $segments);
}

const ROOT = __DIR__;

require_once file_build_path(ROOT, 'vendor', 'autoload.php');
require_once file_build_path(ROOT, 'components', 'Router.php');

$router = new Router();
$router->run();