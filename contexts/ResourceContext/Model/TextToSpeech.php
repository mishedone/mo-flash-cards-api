<?php

namespace ResourceContext\Model;

use Phalcon\Mvc\MongoCollection;

class TextToSpeech extends MongoCollection
{
    public $_id;
    protected $text;
    protected $audio;
    
    /**
     * @return string
     */
    public function getSource()
    {
        return 'resources.texttospeech';
    }

    /**
     * @return string
     */
    public function getAudio()
    {
        return base64_decode($this->audio);
    }
    
    /**
     * @param string $text
     * @param string $audio
     */
    public function init($text, $audio)
    {
        $this->text = $text;
        $this->audio = base64_encode($audio);
    }
}