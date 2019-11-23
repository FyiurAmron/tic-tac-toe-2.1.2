<?php

require "vendor/autoload.php";

function getResult(\Foo\ClassicTicTacToe $ticTacToe)
{
    if ($ticTacToe->isEnded()) {
        if ($ticTacToe->isTied()) {
            return "Remis";
        }
        return "Wygrana: " . $ticTacToe->getWinner()->getSign();
    }
    return "Gramy dalej";
}

$ticTacToe = new \Foo\ClassicTicTacToe();
$ticTacToe->putX(0, 0);
echo "X na 0,0 | " . getResult($ticTacToe) . PHP_EOL;
$ticTacToe->putO(0, 2);
echo "O na 0,2 | " . getResult($ticTacToe) . PHP_EOL;
$ticTacToe->putX(2, 2);
echo "X na 2,2 | " . getResult($ticTacToe) . PHP_EOL;
$ticTacToe->putO(1, 1);
echo "O na 1,1 | " . getResult($ticTacToe) . PHP_EOL;
$ticTacToe->putX(2, 0);
echo "X na 2,0 | " . getResult($ticTacToe) . PHP_EOL;
$ticTacToe->putO(2, 1);
echo "O na 2,1 | " . getResult($ticTacToe) . PHP_EOL;
$ticTacToe->putX(1, 0);
echo "X na 1,0 | " . getResult($ticTacToe) . PHP_EOL;
