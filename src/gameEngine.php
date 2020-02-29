<?php

namespace BrainGames\gameEngine;

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
        case 'brain-prime':
            line("Answer \"yes\" if given number is prime. Otherwise answer \"no\".\n");
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
            $numberForBrainEvenGame = setNumberForBrainEvenGame();
            return isEven($numberForBrainEvenGame) ? 'yes' : 'no';
        break;
        case 'brain-calc':
            list ($numberOne, $operator, $numberTwo) = setDataForBrainCalcGame();
            return effectCalculations($numberOne, $operator, $numberTwo);
            break;
        case 'brain-gcd':
            list ($numberOne, $numberTwo) = setNumbersForBrainGcdGame();
            return findGCD($numberOne, $numberTwo);
            break;
        case 'brain-progression':
            $hiddenElementOfProgression = setArithmeticProgression();
            return $hiddenElementOfProgression;
            break;
        case 'brain-prime':
            $numberForBrainPrimeGame = setNumberForBrainPrimeGame();
            return isPrimeNumber($numberForBrainPrimeGame) ? 'yes' : 'no';
            break;
    }
}

function setArithmeticProgression()
{
    $firstNumberInProgression = rand(0, 10);
    $increaseRate = rand(1, 10);
    $hiddenElementPlace = rand(0, 9);
    $arrayForArithmeticProgression[0] = $firstNumberInProgression;

    for ($i = 0; $i < 9; $i++) {
        $arrayForArithmeticProgression[] = $arrayForArithmeticProgression[$i] + $increaseRate;
    }

    $valueOfHiddenElement = $arrayForArithmeticProgression[$hiddenElementPlace];
    showProgressionWithHiddenElement($arrayForArithmeticProgression, $valueOfHiddenElement);

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
        case 'brain-prime':
        case 'brain-even':
            $playerAnswer = prompt("Your answer");
            return array($playerAnswer, $answer === $playerAnswer);
            break;
        case 'brain-calc':
        case 'brain-gcd':
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
            line("{$playerAnswer} is wrong answer ;(. Correct answer was {$corrAnswer}.");
            exit("Let's try again, {$playerName}!\n");
        case 'victory':
            line('Congratulations, %s!', $playerName);
            break;
    }
}

function showProgressionWithHiddenElement(array $arrayWithProgression, $elementToHide)
{
    $strWithHiddenElement = "";

    foreach ($arrayWithProgression as $value) {
        if ($value === $elementToHide) {
            $strWithHiddenElement = "{$strWithHiddenElement} ..";
            continue;
        }
        $strWithHiddenElement = "{$strWithHiddenElement} {$value}";
    }
    line("Question:%s", $strWithHiddenElement);
}

function setNumberForBrainEvenGame()
{
    $rndNumber = rand(0, 50);
    line("Question: %d", $rndNumber);
    return $rndNumber;
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

function setNumbersForBrainGcdGame()
{
    $rndNumberOne = rand(0, 100);
    $rndNumberTwo = rand(0, 100);
    line("Question: %d %d", $rndNumberOne, $rndNumberTwo);
    return array ($rndNumberOne, $rndNumberTwo);
}

function setNumberForBrainPrimeGame()
{
    $number = rand(1, 1000);
    line("Question: %d", $number);
    return $number;
}

function isEven($setNumber)
{
    return $setNumber % 2 === 0;
}

function isPrimeNumber($number)
{
    $divisor = 2;
    while (($divisor ** 2 <= $number) && ($number % $divisor != 0)) {
        $divisor += 1;
    }
    return $divisor ** 2 > $number;
}
