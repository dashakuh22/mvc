<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = file_build_path(ROOT, 'config', 'routes.php');
        $this->routes = include($routesPath);
    }

    private function getURI(): ?string
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

//                echo 'uri: '.$uri.'<br>';
//                echo 'uriPattern: '.$uriPattern.'<br>';
//                echo 'path: '.$path.'<br>';

                $internalRoute = preg_replace("~$uriPattern~", $path, $uri); //?????
//                echo 'internalRoute: '.$internalRoute.'<br>';

                $pathParts = explode('/', $internalRoute);

                $controllerName = ucfirst(array_shift($pathParts) . 'Controller');
                $actionName = 'action' . ucfirst(array_shift($pathParts));
                $params = $pathParts;


                $controllerFile = file_build_path(ROOT, 'controllers', $controllerName . '.php');
                if (file_exists($controllerFile)) {
                    include_once $controllerFile;
                }

                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $params);
                if (!is_null($result)) {
                    break;
                }
            }
        }

    }
}