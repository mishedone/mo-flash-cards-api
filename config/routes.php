<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;

use DeckContext\Controller\DeckController;
use ResourceContext\Controller\TextToSpeechController;

$decks = new MicroCollection();
$decks->setHandler(DeckController::class, true);
$decks->get('/decks', 'list');
$decks->get('/decks/{slug}', 'get');
$app->mount($decks);

$textToSpeech = new MicroCollection();
$textToSpeech->setHandler(TextToSpeechController::class, true);
$textToSpeech->get('/text-to-speech/{text}', 'get');
$app->mount($textToSpeech);

// not found
$app->notFound(function () use ($container) {
    $container->getShared('responseFactory')->create404()->send();
});