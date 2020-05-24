<?php
declare(strict_types = 1);

namespace Chopper\Component\Downloader;

use Chopper\Component\Downloader\Base\IDownloader;

/**
 * PageDownloader
 */
class PageDownloader implements IDownloader
{
    /**
     * Method downloads html page with Curl to file
     *
     * @param string $url
     * @param string $dest
     *
     * @return bool
     */
    public function downloadtofile(string $url, string $dest): bool
    {
        $data = $this->download($url);
        if (!is_null($data)) {
            file_put_contents($dest, $data);

            return true;
        }

        return false;
    }

    /**
     * Method downloads html page with Curl
     *
     * @param string $url
     *
     * @return string|null
     */
    public function download(string $url): ?string
    {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $handler = curl_init($url);
            curl_setopt(
                $handler,
                CURLOPT_HEADER,
                "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)"
            );
            curl_setopt($handler, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($handler);
            curl_close($handler);

            return is_bool($data) ? null : $data;
        }

        return null;
    }
}
