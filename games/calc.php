<?php

namespace BrainGames\Games\calc;

use function BrainGames\gameEngine\launchGame;

use const BrainGames\gameEngine\ROUNDS_LIMIT;

function launchBrainCalcGame()
{
    $gameInitialMessage = "What is the result of the expression?\n";

    for ($i = 0; $i < ROUNDS_LIMIT; $i++) {
        [$numberOne, $numberTwo, $operator] = getDataForBrainCalcGame();
        $question = "{$numberOne} {$operator} {$numberTwo}";
        $correctAnswer = (string) effectCalculations($numberOne, $numberTwo, $operator);

        $gameData[$i] = [$question, $correctAnswer];
    }
    launchGame($gameInitialMessage, $gameData);
}

function getDataForBrainCalcGame()
{
    $operators = array('+', '-', '*');
    $maxNumberLimit = 15;
    $rndOperator = $operators[array_rand($operators, 1)];
    $rndNumberOne = rand(0, $maxNumberLimit);
    $rndNumberTwo = rand(0, $maxNumberLimit);
    return array ($rndNumberOne, $rndNumberTwo, $rndOperator);
}

function effectCalculations($numberOne, $numberTwo, $operation)
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
