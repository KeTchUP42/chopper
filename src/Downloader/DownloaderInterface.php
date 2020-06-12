<?php
declare(strict_types = 1);

namespace Chopper\Downloader;

use Chopper\Curl\Response\CurlResponseInterface;

/**
 * DownloaderInterface
 */
interface DownloaderInterface
{
    /**
     * Method downloads file with Curl to file
     *
     * @param string $url
     * @param string $dest
     *
     * @return bool
     */
    public function downloadfile(string $url, string $dest): bool;

    /**
     * Method downloads content with Curl
     *
     * @param string $url
     *
     * @return CurlResponseInterface
     */
    public function download(string $url): CurlResponseInterface;
}
