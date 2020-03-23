<?php

namespace BrainGames\Games\progression;

use function BrainGames\gameEngine\launchGame;

use const BrainGames\gameEngine\ROUND_LIMIT;

function launchBrainProgressionGame()
{
    $gameInitialMessage = "What number is missing in the progression?\n";

    for ($i = 0; $i < ROUND_LIMIT; $i++) {
        $progression = getArithmeticProgression();
        $hidElementPlace = rand(0, count($progression) - 1);
        $correctAnswer = (string) $progression[$hidElementPlace];
        $question = getStrWithHidElement($progression, $hidElementPlace);
        
        $gameData[$i][0] = $question;
        $gameData[$i][1] = $correctAnswer;
    }
    launchGame($gameInitialMessage, $gameData);
}

function getArithmeticProgression()
{
    $progressionSize = 10;
    $maxIncreaseRate = 10;
    $firstNumberInProgression = rand(0, $progressionSize);
    $increaseRate = rand(1, $maxIncreaseRate);
    $arithmeticProgression[0] = $firstNumberInProgression;

    for ($i = 0; $i < $progressionSize - 1; $i++) {
        $arithmeticProgression[] = $arithmeticProgression[$i]
        + $increaseRate;
    }

    return $arithmeticProgression;
}

function getStrWithHidElement(array $progression, $hidElementPlace)
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
