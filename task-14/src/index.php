<?php

const ROOT = __DIR__;

function file_build_path(...$segments)
{
    return join(DIRECTORY_SEPARATOR, $segments);
}

require file_build_path(ROOT, 'components', 'Router.php');

$router = new Router();
$router->run();
