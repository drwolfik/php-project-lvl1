<?php

namespace BrainGames\Games\moduleBrainCalc;

use function BrainGames\gameEngine\showMessage;
use function BrainGames\gameEngine\checkAnswer;
use function BrainGames\gameEngine\greetPlayer;
use function cli\line;

function launchBrainCalcGame()
{
    $playerName = greetPlayer("What is the result of the expression?\n");
    
    for ($i = 0; $i < 3; $i++) {
        list ($numberOne, $operator, $numberTwo) = setDataForBrainCalcGame();
        $correctAnswer = effectCalculations($numberOne, $operator, $numberTwo);
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
    $rndOperator = $operatorsArray[rand(0, 2)];
    $rndNumberOne = rand(0, 15);
    $rndNumberTwo = rand(0, 15);
    line("Question: %d %s %d", $rndNumberOne, $rndOperator, $rndNumberTwo);
    return array ($rndNumberOne, $rndOperator, $rndNumberTwo);
}

function effectCalculations($numberOne, $operation, $numberTwo): string
{
    switch ($operation) {
        case '-':
            return (string) ($numberOne - $numberTwo);
            break;
        case '+':
            return (string) ($numberOne + $numberTwo);
            break;
        case '*':
            return (string) ($numberOne * $numberTwo);
            break;
    }
}
