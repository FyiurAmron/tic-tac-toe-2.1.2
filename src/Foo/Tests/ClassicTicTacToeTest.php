<?php
/** @noinspection PhpUnhandledExceptionInspection */
declare(strict_types=1);

namespace Foo\Tests;

use Foo\ClassicTicTacToe;
use Foo\Exceptions\FieldTakenException;
use Foo\Exceptions\WrongPlayerException;
use Foo\Marker;
use PHPUnit\Framework\TestCase;

class ClassicTicTacToeTest extends TestCase
{
    public function testSameField()
    {
        $this->expectException(FieldTakenException::class);

        $c = new ClassicTicTacToe();
        $c->putX(1, 1);
        $c->putO(1, 1);
    }

    public function testWrongPlayer()
    {
        $this->expectException(WrongPlayerException::class);

        $c = new ClassicTicTacToe();
        $c->putX(1, 1);
        $c->putX(1, 2);
    }

    /**
     * @dataProvider provider
     *
     * @param string $game
     *
     * @throws FieldTakenException
     * @throws WrongPlayerException
     */
    public function testGame(string $game)
    {
        $c = new ClassicTicTacToe();
        $move = 'X';
        $prevMove = '';

        $l = strlen($game);

        for ($i = 0; $i < $l; $i++) {
            $sign = $game{$i};
            switch ($sign) {
                case 'W':
                    $this->assertWinner($c, $prevMove);
                    break;
                case 'T':
                    $this->assertTie($c);
                    break;
                default:
                    $this->play($c, $sign, $move, $prevMove);
                    if ($i < $l - 2) {
                        $this->assertGameOn($c);
                    }
                    break;
            }
        }

    }

    /**
     * @param ClassicTicTacToe $c
     * @param $prevMove
     */
    private function assertWinner(ClassicTicTacToe $c, $prevMove): void
    {
        $this->assertTrue($c->isEnded(), "WIN! but isEnded() returns false");
        $this->assertNotNull($c->getWinner(), "WIN! bug getWinner() returns false");
        $this->assertTrue($c->getWinner()->equalsTo(new Marker($prevMove)),
            "WIN! but getWinner() returns Wrong player");
    }

    /**
     * @param ClassicTicTacToe $c
     */
    private function assertTie(ClassicTicTacToe $c): void
    {
        $this->assertTrue($c->isEnded(), "TIE! but isEnded() returns false");
        $this->assertTrue($c->isTied(), "TIE! but isEnded() returns false");
    }

    /**
     * @param ClassicTicTacToe $c
     * @param $sign
     * @param $move
     * @param $prevMove
     *
     * @throws FieldTakenException
     * @throws WrongPlayerException
     */
    private function play(ClassicTicTacToe $c, $sign, &$move, &$prevMove)
    {
        $p = (int)$sign;
        $posX = (int)floor(($p - 1) / 3);
        $posY = ($p - 1) % 3;
        $prevMove = $move;
        if ($move === 'X') {
            $c->putX($posX, $posY);
            $move = 'O';
        } else {
            $c->putO($posX, $posY);
            $move = 'X';
        }
    }

    /**
     * @param ClassicTicTacToe $c
     */
    private function assertGameOn(ClassicTicTacToe $c): void
    {
        $this->assertFalse($c->isEnded(), "GAME ON! but isEnded() returns true");
        $this->assertFalse($c->isTied(), "GAME ON! but isTied() returns true");
    }

    /**
     * @return \Generator
     */
    public function provider(): ?\Generator
    {
        /*
         *  1 | 2 | 3
         * -----------
         *  4 | 5 | 6
         * -----------
         *  7 | 8 | 9
         */

        yield ['15263W'];
        yield ['1274985W'];
        yield ['159647328T'];
        yield ['453912876T'];
        yield ['579146823T'];
        yield ['1974352W'];
        yield ['15487W'];
        yield ['74859W'];
        yield ['74859W'];
        yield ['24578W'];
        yield ['31547W'];
        yield ['97541W'];
        yield ['152743W'];
    }
}
