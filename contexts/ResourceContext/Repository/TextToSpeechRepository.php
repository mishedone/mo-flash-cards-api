<?php

namespace ResourceContext\Repository;

use ResourceContext\Model\TextToSpeech;

class TextToSpeechRepository
{
    /**
     * Factory method.
     *
     * @param string $text
     * @param string $audio
     * @return TextToSpeech
     */
    public function create($text, $audio)
    {
        $textToSpeech = new TextToSpeech();
        $textToSpeech->init($text, $audio);
        
        return $textToSpeech;
    }
    
    /**
     * Searches for the speech representation of a text.
     *
     * @param string $text
     * @return TextToSpeech|false
     */
    public function findByText($text)
    {
        return TextToSpeech::findFirst([['text' => $text]]);
    }
}