<?php

use App\Controllers\TwigController;

include_once file_build_path(ROOT, 'models', 'UserModel.php');

class UserController {

    public TwigController $twig;

    public function __construct()
    {
        $this->twig = new TwigController();
    }

    public function actionIndex(string $action = 'in'): void
    {
        $this->twig->getForm($action);
    }

}