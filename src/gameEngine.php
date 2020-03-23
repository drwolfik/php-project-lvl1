<?php

namespace BrainGames\gameEngine;

use function cli\line;
use function cli\prompt;

const ROUND_LIMIT = 3;

function launchGame($initialMessage, $gameData)
{
    showInitialMessage($initialMessage);
    $playerName = getPlayerName();
    greetPlayer($playerName);
    
    for ($i = 0; $i < ROUND_LIMIT; $i++) {
            line("Question: %s", $gameData[$i][0]);
            $playerAnswer = (string) prompt("Your answer");

        if ($playerAnswer === $gameData[$i][1]) {
            showMessage('correct');
        } else {
            showMessage('mistake', $playerName, $gameData[$i][1], $playerAnswer);
            break;
        }
    }
    showMessage('victory', $playerName);
}

function showInitialMessage($gameMessage)
{
    line('Welcome to the Brain Games!');
    line($gameMessage);
}

function greetPlayer(string $playerName)
{
    line("Hello, %s!\n", $playerName);
}

function getPlayerName()
{
    $name = prompt('May I have your name? ');
    return $name;
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
