<?php

namespace BrainGames\Games\gcd;

use function BrainGames\gameEngine\{launchGame, getRoundLimiter};
use function cli\line;

function launchBrainGcdGame()
{
    $gameInitialMessage = "Find the greatest common divisor "
    . "of given numbers.\n";
    $roundLimit = getRoundLimiter();
    
    for ($i = 0; $i < $roundLimit; $i++) {
        list ($numberOne, $numberTwo) = setNumbersForBrainGcdGame();
        
        $questions[$i] = "{$numberOne} {$numberTwo}";
        $correctAnswers[$i] = (string) findGCD($numberOne, $numberTwo);
    }
    launchGame($gameInitialMessage, $questions, $correctAnswers);
}

function setNumbersForBrainGcdGame()
{
    $maxNumberLimit = 1000;
    $rndNumberOne = rand(0, $maxNumberLimit);
    $rndNumberTwo = rand(0, $maxNumberLimit);
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
