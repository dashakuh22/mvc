<?php

declare(strict_types=1);

const ALGO = PASSWORD_BCRYPT;

return [
    'user1@test.com' => [
        'name' => 'John',
        'password' => password_hash('your_hash_here1', ALGO),
    ],
    'user2@test.com' => [
        'name' => 'Jane',
        'password' => password_hash('your_hash_here2', ALGO),
    ],
];
