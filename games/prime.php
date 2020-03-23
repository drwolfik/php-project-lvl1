<?php

namespace BrainGames\Games\prime;

use function BrainGames\gameEngine\launchGame;

use const BrainGames\gameEngine\ROUND_LIMIT;

function launchBrainPrimeGame()
{
    $gameInitialMessage = "Answer \"yes\" if given number is prime. "
    . "Otherwise answer \"no\".\n";
    
    for ($i = 0; $i < ROUND_LIMIT; $i++) {
        $numberForBrainPrimeGame = getNumberForBrainPrimeGame();
        $question = (string) $numberForBrainPrimeGame;
        $correctAnswer = isPrimeNumber($numberForBrainPrimeGame) ? 'yes' : 'no';
                
        $gameData[$i][0] = $question;
        $gameData[$i][1] = $correctAnswer;
    }
    launchGame($gameInitialMessage, $gameData);
}

function getNumberForBrainPrimeGame()
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
