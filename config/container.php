<?php

use Phalcon\DI\FactoryDefault as Container;

$container = new Container();

// global configuration
$container->setShared('config', $config);

// database services
$container->setShared('mongo', function () use ($config) {
    $mongo = new Phalcon\Db\Adapter\MongoDB\Client($config->mongo->dsn);

    return $mongo->selectDatabase($config->mongo->db);
});
$container->setShared('collectionManager', function () {
    return new Phalcon\Mvc\Collection\Manager();
});

// resource context services
$container->setShared('textToSpeechRepository', function () {
    return new ResourceContext\Repository\TextToSpeechRepository();
});
$container->setShared('textToSpeechService', function () use ($container) {
    return new ResourceContext\Service\TextToSpeechService(
        $container->getShared('textToSpeechRepository'),
        $container->getShared('config')->texttospeech->key
    );
});

return $container;