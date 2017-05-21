<?php

use Phalcon\DI\FactoryDefault as Container;

$container = new Container();

// global configuration
$container->setShared('config', $config);

// database connection
$container->setShared('mongo', function () use ($config) {
    $mongo = new MongoDB\Driver\Manager($config->mongo->uri);

    return $mongo;
});

// resource context services
$container->setShared('textToSpeechService', function () use ($config) {
    return new ResourceContext\Service\TextToSpeechService(
        $config->textToSpeech->apiKey
    );
});

return $container;