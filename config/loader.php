<?php

use Phalcon\Loader;

// fire up Phalcon's autoloader
$loader = new Loader();
$loader->registerNamespaces([
    'ResourceContext\Controller' => __DIR__ . '/../contexts/resource/controllers/',
    'ResourceContext\Model' => __DIR__ . '/../contexts/resource/models/',
    'ResourceContext\Service' => __DIR__ . '/../contexts/resource/services/'
])->register();

// add Composer stuff
$composer = require_once __DIR__ . '/../vendor/autoload.php';
$composer->add('models', __DIR__ . '/..');