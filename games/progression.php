<?php

namespace BrainGames\Games\progression;

use function BrainGames\gameEngine\launchGame;

use const BrainGames\gameEngine\ROUNDS_LIMIT;

const PROGRESSION_SIZE = 10;

function launchBrainProgressionGame()
{
    $gameInitialMessage = "What number is missing in the progression?\n";
    $maxIncreaseRate = 20;

    for ($i = 0; $i < ROUNDS_LIMIT; $i++) {
        $firstNumber = rand(0, PROGRESSION_SIZE);
        $step = rand(1, $maxIncreaseRate);
        $progression = getArithmeticProgression($firstNumber, $step);
        $hidElementPlace = rand(0, count($progression) - 1);
        $correctAnswer = (string) $progression[$hidElementPlace];
        $question = generateQuestion($progression, $hidElementPlace);
        
        $gameData[$i] = [$question, $correctAnswer];
    }
    launchGame($gameInitialMessage, $gameData);
}

function getArithmeticProgression($firstNumber, $step)
{
    $progression[0] = $firstNumber;

    for ($i = 1; $i < PROGRESSION_SIZE - 1; $i++) {
        $progression[] = $firstNumber + $step * $i;
    }

    return $progression;
}

function generateQuestion(array $progression, $hidElementPlace)
{
    $strWithHiddenElement = "";

    foreach ($progression as $key => $value) {
        if ($key === $hidElementPlace) {
            $strWithHiddenElement = "{$strWithHiddenElement} ..";
            continue;
        }
        $strWithHiddenElement = "{$strWithHiddenElement} {$value}";
    }
    return $strWithHiddenElement;
}
