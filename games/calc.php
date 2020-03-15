<?php

namespace BrainGames\Games\calc;

use function BrainGames\gameEngine\{launchGame, getRoundLimiter};
use function cli\line;

function launchBrainCalcGame()
{
    $gameInitialMessage = "What is the result of the expression?\n";
    $roundLimit = getRoundLimiter();

    for ($i = 0; $i < $roundLimit; $i++) {
        list ($numberOne, $operator, $numberTwo) = setDataForBrainCalcGame();

        $questions[$i] = "{$numberOne} {$operator} {$numberTwo}";
        $correctAnswers[$i] = (string) effectCalculations($numberOne, $operator, $numberTwo);
    }
    launchGame($gameInitialMessage, $questions, $correctAnswers);
}

function setDataForBrainCalcGame()
{
    $operatorsArray = array('+', '-', '*');
    $maxNumberLimit = 15;
    $rndNumberOfOperator = rand(0, count($operatorsArray) - 1);
    $rndOperator = $operatorsArray[$rndNumberOfOperator];
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
