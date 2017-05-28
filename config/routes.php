<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;

$sounds = new MicroCollection();
$sounds->setHandler('ResourceContext\Controller\SoundController', true);
$sounds->setPrefix('/api/sounds');
$sounds->get('/from-text/{text}', 'fromTextAction');
$app->mount($sounds);

// not found
$app->notFound(function () {
    throw new \Exception('Not Found');
});