<?php

use Phalcon\Config;
use Phalcon\Logger;

return new Config([
    'privateResources' => [
        'users' => [
            'index',
            'create',
            'delete'
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
        'workday' => [
            'update'
        ],
        'index' => [
            'index'
        ]
    ]
]);
