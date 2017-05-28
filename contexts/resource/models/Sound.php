<?php

namespace ResourceContext\Model;

use Phalcon\Mvc\MongoCollection;

class Sound extends MongoCollection
{
    public $_id;
    public $text;
    protected $audio;
    
    /**
     * @return string
     */
    public function getSource()
    {
        return 'resources.sounds';
    }
    
    /**
     * @return string
     */
    public function getAudio()
    {
        return base64_decode($this->audio);
    }
    
    /**
     * @param string $audio
     */
    public function setAudio($audio)
    {
        $this->audio = base64_encode($audio);
    }
    
    /**
     * Factory method.
     *
     * @param string $text
     * @param string $audio
     * @return Sound
     */
    public static function build($text, $audio)
    {
        $sound = new self();
        $sound->text = $text;
        $sound->setAudio($audio);
        
        return $sound;
    }
}