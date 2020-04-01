<?php

namespace BrainGames\Games\prime;

use function BrainGames\gameEngine\launchGame;

use const BrainGames\gameEngine\ROUNDS_LIMIT;

function launchBrainPrimeGame()
{
    $description = "Answer \"yes\" if given number is prime. "
    . "Otherwise answer \"no\".";
    $maxNumber = 1000;

    for ($i = 0; $i < ROUNDS_LIMIT; $i++) {
        $numberForGame = rand(1, $maxNumber);
        $question = (string) $numberForGame;
        $correctAnswer = isPrimeNumber($numberForGame) ? 'yes' : 'no';
                
        $gameData[$i] = [$question, $correctAnswer];
    }
    launchGame($description, $gameData);
}

function isPrimeNumber($number)
{
    if ($number <= 1) {
        return false;
    } else {
        $divisor = 2;
        while (($divisor ** 2 <= $number) && ($number % $divisor != 0)) {
            $divisor += 1;
        }
        return $divisor ** 2 > $number;
    }
}
