<?php
return [
    'db' => ['database' => 5],
    'security' => require_once __DIR__ . DIRECTORY_SEPARATOR . 'security.php',
    'routes' => [
        'article' => [
            ['/articles', 'get', true],
            ['/article/:id', 'get', true],
            ['/article', 'post', true],
            ['/article/:id', 'put', true],
            ['/article/:id', 'delete', true]
        ],
        'auth' => [
            ['/token', 'post'],
            ['/authorize', 'get'],
            ['/authorize', 'post'],
            ['/register/:client_id/:client_secret', 'get']
        ]
    ]
];