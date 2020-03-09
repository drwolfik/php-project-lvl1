<?php

namespace BrainGames\Games\gcd;

use function BrainGames\gameEngine\{showMessage, checkAnswer, getPlayerName};
use function BrainGames\gameEngine\{showInitialMessage, greetPlayer};
use function cli\line;

function launchBrainGcdGame()
{
    $gameInitialMessage = "Find the greatest common divisor "
    . "of given numbers.\n";
    showInitialMessage($gameInitialMessage);
    $playerName = getPlayerName();
    greetPlayer($playerName);    
    
    for ($i = 0; $i < 3; $i++) {
        list ($numberOne, $numberTwo) = setNumbersForBrainGcdGame();
        $correctAnswer = (string) findGCD($numberOne, $numberTwo);
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

function setNumbersForBrainGcdGame()
{
    $maxNumberLimit = 1000;
    $rndNumberOne = rand(0, $maxNumberLimit);
    $rndNumberTwo = rand(0, $maxNumberLimit);
    line("Question: %d %d", $rndNumberOne, $rndNumberTwo);
    return array ($rndNumberOne, $rndNumberTwo);
}

function findGCD($firstNumber, $secondNumber)
{
    while ($firstNumber != $secondNumber) {
        if ($firstNumber > $secondNumber) {
            $firstNumber = $firstNumber - $secondNumber;
        } else {
            $secondNumber = $secondNumber - $firstNumber;
        }
    }
    return $firstNumber;
}
