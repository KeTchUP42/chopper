<?php
declare(strict_types = 1);

namespace Chopper\Component\Console\Command\CommandTraits;

use Chopper\App\Cleaner;
use Chopper\Component\Console\ColoredConsole\Console;
use Chopper\Component\Downloader\PageDownloader;

/**
 * CleanerCommandTrait
 */
trait CleanerCommandTrait
{
    /**
     * Method clears html file and puts to dir
     *
     * @param string $path
     * @param string $dest
     */
    public function clear(string $path, string $dest = null): void
    {
        $directory = $_ENV['HTML_RESOURCES'] . '/';
        if (!filter_var($path, FILTER_VALIDATE_URL)) {
            $path = $directory . $path;
        }

        (new Cleaner())->filtHtmlFile(
            $path,
            $directory . ($dest ?? basename($path))
        );
    }

    /**
     * Method downloads page to file
     *
     * @param string      $path
     * @param string|null $dest
     */
    private function download(string $path, string $dest = null): void
    {
        (new PageDownloader())->downloadtofile(
            $path,
            $_ENV['HTML_RESOURCES'] . '/' . ($dest ?? basename($path))
        );
    }

    /**
     * Method clears html
     */
    private function test(): void
    {
        Console::out()->color(Console::GREEN)->writeln('TEST');
    }
}
