<?php
declare(strict_types = 1);

namespace Chopper\Console\Command;

use Chopper\Console\ColoredConsole\Console;
use Chopper\Constant\ConsoleAlias;
use Chopper\Exceptions\RuntimeException;
use Chopper\Gear\Facade\FileFilter;
use Chopper\Gear\Factory\Filter\FilterFactoryInterface;
use Chopper\Gear\Filtration\FilterCell\FormingFilterCell;
use Chopper\Logger\LoggerContainer\LoggerContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
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
     * @var LoggerContainerInterface
     */
    private $loggerContainer;

    /**
     * Конструктор.
     *
     * @param string                   $resourceDirectory
     * @param string                   $templatesDirectory
     * @param LoggerContainerInterface $loggerContainer
     */
    public function __construct(
        string $resourceDirectory,
        string $templatesDirectory,
        LoggerContainerInterface $loggerContainer
    ) {
        parent::__construct();
        $this->resourceDirectory  = $resourceDirectory;
        $this->templatesDirectory = $templatesDirectory;
        $this->loggerContainer    = $loggerContainer;
    }

    /**
     * Configuring
     */
    protected function configure(): void
    {
        $this->setName('filter')
            ->setAliases(["f"])
            ->setDescription('Filter out file.')
            ->setHelp('This command downloads file, filter out it with filter and puts it to the needed directory.');
        $this->addArgument('Path', InputArgument::REQUIRED, 'URL or file name in the resource directory.');
        $this->addArgument('FilterFactoryAlias', InputArgument::REQUIRED, 'Filter factory alias.');
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
        $path         = $input->getArgument('Path');
        $factoryAlias = $input->getArgument('FilterFactoryAlias');
        $dest         = $input->getArgument('Dest');

        $factoryName = $this->factoryChoose($factoryAlias);
        $dest        = is_null($dest) ? uniqid('file', false) : basename($dest);
        $path        = !filter_var($path, FILTER_VALIDATE_URL) ? $this->resourceDirectory.$path : $path;

        $this->log($output, $path, $dest, $factoryName);
        $this->filter($path, $dest, new $factoryName());

        return 0;
    }

    /**
     * Method choose correct factory with alias
     *
     * @param string|null $alias
     *
     * @return string
     */
    private function factoryChoose($alias): string
    {
        if (isset(ConsoleAlias::FILTER_FACTORY_ALIAS[$alias])) {
            return ConsoleAlias::FILTER_FACTORY_ALIAS[$alias];
        }

        throw new RuntimeException(sprintf("No such alias: %s", $alias));
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
        $fileFilter = new FileFilter($this->loggerContainer);
        if ($fileFilter->filtering($path, $this->templatesDirectory.$dest, new FormingFilterCell($factory))) {
            Console::out()->color(Console::GREEN)->writeln('Done');
        }
        else {
            throw new RuntimeException(sprintf("File %s not found.", $path));
        }
    }
}
