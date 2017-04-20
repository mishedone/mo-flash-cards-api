<?php

namespace ResourceContext\Controller;

use Phalcon\Mvc\Controller;

class TextToSpeechController extends Controller
{    
    /**
     * Returns an audio/mpeg pronouncing the text parameter.
     *
     * @param string $text
     * @return array
     */
    public function getAudioAction($text)
    {
        return [
            'text' => $text
        ];
    }
}