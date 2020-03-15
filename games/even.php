<?php

namespace BrainGames\Games\even;

use function BrainGames\gameEngine\{launchGame, getRoundLimiter};
use function cli\line;

function launchBrainEvenGame()
{
    $gameInitialMessage = "Answer \"yes\" if the number is even, "
    . "otherwise answer \"no\".\n";
    $roundLimit = getRoundLimiter();

    for ($i = 0; $i < $roundLimit; $i++) {
        $numberForBrainEvenGame = setNumberForBrainEvenGame();
        $correctAnswer = isEven($numberForBrainEvenGame) ? 'yes' : 'no';

        $questions[$i] = (string) $numberForBrainEvenGame;
        $correctAnswers[$i] = $correctAnswer;
    }
    
    launchGame($gameInitialMessage, $questions, $correctAnswers);
}

function setNumberForBrainEvenGame()
{
    $maxNumberLimit = 50;
    $rndNumber = rand(0, $maxNumberLimit);
    return $rndNumber;
}

function isEven($setNumber)
{
    return $setNumber % 2 === 0;
}
