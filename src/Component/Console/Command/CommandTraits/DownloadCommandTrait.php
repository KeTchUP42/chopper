<?php
declare(strict_types = 1);

namespace Chopper\Component\Console\Command\CommandTraits;

use Chopper\Component\Curl\CurlRequest;
use Chopper\Component\Downloader\HttpDownloader;
use Chopper\Component\Logger\GlobalLogger\GLogger;

/**
 * DownloadCommandTrait
 */
trait DownloadCommandTrait
{
    /**
     * Method downloads page to file
     *
     * @param string      $url
     * @param string|null $dest
     */
    private function download(string $url, string $dest = null): void
    {
        $dest = is_null($dest) ? uniqid('file', false) : basename($dest);
        (new HttpDownloader(new CurlRequest(), GLogger::getLogFilePath()))->downloadtofile(
            $url,
            $_ENV['MAIN_RESOURCES'] . $dest
        );
    }
}
