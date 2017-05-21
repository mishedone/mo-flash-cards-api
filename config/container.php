<?php

use Phalcon\DI\FactoryDefault as Container;

$container = new Container();

// global configuration
$container->setShared('config', $config);

return $container;