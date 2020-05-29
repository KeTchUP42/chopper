<?php
declare(strict_types = 1);

namespace Chopper\Component\Console\Command;

use Chopper\Component\Console\ColoredConsole\Console;
use Chopper\Component\Curl\Request\CurlRequest;
use Chopper\Component\Downloader\HttpDownloader;
use Chopper\Component\Logger\GlobalLogger\GLogger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * DownloadFileCommand
 */
class DownloadCommand extends Command
{
    /**
     * @var string
     */
    private $ResourceDir;

    /**
     * Конструктор.
     *
     * @param string $ResourceDir
     */
    public function __construct(string $ResourceDir)
    {
        parent::__construct();
        $this->ResourceDir = $ResourceDir;
    }

    /**
     * Configuring
     */
    protected function configure()
    {
        $this
            ->setName('download')
            ->setAliases(["d"])
            ->setDescription('Downloads file.')
            ->setHelp('This command downloads file to the target directory.');
        $this->addArgument('url', InputArgument::REQUIRED, 'File url');
        $this->addArgument('dest', InputArgument::OPTIONAL, 'New file name.');
    }

    /**
     * Download
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
     * Method logs input vars
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
     * Method downloads file to the resource dir
     *
     * @param string      $url
     * @param string|null $dest
     */
    private function download(string $url, string $dest): void
    {
        Console::out()->color(Console::GREEN)->writeln('Downloading..');
        (new HttpDownloader(new CurlRequest(), GLogger::getLogFilePath()))->downloadtofile(
            $url,
            $this->ResourceDir.$dest
        );
        Console::out()->color(Console::GREEN)->writeln('Done');
    }
}
