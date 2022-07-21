<?php

class User {

    public $id;
    public $name;
    public $email;

    public $gender;
    public $gender_values = ['male', 'female'];

    public $status;
    public $status_values = ['active', 'inactive'];

    public $action;
    public $action_values = ['add', 'edit'];

    public function __construct(string $name= '', string $gender = '',
                                string $status = '', string $email = '',
                                string $id = '')
    {
        $this->name = $name;
        $this->gender = $gender;
        $this->status = $status;
        $this->email = $email;
        $this->id = $id;
        $this->action = $this->getAction();
    }

    public function getAction(): string
    {
        return $this->id === '' ? $this->action_values[0] : $this->action_values[1];
    }

}