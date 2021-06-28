<?php

use Phalcon\Loader;

$loader = new Loader();


$loader->registerNamespaces([
    'Time\Models'       => $config->application->modelsDir,
    'Time\Controllers'  => $config->application->controllersDir,
    'Time\Forms'        => $config->application->formsDir,
    'Time\Validation'   => $config->application->validationDir,
    'Time'              => $config->application->libraryDir
]);

$loader->register();
// Use composer autoloader to load vendor classes
require_once BASE_PATH . '/vendor/autoload.php';
