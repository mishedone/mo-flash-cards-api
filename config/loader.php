<?php

use Phalcon\Loader;

$loader = new Loader();

$loader->registerNamespaces([
    'Phalcon' => __DIR__ . '/../vendor/phalcon/incubator/Library/Phalcon/',
    'ResourceContext\Controller' => __DIR__ . '/../contexts/resource/controllers/',
    'ResourceContext\Service' => __DIR__ . '/../contexts/resource/services/'
])->register();