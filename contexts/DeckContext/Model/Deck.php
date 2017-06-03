<?php

namespace DeckContext\Model;

use Phalcon\Mvc\MongoCollection;

class Deck extends MongoCollection
{
    public $_id;
    protected $name;
    protected $slug;
    protected $cards;
    
    /**
     * @return string
     */
    public function getSource()
    {
        return 'decks.decks';
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
    
    /**
     * @return array
     */
    public function getCards()
    {
        return $this->cards;
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