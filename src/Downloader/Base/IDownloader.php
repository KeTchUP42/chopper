<?php
declare(strict_types = 1);

namespace Chopper\Downloader\Base;

use Chopper\Curl\Response\ICurlResponse;

/**
 * IDownloader interface
 */
interface IDownloader
{
    /**
     * Method downloads content with Curl to file
     *
     * @param string $url
     * @param string $dest
     *
     * @return bool
     */
    public function downloadtofile(string $url, string $dest): bool;

    /**
     * Method downloads content with Curl
     *
     * @param string $url
     *
     * @return ICurlResponse
     */
    public function download(string $url): ICurlResponse;
}
