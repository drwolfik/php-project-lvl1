<?php

namespace BrainEven\gameEngine;

use function cli\line;
use function cli\prompt;

function greetPlayer($gameType) // Функция для вывода приветственного сообщения и получении имени игрока
{
    switch ($gameType) {
        case 'brain-even':
            line('Welcome to the Brain Games!');
            line("Answer \"yes\" if the number is even, otherwise answer \"no\".\n");
            $name = prompt('May I have your name? ');
            line("Hello, %s!\n", $name);
            return $name;
        break;
        case 'brain-calc':
            line('Welcome to the Brain Games!');
            line("What is the result of the expression?\n");
            $name = prompt('May I have your name? ');
            line("Hello, %s!\n", $name);
            return $name;
        break;
    }
}

function launchGame($gameType)
{
    switch ($gameType) {
        case 'brain-even':
            $plName = greetPlayer($gameType);
            for ($i = 0; $i < 3; $i++) {
                $correctAnswer = askGameQuestions($gameType);
                list ($plAnswer, $isAnswerCorrect) = checkAnswer($gameType, $correctAnswer);
                if ($isAnswerCorrect) {
                    showMessage('correct');
                } else {
                    showMessage('mistake', $plName, $correctAnswer, $plAnswer);
                    break;
                }
            }
            showMessage('victory', $plName);
            break;
    
        case 'brain-calc':
            $plName = greetPlayer($gameType);
            for ($i = 0; $i < 3; $i++) {
                $correctAnswer = askGameQuestions($gameType);
                list ($plAnswer, $isAnswerCorrect) = checkAnswer($gameType, $correctAnswer);
                if ($isAnswerCorrect) {
                    showMessage('correct');
                } else {
                    showMessage('mistake', $plName, $correctAnswer, $plAnswer);
                    break;
                }
            }
            showMessage('victory', $plName);
            break;
    }
}

function askGameQuestions($gameType)
{
    switch ($gameType) {
        case 'brain-even':
            $rndNumber = rand(0, 50);
            line("Question: %d", $rndNumber);
            return isEven($rndNumber);
        break;
        case 'brain-calc':
            $operatorsArray = array('+', '-', '*');
            $operatorChoice = array_rand($operatorsArray);
            $rndOperator = $operatorsArray[$operatorChoice];
            $rndNumberOne = rand(0, 15);
            $rndNumberTwo = rand(0, 15);
            line("Question: %d %s %d", $rndNumberOne, $rndOperator, $rndNumberTwo);
            return effectCalculations($rndNumberOne, $rndOperator, $rndNumberTwo);
        break;
    }
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

function checkAnswer($game, $answer)
{
    switch ($game) {
        case 'brain-even':
            $playerAnswer = prompt("Your answer");
            return array($playerAnswer, $answer === $playerAnswer);
        break;
        case 'brain-calc':
            $playerAnswer = (int) prompt('Your answer');
            return array ($playerAnswer, $answer === $playerAnswer);
        break;
    }
}

function showMessage($messageType, $plName = null, $corrAnswer = null, $plAnswer = null)
{
    switch ($messageType) {
        case 'correct':
            line("Correct!");
            break;
        case 'mistake':
            exit("{$plAnswer} is wrong answer ;(. Correct answer was {$corrAnswer}.\nLet's try again, {$plName}!\n");
        break;
        case 'victory':
            line('Congratulations, %s!', $plName);
            break;
    }
}

function isEven($setNumber)             // Функция получения статуса числа: чётное или нечётное
{
    return ($setNumber % 2 === 0) ? 'yes' : 'no';
}
