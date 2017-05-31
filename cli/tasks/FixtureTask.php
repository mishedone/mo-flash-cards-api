<?php

use Phalcon\Cli\Task;

class FixtureTask extends Task
{
    public function loadDecksAction()
    {
        echo "This is the default task and the default action" . PHP_EOL;
    }
}