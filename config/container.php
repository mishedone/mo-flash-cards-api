<?php

use Phalcon\DI\FactoryDefault as Container;

$container = new Container();

// global configuration
$container->setShared('config', $config);

// resource context services
$container->setShared('textToSpeechService', function () use ($config) {
    return new ResourceContext\Service\TextToSpeechService(
        $config->textToSpeech->apiKey
    );
});

return $container;