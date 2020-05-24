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
     * Base download method
     *
     * @param string $path
     *
     * @return string
     */
    public function download(string $path): ?string;
}
