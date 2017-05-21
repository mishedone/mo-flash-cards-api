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
        $audio = file_get_contents('https://api.voicerss.org/?' . http_build_query([
            'key' => '36b73c895a48485faedd7f6f8de71eb0',
            'hl' => 'en-gb',
            'src' => $text,
            'c' => 'mp3',
            'f' => '48khz_16bit_stereo'
        ]));
        
        $this->response->setContent($audio);
        $this->response->setContentType('audio/mpeg');
    }
}