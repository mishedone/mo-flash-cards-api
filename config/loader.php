<?php

use Phalcon\Loader;

// fire up Phalcon's autoloader
$loader = new Loader();
$loader->registerNamespaces([
    'Phalcon' => __DIR__ . '/../vendor/phalcon/incubator/Library/Phalcon/',
    
    // contexts
    'DeckContext' => __DIR__ . '/../contexts/DeckContext/',
    'ResourceContext' => __DIR__ . '/../contexts/ResourceContext/',
    
    // tooling
    'Tools' => __DIR__ . '/../tools/'
]);

return $loader;