<?php

namespace BrainGames\Games\moduleBrainPrime;

use function BrainGames\gameEngine\showMessage;
use function BrainGames\gameEngine\checkAnswer;
use function BrainGames\gameEngine\greetPlayer;
use function cli\line;

function launchBrainPrimeGame()
{
    $playerName = greetPlayer("Answer \"yes\" if given number is prime. Otherwise answer \"no\".\n");
    
    for ($i = 0; $i < 3; $i++) {
        $numberForBrainPrimeGame = setNumberForBrainPrimeGame();
        $correctAnswer = isPrimeNumber($numberForBrainPrimeGame) ? 'yes' : 'no';
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

function setNumberForBrainPrimeGame()
{
    $number = rand(1, 1000);
    line("Question: %d", $number);
    return $number;
}

function isPrimeNumber($number)
{
    $divisor = 2;
    while (($divisor ** 2 <= $number) && ($number % $divisor != 0)) {
        $divisor += 1;
    }
    return $divisor ** 2 > $number;
}
