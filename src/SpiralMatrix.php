<?php

declare(strict_types=1);

namespace App;

class SpiralMatrix
{
    private int $x;
    private int $y;

    /**
     * @var int[]
     */
    private array $incX = [0, 1, 0, -1];

    /**
     * @var int[]
     */
    private array $incY = [1, 0, -1, 0];

    private int $incCurX;
    private int $incCurY;

    private int $dX = 0;
    private int $dY = -1;

    private int $inc = 1;

    private int $numberOfLoop;
    private ?int $numberOfRepeat = null;

    /**
     * @var int[][]
     */
    private array $spiral = [];

    /**
     * @return int[][]
     */
    public function run(int $x, int $y): array
    {
        $this->init($x, $y);

        while ($this->numberOfLoop >= 0) {
            if ($this->numberOfRepeat === $this->x) {
                --$this->x;
                $this->numberOfRepeat = $this->y;
            } else {
                --$this->y;
                $this->numberOfRepeat = $this->x;
            }

            for ($i = 0; $i < $this->numberOfRepeat; ++$i) {
                $this->dX += $this->incCurX;
                $this->dY += $this->incCurY;

                $this->spiral[$this->dX][$this->dY] = $this->inc;

                ++$this->inc;
            }

            $this->incCurX = false === next($this->incX) ? (int) reset($this->incX) : (int) current($this->incX);
            $this->incCurY = false === next($this->incY) ? (int) reset($this->incY) : (int) current($this->incY);

            --$this->numberOfLoop;
        }

        return $this->spiral;
    }

    private function init(int $x, int $y): void
    {
        $this->x = $x;
        $this->y = $y;

        $this->incCurX = $this->incX[0];
        $this->incCurY = $this->incY[0];

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

    private function init(int $x, int $y): void {
        $this->x = $x;
        $this->y = $y;

        $this->incCurX = $this->incX[0];
        $this->incCurY = $this->incY[0];

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
}
