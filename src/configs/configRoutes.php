<?php

return [
    'user/delete/([0-9]+)' => 'user/delete/$1',
    'user/edit/([0-9]+)' => 'user/edit/$1',
    'user/view/([0-9]+)' => 'user/view/$1',
    'user/add' => 'user/add',
    'page-([0-9]+)' => 'user/index/$1',
    '' => 'user/index',
];