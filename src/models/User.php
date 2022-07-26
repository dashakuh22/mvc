<?php

class User
{

    public $id;
    public $name;
    public $email;

    public $gender;
    public $gender_values = [
        'male' => 'Male',
        'female' => 'Female'
    ];

    public $status;
    public $status_values = [
        'active' => 'Active',
        'inactive' => 'Inactive'
    ];

    public $action;
    public $action_value;
    public $action_values = [
        'addUser' => 'add',
        'editUser' => 'edit'
    ];

    public function __construct(string $name = '', string $gender = '',
                                string $status = '', string $email = '',
                                string $id = '')
    {
        $this->name = $name;
        $this->gender = $gender;
        $this->status = $status;
        $this->email = $email;
        $this->id = $id;
        $this->action = $this->getAction();
        $this->action_value = $this->getActionValue();
    }

    public function getAction(): string
    {
        return $this->id === '' ? $this->action_values['addUser'] : $this->action_values['editUser'];
    }

    public function getActionValue(): string
    {
        return $this->action === $this->action_values['editUser'] ? 'Save' : 'Add';
    }

}