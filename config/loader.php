<?php

use Phalcon\Loader;

// fire up Phalcon's autoloader
$loader = new Loader();
$loader->registerNamespaces([
    'Phalcon' => __DIR__ . '/../vendor/phalcon/incubator/Library/Phalcon/',
    'ResourceContext' => __DIR__ . '/../contexts/ResourceContext/'
]);
$loader->register();