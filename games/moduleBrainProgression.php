<?php

namespace BrainGames\Games\moduleBrainProgression;

use function BrainGames\gameEngine\showMessage;
use function BrainGames\gameEngine\checkAnswer;
use function BrainGames\gameEngine\greetPlayer;
use function cli\line;

function launchBrainProgressionGame()
{
    $playerName = greetPlayer("What number is missing in the progression?\n");
    
    for ($i = 0; $i < 3; $i++) {
        $correctAnswer = setArithmeticProgression();
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
    $firstNumberInProgression = rand(0, 10);
    $increaseRate = rand(1, 10);
    $hiddenElementPlace = rand(0, 9);
    $arrayForArithmeticProgression[0] = $firstNumberInProgression;

    for ($i = 0; $i < 9; $i++) {
        $arrayForArithmeticProgression[] = $arrayForArithmeticProgression[$i] + $increaseRate;
    }

    $valueOfHiddenElement = $arrayForArithmeticProgression[$hiddenElementPlace];
    showProgressionWithHiddenElement($arrayForArithmeticProgression, $valueOfHiddenElement);

    return (string) $valueOfHiddenElement;
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
