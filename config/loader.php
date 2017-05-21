<?php

use Phalcon\Loader;

$loader = new Loader();

$loader->registerNamespaces([
    'ResourceContext\Controller' => __DIR__ . '/../contexts/resource/controllers/',
    'ResourceContext\Service' => __DIR__ . '/../contexts/resource/services/'
])->register();