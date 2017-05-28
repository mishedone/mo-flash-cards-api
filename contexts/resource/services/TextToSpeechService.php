<?php

namespace ResourceContext\Service;

use Doctrine\ODM\MongoDB\DocumentManager;
use ResourceContext\Model\TextToSpeech;

class TextToSpeechService
{
    /**
     * @var DocumentManager
     */
    protected $manager;
    
    /**
     * @var string
     */
    protected $apiKey;
    
    /**
     * @param DocumentManager $manager
     * @param string          $apiKey
     */
    public function __construct(DocumentManager $manager, $apiKey)
    {
        $this->manager = $manager;
        $this->apiKey = $apiKey;
    }
    
    /**
     * @param string $text
     * @return TextToSpeech
     */
    public function get($text)
    {
        $text = mb_strtolower($text, 'UTF-8');
        $textToSpeech = $this->manager->getRepository(
            TextToSpeech::class
        )->findOneByText($text);

        // we do not have the audio cached so fetch it
        if (!$textToSpeech) {
            $audio = file_get_contents('https://api.voicerss.org/?' . http_build_query([
                'key' => $this->apiKey,
                'hl' => 'en-gb',
                'src' => $text,
                'c' => 'mp3',
                'f' => '48khz_16bit_stereo'
            ]));
            
            // create new text to speech and cache it for next requests
            $textToSpeech = new TextToSpeech($text, $audio);
            $this->manager->persist($textToSpeech);
        }
        
        return $textToSpeech;
    }
}
    