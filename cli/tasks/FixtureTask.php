<?php

use DeckContext\Model\Deck;
use Phalcon\Cli\Task;

/**
 * Provides various means for populating the database.
 */
class FixtureTask extends Task
{
    /**
     * Loads some startup decks.
     */
    public function loadDecksAction()
    {
        $dir = __DIR__ . '/../data/decks';
        $files = scandir($dir);
        $manager = $this->di->get('modelManager');
        foreach ($files as $file) {
            if (preg_match('/.csv$/', $file)) {
                $deck = $this->readDeck($dir . '/' . $file);
                $manager->persist($deck);
            }
        }
        $manager->flush();
    }
    
    /**
     * Helper method for loading decks. Reads a deck from a csv and adds all
     * cards available.
     *
     * @param string $path
     * @return Deck
     */
    protected function readDeck($path)
    {
        $handle = fopen($path, 'r');
        $deckData = fgetcsv($handle);
        $repository = $this->di->get('deckRepository');
        $deck = $repository->create($deckData[0], $deckData[1]);
        while (false !== $cardData = fgetcsv($handle)) {
            $deck->addCard($cardData[0], $cardData[1]);
        }
        fclose($handle);
        
        return $deck;
    }
}