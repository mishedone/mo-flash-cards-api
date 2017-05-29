<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;
use ResourceContext\Controller\TextToSpeechController;

$textToSpeech = new MicroCollection();
$textToSpeech->setHandler(TextToSpeechController::class, true);
$textToSpeech->setPrefix('/api');
$textToSpeech->get('/text-to-speech/{text}', 'getAction');
$app->mount($textToSpeech);

// not found
$app->notFound(function () {
    throw new \Exception('Not Found');
});