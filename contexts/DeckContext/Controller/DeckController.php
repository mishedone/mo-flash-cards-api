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
    public function list()
    {
        $decks = $this->deckRepository->list();

        return ['results' => array_map(function ($deck) {
            return [
                '_links' => [
                    'cards' => $this->url->get([
                        'for' => 'deck:card-list',
                        'slug' => $deck->getSlug()
                    ])
                ],
                'name' => $deck->getName(),
                'slug' => $deck->getSlug()
            ];
        }, $decks)];
    }
}