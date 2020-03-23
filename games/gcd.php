<?php

namespace BrainGames\Games\gcd;

use function BrainGames\gameEngine\launchGame;

use const BrainGames\gameEngine\ROUND_LIMIT;

function launchBrainGcdGame()
{
    $gameInitialMessage = "Find the greatest common divisor "
    . "of given numbers.\n";
    
    for ($i = 0; $i < ROUND_LIMIT; $i++) {
        list ($numberOne, $numberTwo) = getNumbersForBrainGcdGame();
        $question = "{$numberOne} {$numberTwo}";
        $correctAnswer = (string) findGCD($numberOne, $numberTwo);

        $gameData[$i][0] = $question;
        $gameData[$i][1] = $correctAnswer;
    }
    launchGame($gameInitialMessage, $gameData);
}

function getNumbersForBrainGcdGame()
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
