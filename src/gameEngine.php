<?php

namespace BrainGames\gameEngine;

use function cli\line;
use function cli\prompt;

function greetPlayer($greetMessage)
{
    line('Welcome to the Brain Games!');
    line($greetMessage);
    $name = prompt('May I have your name? ');
    line("Hello, %s!\n", $name);
    return $name;
}

function checkAnswer(string $answer)
{
    $playerAnswer = (string) prompt("Your answer");
    return array($playerAnswer, $answer === $playerAnswer);
}

function showMessage($messageType, $playerName = null, $corrAnswer = null, $playerAnswer = null)
{
    switch ($messageType) {
        case 'correct':
            line("Correct!");
            break;
        case 'mistake':
            line("{$playerAnswer} is wrong answer ;(. Correct answer was {$corrAnswer}.");
            exit("Let's try again, {$playerName}!\n");
        case 'victory':
            line('Congratulations, %s!', $playerName);
            break;
    }
}
