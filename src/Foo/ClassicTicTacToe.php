<?php
declare(strict_types=1);

namespace Foo;

use Foo\Exceptions\FieldTakenException;
use Foo\Exceptions\WrongPlayerException;

/**
 * Class ClassicTicTacToe.
 *
 * Main game class that should implements all required methods.
 */
class ClassicTicTacToe implements TicTacToeInterface
{
    private const X_MAX = 3;
    private const Y_MAX = 3;
    private const MOVES_MAX = self::X_MAX * self::Y_MAX;

    private const X_SYMBOL = 'X';
    private const O_SYMBOL = 'O';

    private const SYMBOL_MAP = [self::X_SYMBOL, self::O_SYMBOL];
    private const INVERSE_SYMBOL_MAP = [ // note: can be generated at runtime from SYMBOL_MAP if needed
        self::X_SYMBOL => 0,
        self::O_SYMBOL => 1,
    ];

    public $gameBoard = [];
    public $lastPlayer = null;
    public $currentPlayer = 0; // 'X' starts
    public $movesCounter = 0;

    private function xyToLinearOffset(int $x, int $y): int
    {
        return $x + $y * self::X_MAX;
    }

    private function getBoardField(int $x, int $y): ?int
    {
        $offset = $this->xyToLinearOffset($x, $y);
        $content = $this->gameBoard[$offset] ?? null;

        return $content;
    }

    /**
     * @param int $playerNr
     * @param int $x
     * @param int $y
     *
     * @throws FieldTakenException
     * @throws WrongPlayerException
     */
    private function put(int $playerNr, int $x, int $y): void
    {
        if ($this->currentPlayer !== $playerNr) {
            throw new WrongPlayerException("it's now '$this->currentPlayer' turn");
        }

        $offset = $this->xyToLinearOffset($x, $y);
        $content = $this->gameBoard[$offset] ?? null;

        if ($content !== null) {
            throw new FieldTakenException("field [$x,$y] already has '$content' in it");
        }

        $this->gameBoard[$offset] = $playerNr;
        $this->movesCounter++;
        $this->lastPlayer = $this->currentPlayer;
        $this->currentPlayer = ($this->currentPlayer + 1) % \count(self::SYMBOL_MAP);
    }

    /**
     * $x,$y - 0-2
     *
     * @param int $x
     * @param int $y
     *
     * @throws FieldTakenException
     * @throws WrongPlayerException
     */
    public function putX(int $x, int $y): void
    {
        $this->put(self::INVERSE_SYMBOL_MAP[self::X_SYMBOL], $x, $y);
    }

    /**
     * $x,$y - 0-2
     *
     * @param int $x
     * @param int $y
     *
     * @throws FieldTakenException
     * @throws WrongPlayerException
     */
    public function putO(int $x, int $y): void
    {
        $this->put(self::INVERSE_SYMBOL_MAP[self::O_SYMBOL], $x, $y);
    }

    /**
     * @return bool
     */
    public function isEnded(): bool
    {
        // TODO can be optimized using displacement vectors

        for ($x = 0; $x < self::X_MAX; $x++) {
            $first = $this->getBoardField($x, 0);
            if ($first === null) {
                continue;
            }
            for ($y = 1; $y < self::Y_MAX; $y++) {
                if ($this->getBoardField($x, $y) !== $first) {
                    continue 2;
                }
            }
            return true;
        }
        for ($y = 0; $y < self::Y_MAX; $y++) {
            $first = $this->getBoardField(0, $y);
            if ($first === null) {
                continue;
            }
            for ($x = 1; $x < self::X_MAX; $x++) {
                if ($this->getBoardField($x, $y) !== $first) {
                    continue 2;
                }
            }
            return true;
        }
        $center = $this->getBoardField((int)(self::X_MAX / 2), (int)(self::Y_MAX / 2));
        if ($center === null) {
            return false;
        }
        if ($this->getBoardField(0, 0) === $center
            && $this->getBoardField(self::X_MAX - 1, self::Y_MAX - 1) === $center) {
            return true;
        }

        if ($this->getBoardField(0, self::Y_MAX - 1) === $center
            && $this->getBoardField(self::X_MAX - 1, 0) === $center) {
            return true;
        }

        return $this->isTied();
    }

    /**
     * note: the implementation depends on what we actually consider a tie here, though
     * do we allow moves when the result is already known? (assumed 'yes' since the test datasets seem to allow it)
     *
     * @return bool
     */
    public function isTied(): bool
    {
        return $this->movesCounter === self::MOVES_MAX;
    }

    /**
     * @return Marker|null
     */
    public function getWinner(): ?Marker
    {
        return new Marker(self::SYMBOL_MAP[$this->lastPlayer]);
    }
}
