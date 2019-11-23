<?php

declare(strict_types=1);

namespace Foo;

use Foo\Exceptions\FieldTakenException;
use Foo\Exceptions\WrongPlayerException;

/**
 * @package Foo
 */
interface TicTacToeInterface
{
    /**
     * $x,$y - 0-2
     *
     * @param int $x
     * @param int $y
     *
     * @throws FieldTakenException
     * @throws WrongPlayerException
     */
    public function putX(int $x, int $y): void;

    /**
     * $x,$y - 0-2
     *
     * @param int $x
     * @param int $y
     *
     * @throws FieldTakenException
     * @throws WrongPlayerException
     */
    public function putO(int $x, int $y): void;

    /**
     * @return bool
     */
    public function isEnded(): bool;

    /**
     * @return bool
     */
    public function isTied(): bool;

    /**
     * @return Marker|null
     */
    public function getWinner(): ?Marker;
}
