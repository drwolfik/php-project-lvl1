<?php

namespace BrainGames\Games\calc;

use function BrainGames\gameEngine\launchGame;

use const BrainGames\gameEngine\ROUNDS_LIMIT;

function launchBrainCalcGame()
{
    $description = "What is the result of the expression?";

    for ($i = 0; $i < ROUNDS_LIMIT; $i++) {
        $operations = array('+', '-', '*');
        $maxNumber = 15;
        $operation = $operations[array_rand($operations, 1)];
        [$numberOne, $numberTwo] = [rand(0, $maxNumber), rand(0, $maxNumber)];
        
        $question = "{$numberOne} {$operation} {$numberTwo}";
        $correctAnswer = effectCalculations(
            $numberOne,
            $numberTwo,
            $operation
        );

        $gameData[$i] = [$question, (string) $correctAnswer];
    }
    launchGame($description, $gameData);
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
