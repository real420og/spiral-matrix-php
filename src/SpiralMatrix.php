<?php

declare(strict_types=1);

namespace App;

use Closure;

class SpiralMatrix
{
    private int $x;
    private int $y;

    private array $incX = [0, 1, 0, -1];
    private array $incY = [1, 0, -1, 0];

    private $incCurX;
    private $incCurY;

    private int $dX = 0;
    private int $dY = -1;

    private int $inc = 1;

    private int $numberOfLoop;
    private ?int $numberOfRepeat = null;

    private array $spiral = [];

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;

        $this->incCurX = current($this->incX);
        $this->incCurY = current($this->incY);

        if ($this->y < $this->x) {
            $this->numberOfLoop = $this->y * 2 - 1;
        } else {
            $this->numberOfLoop = $this->x * 2 - 1;
        }

        for ($i = 0; $i < $y; ++$i) {
            $this->spiral[$i] = [];
            for ($ii = 0; $ii < $x; ++$ii) {
                $this->spiral[$i][$ii] = 0;
            }
        }
    }

    public function run(): array
    {
        while ($this->numberOfLoop >= 0) {
            if (false === $this->incCurX) {
                $this->incCurX = reset($this->incX);
            }

            if (false === $this->incCurY) {
                $this->incCurY = reset($this->incY);
            }

            if ($this->numberOfRepeat === $this->x) {
                --$this->x;
                $this->numberOfRepeat = $this->y;
            } else {
                --$this->y;
                $this->numberOfRepeat = $this->x;
            }

            $this->repeat($this->numberOfRepeat, function (): void {
                $this->dX += $this->incCurX;
                $this->dY += $this->incCurY;

                $this->spiral[$this->dX][$this->dY] = $this->inc;

                ++$this->inc;
            });

            $this->incCurX = next($this->incX);
            $this->incCurY = next($this->incY);

            --$this->numberOfLoop;
        }

        return $this->spiral;
    }

    private function repeat(int $inc, Closure $func): void
    {
        if (0 === $inc) {
            return;
        }

        $func();

        --$inc;

        $this->repeat($inc, $func);
    }
}
