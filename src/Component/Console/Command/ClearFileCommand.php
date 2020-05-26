<?php
declare(strict_types = 1);

namespace Chopper\Component\Console\Command;

use Chopper\App\Cleaner;
use Chopper\Component\Console\ColoredConsole\Console;
use Chopper\Component\Logger\GlobalLogger\Exception\GLoggerException;
use Chopper\Gear\Factory\Filter\BaseFilterFactory;
use Chopper\Gear\Factory\Filter\IFilterFactory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * ClearFileCommand
 */
class ClearFileCommand extends Command
{
    /**
     * @var string
     */
    private $ResourcesDir;

    /**
     * @var string
     */
    private $FinalDir;

    /**
     * Конструктор.
     *
     * @param string $ResourcesDir
     * @param string $FinalDir
     */
    public function __construct(string $ResourcesDir, string $FinalDir)
    {
        parent::__construct();
        $this->ResourcesDir = $ResourcesDir;
        $this->FinalDir     = $FinalDir;
    }

    protected function configure()
    {
        $this->setName('clear')
            ->setAliases(["c"])
            ->setDescription('Clears file with filter.')
            ->setHelp('This command downloads file then clears it with filter and puts it to the final dir.');
        $this->addArgument('File-path or URL', InputArgument::REQUIRED, 'File url or local path');
        $this->addArgument('Dest', InputArgument::OPTIONAL, 'New file name.');
        $this->addArgument('Filter factory name', InputArgument::OPTIONAL, 'Name of filter factory.');
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
        $this->clearStart(
            $output,
            $input->getArgument('File-path or URL'),
            $input->getArgument('Dest'),
            $input->getArgument('Filter factory name')
        );

        return 0;
    }

    /**
     *
     * @param OutputInterface $output
     * @param string          $path
     * @param string|null     $dest
     * @param string|null     $facName
     */
    private function clearStart(
        OutputInterface $output,
        string $path,
        string $dest = null,
        string $facName = null
    ) {
        $factoryName = is_null($facName) ? BaseFilterFactory::class : "Chopper\Gear\Factory\Filter\\" . $facName;
        if (!class_exists($factoryName, true)) {
            throw new \RuntimeException(sprintf("Factory %s is not exists!", $factoryName));
        }
        $dest = is_null($dest) ? uniqid('file', false) : basename($dest);
        $path = !filter_var($path, FILTER_VALIDATE_URL) ? $this->ResourcesDir . $path : $path;

        $this->log($output, $path, $dest, $factoryName);
        $this->clear($path, $dest, new $factoryName());
    }

    /**
     *
     * @param OutputInterface $output
     * @param string          $path
     * @param string          $dest
     * @param string          $factoryName
     */
    private function log(OutputInterface $output, string $path, string $dest, string $factoryName): void
    {
        $output->writeln(sprintf('File-path or URL: %s', $path));
        $output->writeln(sprintf('NEW FILE NAME: %s', $dest));
        $output->writeln(sprintf('FILTER FACTORY NAME: %s', $factoryName));
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
    public function clear(string $path, string $dest, IFilterFactory $factory): void
    {
        Console::out()->color(Console::GREEN)->writeln('Clearing..');
        if ((new Cleaner())->filtFile($path, $this->FinalDir . $dest, $factory)) {
            Console::out()->color(Console::GREEN)->writeln('Done');
        }
        else {
            throw new \RuntimeException(sprintf("%s error!", Cleaner::class));
        }
    }
}
