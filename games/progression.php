<?php

namespace BrainGames\Games\progression;

use function BrainGames\gameEngine\{showMessage, checkAnswer, getPlayerName};
use function BrainGames\gameEngine\{showInitialMessage, greetPlayer};
use function cli\line;

function launchBrainProgressionGame()
{
    $gameInitialMessage = "What number is missing in the progression?\n";
    showInitialMessage($gameInitialMessage);
    $playerName = getPlayerName();
    greetPlayer($playerName);

    for ($i = 0; $i < 3; $i++) {
        $correctAnswer = (string) setArithmeticProgression();
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

function setArithmeticProgression()
{
    $progressionSize = 10;
    $maxIncreaseRate = 10;
    $firstNumberInProgression = rand(0, $progressionSize);
    $increaseRate = rand(1, $maxIncreaseRate);
    $hiddenElementPlace = rand(0, $progressionSize - 1);
    $arrayForArithmeticProgression[0] = $firstNumberInProgression;

    for ($i = 0; $i < $progressionSize - 1; $i++) {
        $arrayForArithmeticProgression[] = $arrayForArithmeticProgression[$i] + $increaseRate;
    }

    $valueOfHiddenElement = $arrayForArithmeticProgression[$hiddenElementPlace];
    showProgressionWithHiddenElement($arrayForArithmeticProgression, $valueOfHiddenElement);

    return $valueOfHiddenElement;
}

function showProgressionWithHiddenElement(array $arrayWithProgression, $elementToHide)
{
    $strWithHiddenElement = "";

    foreach ($arrayWithProgression as $value) {
        if ($value === $elementToHide) {
            $strWithHiddenElement = "{$strWithHiddenElement} ..";
            continue;
        }
        $strWithHiddenElement = "{$strWithHiddenElement} {$value}";
    }
    line("Question:%s", $strWithHiddenElement);
}
