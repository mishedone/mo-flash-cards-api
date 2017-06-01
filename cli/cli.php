<?php

use Phalcon\Di\FactoryDefault\Cli as Container;
use Phalcon\Cli\Console as ConsoleApp;

// run some commands
try {
    // configuration
    $config = require(__DIR__ . '/../config/config.php');

    // autoloading
    $loader = require __DIR__ . '/../config/loader.php';
    $loader->registerDirs([
        __DIR__ . '/tasks'
    ]);
    $loader->register();
    
    // dependency injection
    $container = new Container();
    require __DIR__ . '/../config/container.php';

    // create a console application
    $console = new ConsoleApp($container);

    // extract arguments
    $arguments = [];
    foreach ($argv as $k => $arg) {
        if ($k === 1) {
            $arguments['task'] = $arg;
        } elseif ($k === 2) {
            $arguments['action'] = $arg;
        } elseif ($k >= 3) {
            $arguments['params'][] = $arg;
        }
    }

    // handle properly
    $console->handle($arguments);
} catch (\Phalcon\Exception $e) {
    echo $e->getMessage();
    exit(255);
} catch (\Exception $e) {
    echo $e->getMessage();
} catch (\Error $e) {
    echo $e->getMessage();
}