<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;

use DeckContext\Controller\DeckController;
use ResourceContext\Controller\TextToSpeechController;

$decks = new MicroCollection();
$decks->setHandler(DeckController::class, true);
$decks->get('/decks', 'list', 'deck-list');
$decks->get('/decks/{slug}', 'get', 'deck-get');
$app->mount($decks);

$textToSpeech = new MicroCollection();
$textToSpeech->setHandler(TextToSpeechController::class, true);
$textToSpeech->get('/text-to-speech/{text}', 'get', 'tts-get');
$app->mount($textToSpeech);

// root
$app->get('/', function () use ($app) {
    return [
        '_links' => [
            'decks' => $app->url->get(['for' => 'deck-list'])
        ]
    ];
});

// not found
$app->notFound(function () use ($container) {
    $container->getShared('responseFactory')->create404()->send();
});