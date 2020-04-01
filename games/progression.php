<?php

namespace BrainGames\Games\progression;

use function BrainGames\gameEngine\launchGame;

use const BrainGames\gameEngine\ROUNDS_LIMIT;

const PROGRESSION_SIZE = 10;

function launchBrainProgressionGame()
{
    $description = "What number is missing in the progression?";
    $maxIncreaseRate = 20;

    for ($i = 0; $i < ROUNDS_LIMIT; $i++) {
        $firstNumber = rand(0, PROGRESSION_SIZE);
        $step = rand(1, $maxIncreaseRate);
        
        for ($a = 0; $a < PROGRESSION_SIZE - 1; $a++) {
            $progression[$a] = $firstNumber + $step * $a;
        }
        $hiddenElementPlace = array_rand($progression);
        $correctAnswer = (string) $progression[$hiddenElementPlace];
        
        $question = $progression;
        $question[$hiddenElementPlace] = '..';
        $question = implode(' ', $question);
        
        $gameData[$i] = [$question, $correctAnswer];
    }
    launchGame($description, $gameData);
}
