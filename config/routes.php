<?php

use Phalcon\Mvc\Micro\Collection as MicroCollection;

$textToSpeech = new MicroCollection();
$textToSpeech->setHandler('ResourceContext\Controller\TextToSpeechController', true);
$textToSpeech->setPrefix('/api/text-to-speech');
$textToSpeech->get('/{text}', 'getAudioAction');
$app->mount($textToSpeech);

// not found
$app->notFound(function () {
    throw new \Exception('Not Found');
});