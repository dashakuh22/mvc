<?php

namespace App;

function file_build_path(...$segments): string
{
    return implode(DIRECTORY_SEPARATOR, $segments);
}

require_once file_build_path(__DIR__, 'vendor', 'autoload.php');
require_once file_build_path(__DIR__, 'cart.php');
