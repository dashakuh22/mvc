<?php

include_once file_build_path(ROOT, 'models', 'UserModel.php');
include_once file_build_path(ROOT, 'components', 'Pagination.php');

class UserController {

    public UserModel $userModel;
    public string $name;
    public string $gender;
    public string $status;
    public string $email;
    public int $pageIndex;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->pageIndex = 1;
    }

    public function actionIndex(int $pageIndex = null): void
    {
        $userList = array();
        if (!is_null($pageIndex)) {
            $this->pageIndex = $pageIndex;
        }
        $userList = $this->userModel->getUserList($this->pageIndex);
        $userList = json_decode($userList);
        $pagination = new Pagination($this->pageIndex, $userList);

        require_once file_build_path(ROOT, 'views', 'UserListView.php');
        exit();
    }

    public function actionView(int $id): void
    {
        $user = $this->userModel->getUser($id);
        header('Location: /');
        exit();
    }

    public function actionAdd(): void
    {
        $this->userModel->addUser($this->getParams());
        header('Location: /');
        exit();
    }

    public function actionEdit(int $id): void
    {
        $this->userModel->editUser($id, $this->getParams());
        header('Location: /');
        exit();
    }

    public function actionDelete(int $id): void
    {
        $this->userModel->deleteUser($id);
        header('Location: /');
        exit();
    }

    private function getParams(): array
    {
        $this->name = $_POST['name'];
        $this->email = $_POST['email'];
        $this->gender = $_POST['gender'];
        $this->status = $_POST['status'];
        return [
            'name' => $this->name,
            'gender' => $this->gender,
            'status' => $this->status,
            'email' => $this->email,
        ];
    }

}