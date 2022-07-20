<?php
include_once file_build_path(ROOT, 'models', 'UserModel.php');

class UserController {

    public UserModel $userModel;
    public string $name;
    public string $gender;
    public string $status;
    public string $email;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function actionIndex(): void
    {
        $userList = array();
        $userList = $this->userModel->getUserList();
        $userList = json_decode($userList);

        require_once file_build_path(ROOT, 'views', 'UserListView.php');
    }

    public function actionView($id): void
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

    public function actionEdit($id): void
    {
        $this->userModel->editUser($id, $this->getParams());
        header('Location: /');
        exit();
    }

    public function actionDelete($id): void
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