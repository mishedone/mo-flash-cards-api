<?php

use Phalcon\DI\FactoryDefault as Container;

$container = new Container();

// global configuration
$container->setShared('config', $config);

// database service
$container->setShared('doctrine', function () use ($container) {
    $mongo = $container->get('config')->mongo;
    
    $connection = new Doctrine\MongoDB\Connection($mongo->dsn);
    $driver = Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver::create([
        __DIR__ . '/../contexts/resource/models'
    ]);
    
    $config = new Doctrine\ODM\MongoDB\Configuration();
    $config->setProxyDir(__DIR__ . '/../cache/Proxies');
    $config->setProxyNamespace('Proxies');
    $config->setHydratorDir(__DIR__ . '/../cache/Hydrators');
    $config->setHydratorNamespace('Hydrators');
    $config->setDefaultDB($mongo->db);
    $config->setMetadataDriverImpl($driver);

    $driver::registerAnnotationClasses();

    return Doctrine\ODM\MongoDB\DocumentManager::create($connection, $config);
});

// resource context services
$container->setShared('textToSpeechService', function () use ($container) {
    return new ResourceContext\Service\TextToSpeechService(
        $container->get('doctrine'),
        $container->get('config')->textToSpeech->apiKey
    );
});

return $container;