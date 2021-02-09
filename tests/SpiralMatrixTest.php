<?php

declare(strict_types=1);

namespace App\Tests;

use App\SpiralMatrix;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
class SpiralMatrixTest extends TestCase
{
    /**
     * @dataProvider dataFailProvider
     *
     * @param int[] $spiral
     * @param int[] $expect
     */
    public function testFailGetChanges(array $spiral, array $expect): void
    {
        self::assertSame($spiral, $expect);
    }

    /**
     * @return array<int, array<string, int>>
     */
    public function dataFailProvider(): array
    {
        return [
            [
                'spiral' => (new SpiralMatrix(10, 10))->run(),
                'expect' => [
                    [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                    [36, 37, 38, 39, 40, 41, 42, 43, 44, 11],
                    [35, 64, 65, 66, 67, 68, 69, 70, 45, 12],
                    [34, 63, 84, 85, 86, 87, 88, 71, 46, 13],
                    [33, 62, 83, 96, 97, 98, 89, 72, 47, 14],
                    [32, 61, 82, 95, 100, 99, 90, 73, 48, 15],
                    [31, 60, 81, 94, 93, 92, 91, 74, 49, 16],
                    [30, 59, 80, 79, 78, 77, 76, 75, 50, 17],
                    [29, 58, 57, 56, 55, 54, 53, 52, 51, 18],
                    [28, 27, 26, 25, 24, 23, 22, 21, 20, 19],
                ],
            ],
            [
                'spiral' => (new SpiralMatrix(10, 1))->run(),
                'expect' => [
                    [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                ],
            ],
            [
                'spiral' => (new SpiralMatrix(1, 10))->run(),
                'expect' => [
                    [1],
                    [2],
                    [3],
                    [4],
                    [5],
                    [6],
                    [7],
                    [8],
                    [9],
                    [10],
                ],
            ],
            [
                'spiral' => (new SpiralMatrix(3, 4))->run(),
                'expect' => [
                    [1, 2, 3],
                    [10, 11, 4],
                    [9, 12, 5],
                    [8, 7, 6],
                ],
            ],
            [
                'spiral' => (new SpiralMatrix(4, 3))->run(),
                'expect' => [
                    [1, 2, 3, 4],
                    [10, 11, 12, 5],
                    [9, 8, 7, 6],
                ],
            ],
            [
                'spiral' => (new SpiralMatrix(2, 10))->run(),
                'expect' => [
                    [1, 2],
                    [20, 3],
                    [19, 4],
                    [18, 5],
                    [17, 6],
                    [16, 7],
                    [15, 8],
                    [14, 9],
                    [13, 10],
                    [12, 11],
                ],
            ],
            [
                'spiral' => (new SpiralMatrix(3, 10))->run(),
                'expect' => [
                    [1, 2, 3],
                    [22, 23, 4],
                    [21, 24, 5],
                    [20, 25, 6],
                    [19, 26, 7],
                    [18, 27, 8],
                    [17, 28, 9],
                    [16, 29, 10],
                    [15, 30, 11],
                    [14, 13, 12],
                ],
            ],
        ];
    }
}
