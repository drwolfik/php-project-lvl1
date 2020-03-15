<?php

namespace BrainGames\Games\prime;

use function BrainGames\gameEngine\{launchGame, getRoundLimiter};
use function cli\line;

function launchBrainPrimeGame()
{
    $gameInitialMessage = "Answer \"yes\" if given number is prime. "
    . "Otherwise answer \"no\".\n";
    $roundLimit = getRoundLimiter();
    
    for ($i = 0; $i < $roundLimit; $i++) {
        $numberForBrainPrimeGame = setNumberForBrainPrimeGame();
        $correctAnswer = isPrimeNumber($numberForBrainPrimeGame) ? 'yes' : 'no';

        $questions[$i] = (string) $numberForBrainPrimeGame;
        $correctAnswers[$i] = $correctAnswer;
    }
    launchGame($gameInitialMessage, $questions, $correctAnswers);
}

function setNumberForBrainPrimeGame()
{
    $maxNumberLimit = 1000;
    $number = rand(1, $maxNumberLimit);
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
