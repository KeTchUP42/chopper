<?php
declare(strict_types = 1);

namespace Chopper\Component\Console\Command;

use Chopper\Component\Console\ColoredConsole\Console;
use Chopper\Component\Logger\GlobalLogger\Exception\GLoggerException;
use Chopper\Gear\Facade\Cleaner;
use Chopper\Gear\Factory\Filter\BaseFilterFactory;
use Chopper\Gear\Factory\Filter\IFilterFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * ClearFileCommand
 */
class FilterCommand extends Command
{
    /**
     * @var string
     */
    private $ResourceDir;

    /**
     * @var string
     */
    private $FinalDir;

    /**
     * Конструктор.
     *
     * @param string $ResourceDir
     * @param string $FinalDir
     */
    public function __construct(string $ResourceDir, string $FinalDir)
    {
        parent::__construct();
        $this->ResourceDir = $ResourceDir;
        $this->FinalDir    = $FinalDir;
    }

    protected function configure()
    {
        $this->setName('filter')
            ->setAliases(["f"])
            ->setDescription('Filter out file.')
            ->setHelp('This command downloads file, filter out it with filter and puts it to the target directory.');
        $this->addArgument('Path', InputArgument::REQUIRED, 'URL or local file path');
        $this->addArgument('FilterFactoryName', InputArgument::OPTIONAL, 'Name of filter factory.');
        $this->addArgument('Dest', InputArgument::OPTIONAL, 'New file name.');
    }

    /**
     * Clear
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->start(
            $output,
            $input->getArgument('Path'),
            $input->getArgument('Dest'),
            $input->getArgument('FilterFactoryName')
        );

        return 0;
    }

    /**
     * Entry point
     *
     * @param OutputInterface $output
     * @param string          $path
     * @param string|null     $dest
     * @param string|null     $factoryName
     *
     * @throws GLoggerException
     */
    private function start(
        OutputInterface $output,
        string $path,
        string $dest = null,
        string $factoryName = null
    ) {
        $factoryName = is_null($factoryName) ? BaseFilterFactory::class : "Chopper\Gear\Factory\Filter\\".$factoryName;
        if (!class_exists($factoryName, true)) {
            throw new \RuntimeException(sprintf("Factory %s is not exists!", $factoryName));
        }
        $dest = is_null($dest) ? uniqid('file', false) : basename($dest);
        $path = !filter_var($path, FILTER_VALIDATE_URL) ? $this->ResourceDir.$path : $path;

        $this->log($output, $path, $dest, $factoryName);
        $this->filter($path, $dest, new $factoryName());
    }

    /**
     * Method logs input vars
     *
     * @param OutputInterface $output
     * @param string          $path
     * @param string          $dest
     * @param string          $factoryName
     */
    private function log(OutputInterface $output, string $path, string $dest, string $factoryName): void
    {
        $output->writeln(sprintf('PATH: %s', $path));
        $output->writeln(sprintf('NEW FILE NAME: %s', $dest));
        $output->writeln(sprintf('FACTORY NAME: %s', $factoryName));
    }

    /**
     * Method clears html file and puts it to the dir
     *
     * @param string         $path
     * @param string         $dest
     * @param IFilterFactory $factory
     *
     * @throws GLoggerException
     */
    private function filter(string $path, string $dest, IFilterFactory $factory): void
    {
        Console::out()->color(Console::GREEN)->writeln('Processing..');
        if ((new Cleaner())->filtFile($path, $this->FinalDir.$dest, $factory)) {
            Console::out()->color(Console::GREEN)->writeln('Done');
        }
        else {
            throw new \RuntimeException(sprintf("Something went wrong in %s.", Cleaner::class));
        }
    }
}
