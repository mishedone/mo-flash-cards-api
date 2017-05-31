<?php

namespace ResourceContext\Manager;

use ResourceContext\Model\TextToSpeech;
use ResourceContext\Repository\TextToSpeechRepository;
use Tools\ModelManager;

class TextToSpeechManager
{
    /**
     * @var ModelManager
     */
    protected $manager;
    
    /**
     * @var TextToSpeechRepository
     */
    protected $repository;
    
    /**
     * @var string
     */
    protected $key;
    
    /**
     * @param ModelManager           $manager
     * @param TextToSpeechRepository $repository
     * @param string                 $key
     */
    public function __construct(
        ModelManager $manager,
        TextToSpeechRepository $repository,
        $key
    ) {
        $this->manager = $manager;
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
            $this->manager->persist($textToSpeech);
        }
        
        return $textToSpeech;
    }
}
    