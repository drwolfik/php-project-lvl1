<?php

namespace BrainGames\Games\moduleBrainEven;

use function BrainGames\gameEngine\{greetPlayer, checkAnswer, showMessage};
use function cli\line;

function launchBrainEvenGame()
{
    $playerName = greetPlayer("Answer \"yes\" if the number is even, otherwise answer \"no\".\n");
    
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
    $rndNumber = rand(0, 50);
    line("Question: %d", $rndNumber);
    return $rndNumber;
}

function isEven($setNumber)
{
    return $setNumber % 2 === 0;
}
