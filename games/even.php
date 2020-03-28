<?php

namespace BrainGames\Games\even;

use function BrainGames\gameEngine\launchGame;

use const BrainGames\gameEngine\ROUNDS_LIMIT;

function launchBrainEvenGame()
{
    $gameInitialMessage = "Answer \"yes\" if the number is even, "
    . "otherwise answer \"no\".\n";
    $maxNumberLimit = 50;

    for ($i = 0; $i < ROUNDS_LIMIT; $i++) {
        $question = rand(0, $maxNumberLimit);
        $correctAnswer = isEven($question) ? 'yes' : 'no';

        $gameData[$i] = [(string) $question, $correctAnswer];
    }
    
    launchGame($gameInitialMessage, $gameData);
}

function isEven($number)
{
    return $number % 2 === 0;
}
