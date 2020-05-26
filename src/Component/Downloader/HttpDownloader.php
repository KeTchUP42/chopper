<?php
declare(strict_types = 1);

namespace Chopper\Component\Downloader;

use Chopper\Component\Curl\ICurlRequest;
use Chopper\Component\Downloader\Base\IDownloader;

/**
 * HttpDownloader
 */
class HttpDownloader implements IDownloader
{
    /**
     * @var ICurlRequest
     */
    private $curl;

    /**
     * @var ?string
     */
    private $logFilePath;

    /**
     * Конструктор.
     *
     * @param ICurlRequest $curl
     * @param string       $logFilePath
     */
    public function __construct(ICurlRequest $curl, string $logFilePath = null)
    {
        $this->curl        = $curl;
        $this->logFilePath = $logFilePath;
    }

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
    ): bool {
        $data = $this->download($url, $params)['body'];
        if (!is_null($data)) {
            file_put_contents($dest, $data);

            return true;
        }

        return false;
    }

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
    ): array {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \RuntimeException(sprintf("URL %s is not valid!", $url));
        }
        $params['url'] = $url;

        $this->curl->init($params);
        if (!is_null($this->logFilePath)) {
            $this->curl->setLogFile($this->logFilePath);
        }
        $result = $this->curl->exec();
        if ($result['curl_error']) {
            throw new \RuntimeException($result['curl_error']);
        }
        if ($result['http_code'] !== 200) {
            throw new \RuntimeException(sprintf("HTTP Code = %s", $result['http_code']));
        }
        if (!$result['body']) {
            throw new \RuntimeException("Body of file is empty");
        }

        return $result;
    }
}