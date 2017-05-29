<?php

namespace ResourceContext\Service;

use ResourceContext\Model\TextToSpeech;
use ResourceContext\Repository\TextToSpeechRepository;

class TextToSpeechService
{
    /**
     * @var TextToSpeechRepository
     */
    protected $repository;
    
    /**
     * @var string
     */
    protected $key;
    
    /**
     * @param TextToSpeechRepository $repository
     * @param string                 $key
     */
    public function __construct(TextToSpeechRepository $repository, $key)
    {
        $this->repository = $repository;
        $this->key = $key;
    }
    
    /**
     * @param string $text
     * @return TextToSpeech
     */
    public function get($text)
    {
        $text = mb_strtolower($text, 'UTF-8');
        $textToSpeech = $this->repository->findByText($text);

        // we do not have the audio cached so fetch it
        if (!$textToSpeech) {
            $query = http_build_query([
                'key' => $this->key,
                'hl' => 'en-gb',
                'src' => $text,
                'c' => 'mp3',
                'f' => '48khz_16bit_stereo'
            ]);
            $audio = file_get_contents('https://api.voicerss.org/?' . $query);
            
            // create new text to speech and cache it for next requests
            $textToSpeech = $this->repository->create($text, $audio);
            $textToSpeech->save();
        }
        
        return $textToSpeech;
    }
}
    