<?php

namespace BrainGames\Games\prime;

use function BrainGames\gameEngine\{showMessage, checkAnswer, getPlayerName};
use function BrainGames\gameEngine\{showInitialMessage, greetPlayer};
use function cli\line;

function launchBrainPrimeGame()
{
    $gameInitialMessage = "Answer \"yes\" if given number is prime. "
    . "Otherwise answer \"no\".\n";
    showInitialMessage($gameInitialMessage);
    $playerName = getPlayerName();
    greetPlayer($playerName);
    
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
    $maxNumberLimit = 1000;
    $number = rand(1, $maxNumberLimit);
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
