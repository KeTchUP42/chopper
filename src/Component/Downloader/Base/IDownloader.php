<?php
declare(strict_types = 1);

namespace Chopper\Component\Downloader\Base;

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
     * @param array  $params
     *
     * @return bool
     */
    public function downloadtofile(
        string $url,
        string $dest,
        array $params = [
            'host'        => '',
            'header'      => '',
            'method'      => 'GET',
            'referer'     => '',
            'cookie'      => '',
            'post_fields' => '',
            'timeout'     => 300
        ]
    ): bool;

    /**
     * Method downloads content with Curl
     *
     * 'GET','POST','HEAD'
     *
     * @param string $url
     *
     * @param array  $params
     *
     * @return array
     */
    public function download(
        string $url,
        array $params = [
            'host'        => '',
            'header'      => '',
            'method'      => 'GET',
            'referer'     => '',
            'cookie'      => '',
            'post_fields' => '',
            'timeout'     => 300
        ]
    ): array;
}
