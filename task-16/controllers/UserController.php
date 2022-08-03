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
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['email'])) {

                $_SESSION['email'] = $_POST['email'];

                $this->users = $this->model->getUsers();
                $isAuthenticated = false;

                foreach ($this->users as $email => $info) {
                    if ($_POST['email'] === $email) {
                        $isAuthenticated = true;
                        $keys = array_keys($info);
                        $this->checkAuthentication($info, $keys, $isAuthenticated);
                    }
                }

                $userName = $isAuthenticated ? $_POST['name'] : '';
                $this->twig->getResult($isAuthenticated, $userName);
                exit();

            } else {
                unset($_SESSION['email']);
                header('Location: /');
            }
        }
    }

    public function checkAuthentication(array $userInfo, array $keys, bool &$isAuthenticated): void
    {
        for ($i = 0; $i < count($keys); $i++) {
            if ($keys[$i] === 'password') {
                $isAuthenticated &= password_verify($_POST[$keys[$i]], $userInfo[$keys[$i]]);
            } else {
                $isAuthenticated &= $_POST[$keys[$i]] === $userInfo[$keys[$i]];
            }
        }
    }

}