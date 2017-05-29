<?php

namespace ResourceContext\Service;

use ResourceContext\Model\TextToSpeech;

class TextToSpeechService
{    
    /**
     * @var string
     */
    protected $apiKey;
    
    /**
     * @param string $apiKey
     */
    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }
    
    /**
     * @param string $text
     * @return TextToSpeech
     */
    public function get($text)
    {
        $text = mb_strtolower($text, 'UTF-8');
        $textToSpeech = TextToSpeech::findFirst([['text' => $text]]);

        // we do not have the audio cached so fetch it
        if (!$textToSpeech) {
            $query = http_build_query([
                'key' => $this->apiKey,
                'hl' => 'en-gb',
                'src' => $text,
                'c' => 'mp3',
                'f' => '48khz_16bit_stereo'
            ]);
            $audio = file_get_contents('https://api.voicerss.org/?' . $query);
            
            // create new text to speech and cache it for next requests
            $textToSpeech = TextToSpeech::build($text, $audio);
            $textToSpeech->save();
        }
        
        return $textToSpeech;
    }
}
    