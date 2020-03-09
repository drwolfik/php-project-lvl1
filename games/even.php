<?php

namespace BrainGames\Games\even;

use function BrainGames\gameEngine\{showMessage, checkAnswer, getPlayerName};
use function BrainGames\gameEngine\{showInitialMessage, greetPlayer};
use function cli\line;

function launchBrainEvenGame()
{
    $gameInitialMessage = "Answer \"yes\" if the number is even, "
    . "otherwise answer \"no\".\n";
    showInitialMessage($gameInitialMessage);
    $playerName = getPlayerName();
    greetPlayer($playerName);
    
    for ($i = 0; $i < 3; $i++) {
        $numberForBrainEvenGame = setNumberForBrainEvenGame();
        $correctAnswer = isEven($numberForBrainEvenGame) ? 'yes' : 'no';
        list ($playerAnswer, $isAnswerCorrect) = checkAnswer($correctAnswer);
        if ($isAnswerCorrect) {
            showMessage('correct');
        } else {
            showMessage('mistake', $playerName, $correctAnswer, $playerAnswer);
            break;
        }
    }
    showMessage('victory', $playerName);
}

function setNumberForBrainEvenGame()
{
    $maxNumberLimit = 50;
    $rndNumber = rand(0, $maxNumberLimit);
    line("Question: %d", $rndNumber);
    return $rndNumber;
}

function isEven($setNumber)
{
    return $setNumber % 2 === 0;
}
