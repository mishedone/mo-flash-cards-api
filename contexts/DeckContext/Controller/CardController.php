<?php

namespace DeckContext\Controller;

use Phalcon\Mvc\Controller;

class CardController extends Controller
{
    /**
     * Lists all cards contained in a deck.
     *
     * @param string $slug
     * @return array
     */
    public function list($slug)
    {
        $deck = $this->deckRepository->findBySlug($slug);

        if (!$deck) {
            return $this->responseFactory->create404();
        }

        return ['results' => array_map(function ($card) {
            return [
                '_links' => [
                    'front' => $this->url->get([
                        'for' => 'resource:tts-get',
                        'text' => base64_encode($card['front'])
                    ]),
                    'back' => $this->url->get([
                        'for' => 'resource:tts-get',
                        'text' => base64_encode($card['back'])
                    ])
                ],
                'front' => $card['front'],
                'back' => $card['back']
            ];
        }, $deck->getCards())];
    }
}