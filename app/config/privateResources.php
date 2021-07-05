<?php

use Phalcon\Config;

return new Config([
    'privateResources' => [
        'users' => [
            'index',
            'create',
            'delete',
            'changePassword',
            'update'
        ],
        'holidays' => [
            'index',
            'create',
            'delete'
        ],
        'lates' => [
            'index',
            'delete'
        ],
        'timer' => [
            'index',
            'update',
            'start',
            'stop'
        ],
        'worktime' => [
            'update'
        ],
        'index' => [
            'index'
        ]
    ]
]);
