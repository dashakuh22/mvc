<?php

namespace App\components;

use App\Controllers\User\UserController;
use App\controllers\file\FileController;

class Router
{

    private $routes;

    public function __construct()
    {
        $this->routes = include file_build_path(ROOT, 'config', 'configRoutes.php');
    }

    public function getURI(): ?string
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
        return null;
    }

    public function run(): void
    {
        $uri = $this->getURI();

        foreach ($this->routes as $uriPattern => $path) {
            if (preg_match("~$uriPattern~", $uri)) {

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $pathParts = explode('/', $internalRoute);

                $controllerName = array_shift($pathParts);
                $controllerFileName = ucfirst($controllerName . 'Controller');
                $actionName = 'action' . ucfirst(array_shift($pathParts));
                $params = $pathParts;

                $controllerFile = file_build_path(ROOT, 'controllers', $controllerName, $controllerFileName . '.php');

                if (file_exists($controllerFile)) {
                    require_once $controllerFile;
                }

                $controllerObject = new $controllerFileName;
                $result = call_user_func_array(array($controllerObject, $actionName), $params);
                if (!is_null($result)) {
                    break;
                }
            }
        }

    }

}