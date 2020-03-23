<?php

namespace BrainGames\Games\even;

use function BrainGames\gameEngine\launchGame;

use const BrainGames\gameEngine\ROUND_LIMIT;

function launchBrainEvenGame()
{
    $gameInitialMessage = "Answer \"yes\" if the number is even, "
    . "otherwise answer \"no\".\n";
    $maxNumberLimit = 50;

    for ($i = 0; $i < ROUND_LIMIT; $i++) {
        $question = rand(0, $maxNumberLimit);
        $correctAnswer = isEven($question) ? 'yes' : 'no';

        $gameData[$i][0] = (string) $question;
        $gameData[$i][1] = $correctAnswer;
    }
    
    launchGame($gameInitialMessage, $gameData);
}

function isEven($setNumber)
{
    return $setNumber % 2 === 0;
}
