<?php

namespace BrainGames\Games\calc;

use function BrainGames\gameEngine\{showMessage, checkAnswer, getPlayerName};
use function BrainGames\gameEngine\{showInitialMessage, greetPlayer};
use function cli\line;

function launchBrainCalcGame()
{
    $gameInitialMessage = "What is the result of the expression?\n";
    showInitialMessage($gameInitialMessage);
    $playerName = getPlayerName();
    greetPlayer($playerName);
    
    for ($i = 0; $i < 3; $i++) {
        list ($numberOne, $operator, $numberTwo) = setDataForBrainCalcGame();
        $correctAnswer = (string) effectCalculations($numberOne, $operator, $numberTwo);
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

function setDataForBrainCalcGame()
{
    $operatorsArray = array('+', '-', '*');
    $maxNumberLimit = 15;
    $rndNumberOfOperator = rand(0, count($operatorsArray) - 1);
    $rndOperator = $operatorsArray[$rndNumberOfOperator];
    $rndNumberOne = rand(0, $maxNumberLimit);
    $rndNumberTwo = rand(0, $maxNumberLimit);
    line("Question: %d %s %d", $rndNumberOne, $rndOperator, $rndNumberTwo);
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
