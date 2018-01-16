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

        return array_map(function ($deck) {
            return [
                'name' => $deck->getName(),
                'slug' => $deck->getSlug()
            ];
        }, $decks);
    }

    /**
     * Reads details about certain deck.
     *
     * @param string $slug
     * @return array
     */
    public function get($slug)
    {
        $deck = $this->deckRepository->findBySlug($slug);

        if (!$deck) {
            return $this->responseFactory->create404();
        }

        return [
            'name' => $deck->getName(),
            'slug' => $deck->getSlug(),
            'cards' => $deck->getCards()
        ];
    }
}