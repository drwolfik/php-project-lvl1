<?php

namespace BrainEven\Cli;

require __DIR__ . '/../vendor/autoload.php';

use function cli\line;
use function cli\prompt;
use function cli\choose;
use function cli\menu;

function greetPlayer()
{
    line('Welcome to the Brain Games!');
    line("Answer \"yes\" if the number is even, otherwise answer \"no\".\n");
    $name = prompt('May I have your name? ');
    line("Hello, %s!\n", $name);

    return true;
}

function askRandNumber(int $rndNumber)
{
    line("Question: %i", $rndNumber);
}

//function isAnswerCorrect(string $answer): bool
//{
    
//}

//menu(['yes', 'no'], null, "What is love?");
greetPlayer();
line("Question: %d", rand(1, 20));
$choice = prompt("Your answer");
print_r("{$choice}\n");

//greetPlayer();
