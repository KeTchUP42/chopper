<?php
declare(strict_types = 1);

namespace Chopper\Console\Command;

use Chopper\Console\ColoredConsole\Console;
use Chopper\Constant\ConsoleAlias;
use Chopper\Exceptions\RuntimeException;
use Chopper\Gear\Facade\TemplateMixer;
use Chopper\Gear\Handling\MixerCell\MixerCellEssence\MixerCellInterface;
use Chopper\Logger\GlobalLogger\SystemLogger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * MixerCommand
 */
final class MixerCommand extends Command
{
    /**
     * @var string
     */
    private $templatesDirectory;

    /**
     * @var string
     */
    private $resultDirectory;

    /**
     * Конструктор.
     *
     * @param string $templatesDirectory
     * @param string $resultDirectory
     */
    public function __construct(string $templatesDirectory, string $resultDirectory)
    {
        parent::__construct();
        $this->templatesDirectory = $templatesDirectory;
        $this->resultDirectory    = $resultDirectory;
    }

    /**
     * Configuring
     */
    protected function configure(): void
    {
        $this->setName('mix')
            ->setAliases(["m"])
            ->setDescription('Mix new file.')
            ->setHelp('This command mixs new file from templates.');
        $this->addArgument('MixTypeAlias', InputArgument::OPTIONAL, 'Mix type alias.');
        $this->addArgument('NewFileName', InputArgument::OPTIONAL, 'New file name.');
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
        $fileName = $input->getArgument('NewFileName');
        $mixType  = $input->getArgument('MixTypeAlias');

        $fileName = is_null($fileName) ? uniqid('file', false) : basename($fileName);
        $mixCell  = $this->mixTypeChoose($mixType);

        $this->log($output, $mixType, $fileName);
        $this->mix($fileName, new $mixCell($this->templatesDirectory));

        return 0;
    }

    /**
     * Method choose correct mix type with alias
     *
     * @param string|null $alias
     *
     * @return string
     */
    private function mixTypeChoose($alias): string
    {
        if (isset(ConsoleAlias::MIX_TYPE_ALIAS[$alias])) {
            return ConsoleAlias::MIX_TYPE_ALIAS[$alias];
        }

        throw new RuntimeException(sprintf("No such alias: %s", $alias));
    }

    /**
     * Method logs input vars info
     *
     * @param OutputInterface $output
     * @param string          $mixType
     * @param string          $fileName
     */
    private function log(OutputInterface $output, string $mixType, string $fileName): void
    {
        $output->writeln(sprintf('MIX TYPE: %s', $mixType));
        $output->writeln(sprintf('NEW FILE NAME: %s', $fileName));
    }

    /**
     * Method mixes templates files and puts new file to the needed directory
     *
     * @param string             $fileName
     * @param MixerCellInterface $mixerCell
     */
    private function mix(string $fileName, MixerCellInterface $mixerCell): void
    {
        Console::out()->color(Console::GREEN)->writeln('Processing..');
        if ((new TemplateMixer(SystemLogger::getGlobalLoggerContainer()->getLogger()
        ))->mix($this->resultDirectory.$fileName,
            $mixerCell
        )) {
            Console::out()->color(Console::GREEN)->writeln('Done');
        }
        else {
            Console::out()->color(Console::RED)->writeln('Err');
        }
    }
}
