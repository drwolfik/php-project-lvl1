<?php

namespace BrainEven\gameEvenSource;

use function cli\line;
use function cli\prompt;

function greetPlayer()                  // Функция для вывода приветственного сообщения и получении имени игрока
{
    line('Welcome to the Brain Games!');
    line("Answer \"yes\" if the number is even, otherwise answer \"no\".\n");
    $name = prompt('May I have your name? ');
    line("Hello, %s!\n", $name);

    return $name;
}

function askNumber()                    // Функция генерирует случайное число и выводит его на экран
{
    $rndNumber = rand(0, 50);
    line("Question: %d", $rndNumber);
    
    return $rndNumber;
}

function isEven($setNumber)             // Функция получения статуса числа: чётное или нечётное
{
    return ($setNumber % 2 === 0) ? 'yes' : 'no';
}
