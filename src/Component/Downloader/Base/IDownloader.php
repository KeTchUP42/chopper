<?php
declare(strict_types = 1);

namespace Chopper\Component\Downloader\Base;

/**
 * IDownloader interface
 */
interface IDownloader
{
    /**
     * Base download method
     *
     * @param string $path
     * @param string $dest
     *
     * @return bool
     */
    public function downloadtofile(string $path, string $dest): bool;

    /**
     * Method downloads main page with Curl
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
            'url'         => '',
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
