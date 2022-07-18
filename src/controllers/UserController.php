<?php

include_once ROOT . '\models\UserModel.php';

class UserController {

    public function actionIndex()
    {
        $userList = array();
        $userList = UserModel::getUserList();

        $css = file_get_contents(ROOT . '\web\styles.css');

        require_once ROOT . '/views/UserListView.php';
        return true;
    }

    public function actionView($id)
    {
        $user = UserModel::getUserById($id);
        header('Location: /');

        return true;
    }

    public function actionAdd()
    {
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $status = $_POST['status'];
        $email = $_POST['email'];

        UserModel::addUser($name, $gender, $status, $email);
        header('Location: /');

        return true;
    }

    public function actionEdit($id)
    {
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $status = $_POST['status'];
        $email = $_POST['email'];

        UserModel::editUserById($id, $name, $gender, $status, $email);
        header('Location: /');

        return true;
    }

    public function actionDelete($id)
    {
        UserModel::deleteUserById($id);
        header('Location: /');

        return true;
    }

}