<?php

declare(strict_types=1);

namespace App\Command;

use App\SpiralMatrix;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WriteInOutputMatrixSpiral extends Command
{
    protected static $defaultName = 'write-in-output-matrix-spiral:execute';

    protected SpiralMatrix $spiralMatrix;

    public function __construct(SpiralMatrix $spiralMatrix)
    {
        $this->spiralMatrix = $spiralMatrix;

        parent::__construct();
    }

    /**
     * @throws InvalidArgumentException
     */
    protected function configure(): void
    {
        $this
            ->setDescription('Set description')
            ->addArgument('x', InputArgument::REQUIRED, 'x')
            ->addArgument('y', InputArgument::REQUIRED, 'y')
        ;
    }

    /**
     * @throws InvalidArgumentException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $x = (int) $input->getArgument('x');
        $y = (int) $input->getArgument('y');

        $numeralCount = $this->numberOfDigitsInInteger($x * $y);

        $spiralMatrix = $this->spiralMatrix->run($x, $y);

        foreach ($spiralMatrix as $value) {
            $output->write('|');

            foreach ($value as $k => $v) {
                if ($numeralCount > $this->numberOfDigitsInInteger($v)) {
                    $v = str_pad((string) $v, $numeralCount, '0', STR_PAD_LEFT);
                }

                $output->write($v.'|');
            }
            $output->write("\n");
        }

        return 0;
    }

    private function numberOfDigitsInInteger(int $number): int
    {
        return (int) floor(log10($number)) + 1;
    }
}
