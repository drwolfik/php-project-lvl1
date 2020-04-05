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
        
        $progression = generateProgression($firstNumber, $step);

        $hiddenElementPlace = array_rand($progression);
        $correctAnswer = $progression[$hiddenElementPlace];
        
        $question = $progression;
        $question[$hiddenElementPlace] = '..';
        $question = implode(' ', $question);
        
        $gameData[$i] = [$question, (string) $correctAnswer];
    }
    launchGame($description, $gameData);
}

function generateProgression($firstNumber, $step)
{
    for ($i = 0; $i < PROGRESSION_SIZE - 1; $i++) {
        $progression[$i] = $firstNumber + $step * $i;
    }

    return $progression;
}
