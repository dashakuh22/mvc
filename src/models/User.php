<?php

class User {

    public $name;
    public $email;
    public $password;

    public function __construct(string $email = '', string $name= '', string $password = '')
    {
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
    }

}