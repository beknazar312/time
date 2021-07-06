<?php
/*
 * Define custom routes. File gets included in the router service definition.
 */
$router = new Phalcon\Mvc\Router();

$router->add('/', [
    'controller' => 'index',
    'action' => 'index'
]);

$router->add('/read-only', [
    'controller' => 'index',
    'action' => 'readOnly'
]);

$router->add('/holidays', [
    'controller' => 'holidays',
    'action' => 'index'
]);

$router->addPost('/holidays/create', [
    'controller' => 'holidays',
    'action' => 'create'
]);

$router->addPost('/holidays/delete/{id}', [
    'controller' => 'holidays',
    'action' => 'delete'
]);

$router->add('/lates', [
    'controller' => 'lates',
    'action' => 'index'
]);

$router->add('/lates/delete/{id}', [
    'controller' => 'lates',
    'action' => 'delete',
]);

$router->add('/login', [
    'controller' => 'session',
    'action' => 'login',
]);

$router->add('/logout', [
    'controller' => 'session',
    'action' => 'logout',
]);

$router->add('/logout', [
    'controller' => 'session',
    'action' => 'logout',
]);

$router->add('/timer', [
    'controller' => 'timer',
    'action' => 'index',
]);

$router->addPost('/timer/timer', [
    'controller' => 'timer',
    'action' => 'timer',
]);


$router->addPost('/timer/update', [
    'controller' => 'timer',
    'action' => 'update',
]);

$router->add('/users', [
    'controller' => 'users',
    'action' => 'index',
]);

$router->addPost('/users/create', [
    'controller' => 'users',
    'action' => 'create',
]);

$router->addPost('/users/delete', [
    'controller' => 'users',
    'action' => 'delete',
]);

$router->addPost('/users/update', [
    'controller' => 'users',
    'action' => 'update',
]);

$router->add('/users/change-password', [
    'controller' => 'users',
    'action' => 'changePassword',
]);

$router->addPost('/worktime/update', [
    'controller' => 'users',
    'action' => 'update',
]);

return $router;
