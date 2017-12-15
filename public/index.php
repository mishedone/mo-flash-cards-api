<?php

use Phalcon\DI\FactoryDefault as Container;
use Phalcon\Mvc\Micro as Application;

// ok - let's start this bit..
try {
    // configuration
    $config = require(__DIR__ . '/../config/config.php');

    // loader
    $loader = require __DIR__ . '/../config/loader.php';
    $loader->register();
    
    // dependency injection
    $container = new Container();
    require __DIR__ . '/../config/container.php';
    $responses = $container->getShared('responseFactory');

    // application bootstrap
    $app = new Application($container);
    
    // routing
    require __DIR__ . '/../config/routes.php';

    // add some make-up to the end response
    $app->after(function () use ($app, $config) {
        $return = $app->getReturnedValue();
        
        // automatically transform arrays to json
        if (is_array($return)) {
            $app->response->setJsonContent($return);
        }

        // allow cross origin requests
        if (!empty($config->cors->allow)) {
            $app->response->setHeader('Access-Control-Allow-Origin', $config->cors->allow);
        }

        $app->response->send();
    });

    // start handling
    $app->handle();
} catch (\Exception $e) {
    $responses->create500($e->getMessage())->send();
} catch (\Error $e) {
    $responses->create500($e->getMessage())->send();
}