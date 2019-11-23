<?php

declare(strict_types=1);

namespace Foo;

/**
 * Class Marker
 * @package Foo
 */
class Marker
{
    /**
     * @var string
     */
    private $sign;

    /**
     * Marker constructor.
     *
     * @param string $sign
     */
    public function __construct(string $sign)
    {
        if (!in_array($sign, ['X', 'O'], true)) {
            throw new \InvalidArgumentException('Invalid sign argument [allowed values: "X", "O"]: ' . $sign);
        }

        $this->sign = $sign;
    }

    /**
     * @param Marker|null $marker
     * @return bool
     */
    public function equalsTo(Marker $marker = null): bool
    {
        return (null !== $marker) && ($this->sign === $marker->getSign());
    }

    /**
     * @return string
     */
    public function getSign(): string
    {
        return $this->sign;
    }
}
