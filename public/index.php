<?php

use Phalcon\Mvc\Micro as Application;

// ok - let's start this bit..
try {
    // configuration
    $config = require(__DIR__ . '/../config/config.php');

    // autoloading
    require __DIR__ . '/../config/loader.php';
    
    // dependency injection
    $container = require __DIR__ . '/../config/container.php';

    // application bootstrap
    $app = new Application($container);
    
    // routing
    require __DIR__ . '/../config/routes.php';

    // add some make-up to the end response
    $app->after(function () use ($app) {
        $return = $app->getReturnedValue();

        // TODO: integrate JMS serializer here
        if (is_array($return)) {
            $app->response->setContent(json_encode($return));
        } elseif (!strlen($return)) {
            $app->response->setStatusCode('204', 'No Content');
        } else {
            throw new \Exception('Bad Response');
        }

        $app->response->send();
    });

    // start handling
    $app->handle();
} catch (\Exception $e) {
    var_dump($e);
} catch (\Error $e) {
    var_dump($e);
}