<?php

use Phalcon\Loader;

// fire up Phalcon's autoloader
$loader = new Loader();
$loader->registerNamespaces([
    'Phalcon' => __DIR__ . '/../vendor/phalcon/incubator/Library/Phalcon/',
    'ResourceContext\Controller' => __DIR__ . '/../contexts/resource/controllers/',
    'ResourceContext\Model' => __DIR__ . '/../contexts/resource/models/',
    'ResourceContext\Service' => __DIR__ . '/../contexts/resource/services/'
]);
$loader->register();