<?php

namespace BrainGames\Games\gcd;

use function BrainGames\gameEngine\launchGame;

use const BrainGames\gameEngine\ROUNDS_LIMIT;

function launchBrainGcdGame()
{
    $description = "Find the greatest common divisor of given numbers.";
    $maxNumber = 1000;

    for ($i = 0; $i < ROUNDS_LIMIT; $i++) {
        [$numberOne, $numberTwo] = [rand(0, $maxNumber), rand(0, $maxNumber)];
        $question = "{$numberOne} {$numberTwo}";
        $correctAnswer = findGCD($numberOne, $numberTwo);

        $gameData[$i] = [$question, (string) $correctAnswer];
    }
    launchGame($description, $gameData);
}

function findGCD($firstNumber, $secondNumber)
{
    [$numberOne, $numberTwo] = [$firstNumber, $secondNumber];
    while ($numberOne != $numberTwo) {
        if ($numberOne > $numberTwo) {
            $numberOne = $numberOne - $numberTwo;
        } else {
            $numberTwo = $numberTwo - $numberOne;
        }
    }
    return $numberOne;
}
