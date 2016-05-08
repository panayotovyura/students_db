<?php

namespace StudentsBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Stopwatch\Stopwatch;

class RoutesCommand extends ContainerAwareCommand
{
    const BYTES_IN_MEGABYTE = 1048576;
    const MILLISECONDS_IN_SECOND = 1000;
    const PRECISION = 3;

    protected function configure()
    {
        $this
            ->setName('students:generate:routes')
            ->setDescription('Generate routes for students')
        ;
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $stopwatch = new Stopwatch();
        $stopwatch->start('generateRoutes');

        $this->getContainer()->get('routes_helper')->generateRoutes();

        $event = $stopwatch->stop('generateRoutes');

        $output->writeln(
            'Time elapsed: ' .
            round($event->getDuration() / self::MILLISECONDS_IN_SECOND, self::PRECISION) .
            ' seconds' . PHP_EOL
        );

        $output->writeln(
            'Memory usage: ' .
            round($event->getMemory() / self::BYTES_IN_MEGABYTE, self::PRECISION) .
            ' MB' . PHP_EOL
        );

        $output->writeln('Routes generated');
    }
}
