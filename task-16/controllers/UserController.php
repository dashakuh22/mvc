<?php

include_once file_build_path(ROOT, 'models', 'UserModel.php');
include_once file_build_path(ROOT, 'controllers', 'TwigController.php');

class UserController
{

    public TwigController $twig;
    public UserModel $model;
    public array $users;

    public function __construct()
    {
        $this->twig = new TwigController();
        $this->model = new UserModel();
    }

    public function actionIndex(): void
    {
        $this->twig->getIndex();
        exit();
    }

    public function actionLogin(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_SESSION['check_value']) && $_SESSION['check_value'] == $_POST['check_value']) {

                $this->users = $this->model->getUsers();
                $isAuthenticated = false;
                $userName = '';

                foreach ($this->users as $email => $info) {
                    if ($_POST['email'] === $email) {
                        $isAuthenticated = true;
                        $userName = $this->getIfAuthenticated($info, $isAuthenticated);
                    }
                }

                $this->twig->getResult($isAuthenticated, $userName);
                exit();

            } else {
                header('Location: /');
            }

        }
    }

    public function getIfAuthenticated(array $userInfo, bool &$isAuthenticated): string
    {
        $isAuthenticated = password_verify($_POST['password'], $userInfo['password']);
        return $isAuthenticated ? $userInfo['name'] : '';
    }

}