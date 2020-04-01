<?php

namespace BrainGames\gameEngine;

use function cli\line;
use function cli\prompt;

const ROUNDS_LIMIT = 3;

function launchGame($description, $gameData)
{
    line('Welcome to the Brain Games!');
    line("%s\n", $description);
    $playerName = prompt('May I have your name? ');
    line("Hello, %s!\n", $playerName);
    
    foreach ($gameData as [$question, $answer]) {
        line("Question: %s", $question);
        $playerAnswer = (string) prompt("Your answer");

        if ($playerAnswer === $answer) {
            line("Correct!\n");
        } else {
            line("{$playerAnswer} is wrong answer ;(."
                . " Correct answer was {$answer}.");
            exit("Let's try again, {$playerName}!\n");
        }
    }
    line('Congratulations, %s!', $playerName);
}
