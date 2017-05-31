<?php

namespace ResourceContext\Controller;

use Phalcon\Mvc\Controller;

class TextToSpeechController extends Controller
{    
    /**
     * Returns an audio/mpeg pronouncing the text parameter.
     *
     * @param string $text
     */
    public function getAction($text)
    {
        $audio = $this->textToSpeechManager->get($text)->getAudio();
        
        $this->response->setContent($audio);
        $this->response->setContentType('audio/mpeg');
    }
}