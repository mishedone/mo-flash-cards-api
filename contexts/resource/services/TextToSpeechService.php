<?php

namespace ResourceContext\Service;

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
     * @return string
     */
    public function get($text)
    {
        $text = mb_strtolower($text, 'UTF-8');
        
        $audio = file_get_contents('https://api.voicerss.org/?' . http_build_query([
            'key' => $this->apiKey,
            'hl' => 'en-gb',
            'src' => $text,
            'c' => 'mp3',
            'f' => '48khz_16bit_stereo'
        ]));
        
        return $audio;
    }
}
    