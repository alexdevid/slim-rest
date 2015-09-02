<?php
return [
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
            ['/authorize', 'post']
        ]
    ]
];