<?php

namespace BrainGames\Games\moduleBrainGcd;

use function BrainGames\gameEngine\showMessage;
use function BrainGames\gameEngine\checkAnswer;
use function BrainGames\gameEngine\greetPlayer;
use function cli\line;

function launchBrainGcdGame()
{
    $playerName = greetPlayer("Find the greatest common divisor of given numbers.\n");
    
    for ($i = 0; $i < 3; $i++) {
        list ($numberOne, $numberTwo) = setNumbersForBrainGcdGame();
        $correctAnswer = findGCD($numberOne, $numberTwo);
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
    $rndNumberOne = rand(0, 100);
    $rndNumberTwo = rand(0, 100);
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
    return (string) $firstNumber;
}
