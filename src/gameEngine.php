<?php

namespace BrainGames\gameEngine;

use function cli\line;
use function cli\prompt;

function launchGame($initialMessage, $questions, $correctAnswers)
{
    $numberOfRounds = getRoundLimiter();
    showInitialMessage($initialMessage);
    $playerName = getPlayerName();
    greetPlayer($playerName);
    
    for ($i = 0; $i < $numberOfRounds; $i++) {
            line("Question: %s", $questions[$i]);
            $playerAnswer = (string) prompt("Your answer");

        if ($playerAnswer === $correctAnswers[$i]) {
            showMessage('correct');
        } else {
            showMessage('mistake', $playerName, $correctAnswers[$i], $playerAnswer);
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

function getRoundLimiter()
{
    $roundLimit = 3;
    return $roundLimit;
}
