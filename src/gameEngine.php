<?php

namespace BrainEven\gameEngine;

use function cli\line;
use function cli\prompt;

function greetPlayer($gameType) // Функция для вывода приветственного сообщения и получении имени игрока
{

    line('Welcome to the Brain Games!');

    switch ($gameType) {
        case 'brain-even':
            line("Answer \"yes\" if the number is even, otherwise answer \"no\".\n");
            break;
        case 'brain-calc':
            line("What is the result of the expression?\n");
            break;
        case 'brain-gcd':
            line("Find the greatest common divisor of given numbers.\n");
            break;
        case 'brain-progression':
            line("What number is missing in the progression?\n");
            break;
    }
    $name = prompt('May I have your name? ');
    line("Hello, %s!\n", $name);
    return $name;
}

function launchGame($gameType)
{
    $playerName = greetPlayer($gameType);
    for ($i = 0; $i < 3; $i++) {
        $correctAnswer = askGameQuestions($gameType);
        list ($playerAnswer, $isAnswerCorrect) = checkAnswer($gameType, $correctAnswer);
        if ($isAnswerCorrect) {
            showMessage('correct');
        } else {
            showMessage('mistake', $playerName, $correctAnswer, $playerAnswer);
            break;
        }
    }
    showMessage('victory', $playerName);
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
        case 'brain-gcd':
            $rndNumberOne = rand(0, 100);
            $rndNumberTwo = rand(0, 100);
            line("Question: %d %d", $rndNumberOne, $rndNumberTwo);
            return findGCD($rndNumberOne, $rndNumberTwo);
            break;
        case 'brain-progression':
            return setArithmeticProgression();
            break;
    }
}

function setArithmeticProgression()
{
    $firstNumberInProgression = rand(0, 10);
    $increaseRate = rand(1, 10);
    $hiddentElementPlace = rand(0, 9);
    $arrayForArithmeticProgression[0] = $firstNumberInProgression;

    for ($i = 0; $i < 9; $i++) {
        $arrayForArithmeticProgression[] = $arrayForArithmeticProgression[$i] + $increaseRate;
    }

    $valueOfHiddenElement = $arrayForArithmeticProgression[$hiddentElementPlace];

    $progressionWithHiddenElement = "";

    foreach ($arrayForArithmeticProgression as $value) {
        if ($value === $valueOfHiddenElement) {
            $progressionWithHiddenElement = "{$progressionWithHiddenElement} ..";
            continue;
        }
        $progressionWithHiddenElement = "{$progressionWithHiddenElement} {$value}";
    }
    line("Question:%s", $progressionWithHiddenElement);

    return $valueOfHiddenElement;
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

function effectCalculations($numberOne, $operation, $numberTwo)
{
    switch ($operation) {
        case '-':
            return $numberOne - $numberTwo;
            break;
        case '+':
            return $numberOne + $numberTwo;
            break;
        case '*':
            return $numberOne * $numberTwo;
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
        case 'brain-gcd':
            $playerAnswer = (int) prompt('Your answer');
            return array ($playerAnswer, $answer === $playerAnswer);
            break;
        case 'brain-progression':
            $playerAnswer = (int) prompt('Your answer');
            return array ($playerAnswer, $answer === $playerAnswer);
            break;
    }
}

function showMessage($messageType, $playerName = null, $corrAnswer = null, $playerAnswer = null)
{
    switch ($messageType) {
        case 'correct':
            line("Correct!");
            break;
        case 'mistake':
            exit("{$playerAnswer} is wrong answer ;(. Correct answer was {$corrAnswer}.\nLet's try again, {$playerName}!\n");
            break;
        case 'victory':
            line('Congratulations, %s!', $playerName);
            break;
    }
}

function isEven($setNumber)             // Функция получения статуса числа: чётное или нечётное
{
    return ($setNumber % 2 === 0) ? 'yes' : 'no';
}
