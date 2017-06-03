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
    
    /**
     * Lists the names and slugs of all available decks.
     *
     * @return array
     */
    public function list()
    {
        return Deck::find([
            'fields' => [
                'name' => true,
                'slug' => true
            ]
        ]);
    }
    
    /**
     * Searches for a deck by its slug.
     *
     * @param string $slug
     * @return Deck|false
     */
    public function findBySlug($slug)
    {
        return Deck::findFirst([['slug' => $slug]]);
    }
}