<?php
return [
    'security' => require_once __DIR__ . DIRECTORY_SEPARATOR . 'security.php',
    'routes' => [
        'article' => [
            ['/articles', 'get', true],
            ['/article/:id', 'get', true],
            ['/article', 'post', true],
            ['/article/:id', 'put', true],
            ['/article/:id', 'delete', true]
        ]
    ]
];