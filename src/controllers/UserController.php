<?php

include_once file_build_path(ROOT, 'models', 'UserModel.php');

class UserController {

    public function actionIndex(): void
    {
        $userList = array();
        $userList = UserModel::getUserList();
        require_once file_build_path(ROOT, 'views', 'UserListView.php');
    }

    public function actionView($id): void
    {
        UserModel::getUserById($id);
        header('Location: /');
        exit();
    }

    public function actionAdd(): void
    {
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $status = $_POST['status'];
        $email = $_POST['email'];

        UserModel::addUser($name, $gender, $status, $email);
        header('Location: /');
        exit();
    }

    public function actionEdit($id): void
    {
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $status = $_POST['status'];
        $email = $_POST['email'];

        UserModel::editUserById($id, $name, $gender, $status, $email);
        header('Location: /');
        exit();
    }

    public function actionDelete($id): void
    {
        UserModel::deleteUserById($id);
        header('Location: /');
        exit();
    }

}