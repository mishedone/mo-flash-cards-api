<?php

namespace DeckContext\Model;

use Phalcon\Mvc\MongoCollection;

class Deck extends MongoCollection
{
    public $_id;
    protected $name;
    protected $slug;
    public $cards;
    
    /**
     * @return string
     */
    public function getSource()
    {
        return 'decks.decks';
    }
    
    /**
     * Adds a card to the deck.
     *
     * @param string $front
     * @param string $back
     */
    public function addCard($front, $back)
    {
        $this->cards[] = [
            'front' => $front,
            'back' => $back
        ];
    }
    
    /**
     * @param string $name
     * @param string $slug
     */
    public function init($name, $slug)
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->cards = [];
    }
}