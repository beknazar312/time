<?php

use Phalcon\Config;
use Phalcon\Logger;

return new Config([
    'privateResources' => [
        'admin' => [
            'index',
        ],
        'session' => [
            'index',
            'create',
            'delete'
        ],

    ]
]);
