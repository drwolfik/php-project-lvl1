<?php

namespace BrainGames\Games\progression;

use function BrainGames\gameEngine\{launchGame, getRoundLimiter};
use function cli\line;

function launchBrainProgressionGame()
{
    $gameInitialMessage = "What number is missing in the progression?\n";
    $roundLimit = getRoundLimiter();

    for ($i = 0; $i < $roundLimit; $i++) {
        list ($arrProgression, $correctAnswer) = setArithmeticProgression();
        
        $questions[$i] = getStrWithHidElement($arrProgression, $correctAnswer);
        $correctAnswers[$i] = (string) $correctAnswer;
    }
    launchGame($gameInitialMessage, $questions, $correctAnswers);
}

function setArithmeticProgression()
{
    $progressionSize = 10;
    $maxIncreaseRate = 10;
    $firstNumberInProgression = rand(0, $progressionSize);
    $increaseRate = rand(1, $maxIncreaseRate);
    $hiddenElementPlace = rand(0, $progressionSize - 1);
    $arrayForArithmeticProgression[0] = $firstNumberInProgression;

    for ($i = 0; $i < $progressionSize - 1; $i++) {
        $arrayForArithmeticProgression[] = $arrayForArithmeticProgression[$i]
        + $increaseRate;
    }

    $valueOfHiddenElement = $arrayForArithmeticProgression[$hiddenElementPlace];

    return array ($arrayForArithmeticProgression, $valueOfHiddenElement);
}

function getStrWithHidElement(array $arrayWithProgression, $elementToHide)
{
    $strWithHiddenElement = "";

    foreach ($arrayWithProgression as $value) {
        if ($value === $elementToHide) {
            $strWithHiddenElement = "{$strWithHiddenElement} ..";
            continue;
        }
        $strWithHiddenElement = "{$strWithHiddenElement} {$value}";
    }
    return $strWithHiddenElement;
}
