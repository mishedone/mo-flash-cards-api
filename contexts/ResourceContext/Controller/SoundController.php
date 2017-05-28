<?php

namespace ResourceContext\Controller;

use Phalcon\Mvc\Controller;

class SoundController extends Controller
{    
    /**
     * Returns an audio/mpeg pronouncing the text parameter.
     *
     * @param string $text
     */
    public function fromTextAction($text)
    {
        $audio = $this->soundService->fromText($text)->getAudio();
        
        $this->response->setContent($audio);
        $this->response->setContentType('audio/mpeg');
    }
}