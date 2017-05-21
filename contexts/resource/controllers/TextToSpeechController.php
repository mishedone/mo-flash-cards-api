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
        $audio = $this->di->get('textToSpeechService')->get($text);
        
        $this->response->setContent($audio);
        $this->response->setContentType('audio/mpeg');
    }
}