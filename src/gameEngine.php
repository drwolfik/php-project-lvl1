<?php

namespace BrainGames\gameEngine;

use function cli\line;
use function cli\prompt;

const ROUNDS_LIMIT = 3;

function launchGame($initialMessage, $gameData)
{
    showInitialMessage($initialMessage);
    $playerName = prompt('May I have your name? ');
    line("Hello, %s!\n", $playerName);
    
    foreach ($gameData as $item) {
        line("Question: %s", $item[0]);
        $playerAnswer = (string) prompt("Your answer");

        if ($playerAnswer === $item[1]) {
            showMessage('correct');
        } else {
            showMessage('mistake', $playerName, $item[1], $playerAnswer);
            exit("Let's try again, {$playerName}!\n");
        }
    }
    showMessage('victory', $playerName);
}

function showInitialMessage($gameMessage)
{
    line('Welcome to the Brain Games!');
    line($gameMessage);
}

function showMessage($messageType, $playerName = null, $corrAnswer = null, $playerAnswer = null)
{
    switch ($messageType) {
        case 'correct':
            line("Correct!");
            break;
        case 'mistake':
            line("{$playerAnswer} is wrong answer ;(. Correct answer was {$corrAnswer}.");
            break;
        case 'victory':
            line('Congratulations, %s!', $playerName);
            break;
    }
}
