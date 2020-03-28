<?php

namespace BrainGames\Games\gcd;

use function BrainGames\gameEngine\launchGame;

use const BrainGames\gameEngine\ROUNDS_LIMIT;

function launchBrainGcdGame()
{
    $gameInitialMessage = "Find the greatest common divisor "
    . "of given numbers.\n";
    $maxNumberLimit = 1000;

    for ($i = 0; $i < ROUNDS_LIMIT; $i++) {
        $numberOne = rand(0, $maxNumberLimit);
        $numberTwo = rand(0, $maxNumberLimit);
        $question = "{$numberOne} {$numberTwo}";
        $correctAnswer = (string) findGCD($numberOne, $numberTwo);

        $gameData[$i] = [$question, $correctAnswer];
    }
    launchGame($gameInitialMessage, $gameData);
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
