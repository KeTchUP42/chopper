<?php
declare(strict_types = 1);

namespace Chopper\Console\Command;

use Chopper\Console\ColoredConsole\Console;
use Chopper\Exceptions\RuntimeException;
use Chopper\Gear\Facade\FileFilter;
use Chopper\Gear\Factory\Filter\BaseFilterFactory;
use Chopper\Gear\Factory\Filter\FilterFactoryInterface;
use Chopper\Logger\GlobalLogger\SystemLogger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * FilterCommand
 */
final class FilterCommand extends Command
{
    /**
     * @var string
     */
    private $resourceDirectory;

    /**
     * @var string
     */
    private $templatesDirectory;

    /**
     * Конструктор.
     *
     * @param string $resourceDirectory
     * @param string $templatesDirectory
     */
    public function __construct(string $resourceDirectory, string $templatesDirectory)
    {
        parent::__construct();
        $this->resourceDirectory  = $resourceDirectory;
        $this->templatesDirectory = $templatesDirectory;
    }

    protected function configure()
    {
        $this->setName('filter')
            ->setAliases(["f"])
            ->setDescription('Filter out file.')
            ->setHelp('This command downloads file, filter out it with filter and puts it to the needed directory.');
        $this->addArgument('Path', InputArgument::REQUIRED, 'URL or file name in the resource directory.');
        $this->addArgument('FilterFactoryName', InputArgument::OPTIONAL, 'Filter factory name.');
        $this->addArgument('Dest', InputArgument::OPTIONAL, 'New file name.');
    }

    /**
     * Filter execute
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $path    = $input->getArgument('Path');
        $factory = $input->getArgument('FilterFactoryName');
        $dest    = $input->getArgument('Dest');

        $factoryName = is_null($factory) ? BaseFilterFactory::class : "Chopper\Gear\Factory\Filter\\".$factory;
        if (!class_exists($factoryName, true)) {
            throw new RuntimeException(sprintf("Factory %s is not exists!", $factoryName));
        }
        $dest = is_null($dest) ? uniqid('file', false) : basename($dest);
        $path = !filter_var($path, FILTER_VALIDATE_URL) ? $this->resourceDirectory.$path : $path;

        $this->log($output, $path, $dest, $factoryName);
        $this->filter($path, $dest, new $factoryName());

        return 0;
    }

    /**
     * Method logs input vars info
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
     * Method clears file and puts it to the needed directory
     *
     * @param string                 $path
     * @param string                 $dest
     * @param FilterFactoryInterface $factory
     */
    private function filter(string $path, string $dest, FilterFactoryInterface $factory): void
    {
        Console::out()->color(Console::GREEN)->writeln('Processing..');
        if ((new FileFilter(SystemLogger::getGlobalLoggerContainer()))->filtering(
            $path,
            $this->templatesDirectory.$dest,
            $factory
        )) {
            Console::out()->color(Console::GREEN)->writeln('Done');
        }
        else {
            throw new RuntimeException(sprintf("File %s not found.", $path));
        }
    }
}
