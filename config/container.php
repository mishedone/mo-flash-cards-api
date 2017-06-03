<?php

// global configuration
$container->setShared('config', $config);

// http services
$container->setShared('responseFactory', function () {
    return new Tools\ResponseFactory();
});

// database services
$container->setShared('mongo', function () use ($config) {
    $mongo = new Phalcon\Db\Adapter\MongoDB\Client($config->mongo->dsn);

    return $mongo->selectDatabase($config->mongo->db);
});
$container->setShared('collectionManager', function () {
    return new Phalcon\Mvc\Collection\Manager();
});
$container->setShared('modelManager', function () {
    return new Tools\ModelManager();
});

// deck context services
$container->setShared('deckRepository', function () {
    return new DeckContext\Repository\DeckRepository();
});

// resource context services
$container->setShared('textToSpeechRepository', function () {
    return new ResourceContext\Repository\TextToSpeechRepository();
});
$container->setShared('textToSpeechManager', function () use ($container) {
    return new ResourceContext\Manager\TextToSpeechManager(
        $container->getShared('modelManager'),
        $container->getShared('textToSpeechRepository'),
        $container->getShared('config')->texttospeech->key
    );
});