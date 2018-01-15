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
    public function get($text)
    {
        $decodedText = base64_decode($text);
        $audio = $this->textToSpeechManager->get($decodedText)->getAudio();
        $this->modelManager->flush();
        
        $this->response->setContent($audio);
        $this->response->setContentType('audio/mpeg');
    }
}