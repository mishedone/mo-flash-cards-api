<?php

namespace DeckContext\Controller;

use Phalcon\Mvc\Controller;

class DeckController extends Controller
{    
    /**
     * Lists all available decks.
     *
     * @return array
     */
    public function listAction()
    {
        $decks = $this->deckRepository->list();
        
        return array_map(function ($deck) {
            return [
                'name' => $deck->getName(),
                'slug' => $deck->getSlug()
            ];
        }, $decks);
    }
    
    /**
     * Loads a certain deck by it's slug.
     * 
     * @param string $slug
     * @return array
     */
    public function getAction($slug)
    {
        $deck = $this->deckRepository->findBySlug($slug);
            
        if (!$deck) {
            $this->response->setStatusCode(404);
            
            return;
        }
        
        return [
            'name' => $deck->getName(),
            'slug' => $deck->getSlug(),
            'cards' => $deck->getCards()
        ];
    }
}