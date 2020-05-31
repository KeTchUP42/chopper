<?php
declare(strict_types = 1);

namespace Chopper\Downloader;

use Chopper\Curl\Request\ICurlRequest;
use Chopper\Curl\Response\ICurlResponse;
use Chopper\Downloader\Base\IDownloader;

/**
 * HttpDownloader
 */
class HttpDownloader implements IDownloader
{
    /**
     * @var ICurlRequest
     */
    protected $curl;

    /**
     * @var string?
     */
    protected $logFilePath;

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
     * @return bool
     */
    public function downloadtofile(string $url, string $dest): bool
    {
        $data = $this->download($url)->getBody();
        if ($data) {
            file_put_contents($dest, $data);

            return true;
        }

        return false;
    }

    /**
     * Method downloads content with Curl
     *
     * @param string $url
     *
     * @return ICurlResponse
     */
    public function download(string $url): ICurlResponse
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \RuntimeException(sprintf("URL %s is not valid!", $url));
        }
        $builder = $this->curl->init($url)
            ->setTimeOut(300)
            ->setBaseUserAgent()
            ->buildHeader()
            ->setBaseHeader()
            ->applyHeader();

        if (!is_null($this->logFilePath)) {
            $builder->setLogFile($this->logFilePath);
        }
        $result = $builder->exec();

        if ($result->getCurlError()) {
            throw new \RuntimeException($result->getCurlError());
        }
        if ($result->getHttpCode() !== 200) {
            throw new \RuntimeException(sprintf("HTTP Code = %s", $result->getHttpCode()));
        }
        if (!$result->getBody()) {
            throw new \RuntimeException("Body of file is empty");
        }

        return $result;
    }
}
