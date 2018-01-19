<?php
return [
    'editProfile' => [
        'type' => 2,
        'ruleName' => 'editProfile',
    ],
    'user' => [
        'type' => 1,
        'children' => [
            'editProfile',
        ],
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'user',
        ],
    ],
];
