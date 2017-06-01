<?php

namespace DeckContext\Repository;

use DeckContext\Model\Deck;

class DeckRepository
{
    /**
     * Factory method.
     *
     * @param string $name
     * @param string $slug
     * @return Deck
     */
    public function create($name, $slug)
    {
        $deck = new Deck();
        $deck->init($name, $slug);
        
        return $deck;
    }
}