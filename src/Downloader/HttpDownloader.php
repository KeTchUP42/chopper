<?php
declare(strict_types = 1);

namespace App\Downloader;

use App\Curl\Request\CurlRequestInterface;
use App\Curl\Response\CurlResponseInterface;
use App\Exceptions\RuntimeException;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * HttpDownloader
 */
class HttpDownloader implements DownloaderInterface
{
    /**
     * Http success result code
     */
    public const HTTP_SUCCESS = 200;

    /**
     * @var CurlRequestInterface
     */
    protected $curl;

    /**
     * @var string
     */
    protected $logFilePath;

    /**
     * Конструктор.
     *
     * @param CurlRequestInterface $curl
     * @param string               $logFilePath
     */
    public function __construct(CurlRequestInterface $curl, string $logFilePath = '')
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
    public function downloadfile(string $url, string $dest): bool
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
     * @return CurlResponseInterface
     */
    public function download(string $url): CurlResponseInterface
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new RuntimeException(sprintf("URL %s is not valid!", $url));
        }
        $builder = $this->curl->init($url)
            ->setTimeOut(300)
            ->setBaseUserAgent()
            ->buildHeader()
            ->setBaseHeader()
            ->applyHeader();

        if ($this->logFilePath) {
            $builder->setLogFile($this->logFilePath);
        }
        $result = $builder->exec();

        if ($result->getCurlError()) {
            throw new RuntimeException($result->getCurlError());
        }
        if ($result->getHttpCode() !== self::HTTP_SUCCESS) {
            throw new RuntimeException(sprintf("HTTP Code = %s", $result->getHttpCode()));
        }
        if (!$result->getBody()) {
            throw new RuntimeException(sprintf("Body of %s is empty!", get_class($result)));
        }

        return $result;
    }
}
