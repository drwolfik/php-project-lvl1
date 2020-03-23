<?php

namespace BrainGames\Games\calc;

use function BrainGames\gameEngine\launchGame;

use const BrainGames\gameEngine\ROUND_LIMIT;

function launchBrainCalcGame()
{
    $gameInitialMessage = "What is the result of the expression?\n";

    for ($i = 0; $i < ROUND_LIMIT; $i++) {
        list ($numberOne, $operator, $numberTwo) = getDataForBrainCalcGame();
        $question = "{$numberOne} {$operator} {$numberTwo}";
        $correctAnswer = (string) effectCalculations($numberOne, $operator, $numberTwo);

        $gameData[$i][0] = $question;
        $gameData[$i][1] = $correctAnswer;
    }
    launchGame($gameInitialMessage, $gameData);
}

function getDataForBrainCalcGame()
{
    $operators = array('+', '-', '*');
    $maxNumberLimit = 15;
    $rndNumberOfOperator = rand(0, count($operators) - 1);
    $rndOperator = $operators[$rndNumberOfOperator];
    $rndNumberOne = rand(0, $maxNumberLimit);
    $rndNumberTwo = rand(0, $maxNumberLimit);
    return array ($rndNumberOne, $rndOperator, $rndNumberTwo);
}

function effectCalculations($numberOne, $operation, $numberTwo)
{
    switch ($operation) {
        case '-':
            return ($numberOne - $numberTwo);
            break;
        case '+':
            return ($numberOne + $numberTwo);
            break;
        case '*':
            return ($numberOne * $numberTwo);
            break;
    }
}
