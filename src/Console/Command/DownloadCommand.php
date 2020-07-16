<?php
declare(strict_types = 1);

namespace Chopper\Console\Command;

use Chopper\Console\ColoredConsole\Console;
use Chopper\Curl\Request\CurlRequest;
use Chopper\Downloader\HttpDownloader;
use Chopper\Logger\LoggerContainer\LoggerContainerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * DownloadFileCommand
 */
final class DownloadCommand extends Command
{
    /**
     * @var string
     */
    private $resourceDirectory;

    /**
     * @var LoggerContainerInterface
     */
    private $loggerContainer;

    /**
     * Конструктор.
     *
     * @param string                   $resourceDirectory
     * @param LoggerContainerInterface $loggerContainer
     */
    public function __construct(string $resourceDirectory, LoggerContainerInterface $loggerContainer)
    {
        parent::__construct();
        $this->resourceDirectory = $resourceDirectory;
        $this->loggerContainer   = $loggerContainer;
    }

    /**
     * Configuring
     */
    protected function configure(): void
    {
        $this->setName('download')
            ->setAliases(["d"])
            ->setDescription('Downloads file.')
            ->setHelp('This command downloads file to the resource directory.');
        $this->addArgument('url', InputArgument::REQUIRED, 'File url.');
        $this->addArgument('dest', InputArgument::OPTIONAL, 'New file name.');
    }

    /**
     * Download execute
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $dest = $input->getArgument('dest');
        $dest = is_null($dest) ? uniqid('file', false) : basename($dest);
        $url  = $input->getArgument('url');

        $this->log($output, $url, $dest);
        $this->download($url, $dest);

        return 0;
    }

    /**
     * Method logs input vars info
     *
     * @param OutputInterface $output
     * @param string          $url
     * @param string          $dest
     */
    private function log(OutputInterface $output, string $url, string $dest): void
    {
        $output->writeln(sprintf('URL: %s', $url));
        $output->writeln(sprintf('NEW FILE NAME: %s', $dest));
    }

    /**
     * Method downloads file to the resource directory
     *
     * @param string      $url
     * @param string|null $dest
     */
    private function download(string $url, string $dest): void
    {
        Console::out()->color(Console::GREEN)->writeln('Downloading..');
        $downloader = new HttpDownloader(new CurlRequest(), $this->loggerContainer->getLogFilePath());
        $downloader->downloadfile($url, $this->resourceDirectory.$dest);
        Console::out()->color(Console::GREEN)->writeln('Done');
    }
}
