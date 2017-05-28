<?php

namespace ResourceContext\Service;

use ResourceContext\Model\Sound;

class SoundService
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
     * @return Sound
     */
    public function fromText($text)
    {
        $text = mb_strtolower($text, 'UTF-8');
        $sound = Sound::findFirst([['text' => $text]]);

        // we do not have the audio cached so fetch it
        if (!$sound) {
            $query = http_build_query([
                'key' => $this->apiKey,
                'hl' => 'en-gb',
                'src' => $text,
                'c' => 'mp3',
                'f' => '48khz_16bit_stereo'
            ]);
            $audio = file_get_contents('https://api.voicerss.org/?' . $query);
            
            // create new text to speech and cache it for next requests
            $sound = Sound::build($text, $audio);
            $sound->save();
        }
        
        return $sound;
    }
}
    