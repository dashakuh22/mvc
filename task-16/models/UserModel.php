<?php

class UserModel
{

    public array $users;

    public function getUsers(): array
    {
        $this->users = include_once file_build_path(ROOT, 'config', 'configUsers.php');

        return $this->users;
    }

}