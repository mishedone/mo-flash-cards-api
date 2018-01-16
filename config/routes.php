<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;

use DeckContext\Controller\CardController;
use DeckContext\Controller\DeckController;
use ResourceContext\Controller\TextToSpeechController;

$decks = new MicroCollection();
$decks->setHandler(DeckController::class, true);
$decks->get('/decks', 'list', 'deck:deck-list');
$app->mount($decks);

$cards = new MicroCollection();
$cards->setHandler(CardController::class, true);
$cards->get('/decks/{slug}/cards', 'list', 'deck:card-list');
$app->mount($cards);

$textToSpeech = new MicroCollection();
$textToSpeech->setHandler(TextToSpeechController::class, true);
$textToSpeech->get('/text-to-speech/{text}', 'get', 'resource:tts-get');
$app->mount($textToSpeech);

// root
$app->get('/', function () use ($app) {
    return [
        '_links' => [
            'decks' => $app->url->get(['for' => 'deck:deck-list'])
        ]
    ];
});

// not found
$app->notFound(function () use ($container) {
    $container->getShared('responseFactory')->create404()->send();
});