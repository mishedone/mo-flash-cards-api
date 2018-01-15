<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;

use DeckContext\Controller\DeckController;
use ResourceContext\Controller\TextToSpeechController;

$app->get('/api/v1', function () use ($app) {
    return [
        '_links' => [
            'decks' => $app->url->get(['for' => 'deck-list']),
        ]
    ];
});

$decks = new MicroCollection();
$decks->setHandler(DeckController::class, true);
$decks->get('/api/decks', 'list', 'deck-list');
$decks->get('/api/decks/{slug}', 'get');
$app->mount($decks);

$textToSpeech = new MicroCollection();
$textToSpeech->setHandler(TextToSpeechController::class, true);
$textToSpeech->get('/api/text-to-speech/{text}', 'get');
$app->mount($textToSpeech);

// not found
$app->notFound(function () use ($container) {
    $container->getShared('responseFactory')->create404()->send();
});