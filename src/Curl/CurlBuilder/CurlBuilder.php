<?php
declare(strict_types = 1);

namespace Chopper\Curl\CurlBuilder;

use Chopper\Curl\CurlInfo\CurlBaseInfo;
use Chopper\Curl\HeaderBuilder\HeaderBuilder;
use Chopper\Curl\HeaderBuilder\HeaderBuilderInterface;
use Chopper\Curl\Response\CurlResponse;
use Chopper\Curl\Response\CurlResponseInterface;

/**
 * CurlBuilder
 */
class CurlBuilder implements CurlBuilderInterface
{
    /**
     * @var resource
     */
    private $ch;

    /**
     * Конструктор.
     *
     * @param resource $ch
     */
    public function __construct($ch)
    {
        $this->ch = $ch;
    }

    /**
     * Make Curl request
     *
     * @return CurlResponseInterface
     */
    public function exec(): CurlResponseInterface
    {
        $response   = curl_exec($this->ch);
        $curl_error = curl_error($this->ch);

        if ($curl_error !== "") {
            return new CurlResponse('', '', $curl_error, -1, '');
        }

        $header_size = curl_getinfo($this->ch, CURLINFO_HEADER_SIZE);
        $header      = substr($response, 0, $header_size);
        $body        = substr($response, $header_size);
        $http_code   = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        $last_url    = curl_getinfo($this->ch, CURLINFO_EFFECTIVE_URL);

        return new CurlResponse($header, $body, $curl_error, $http_code, $last_url);
    }

    /**
     * Получить CurlDescriptor
     *
     * @return resource
     */
    public function getCurlDescriptor()
    {
        return $this->ch;
    }

    /**
     * Method enables head method
     *
     * @return $this|CurlBuilderInterface
     */
    public function useHeadMethod(): CurlBuilderInterface
    {
        curl_setopt($this->ch, CURLOPT_NOBODY, true);

        return $this;
    }

    /**
     * Method enables using post method
     *
     * @param mixed $postFields
     *
     * @return $this|CurlBuilderInterface
     */
    public function usePostMethod($postFields): CurlBuilderInterface
    {
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $postFields);

        return $this;
    }

    /**
     * Method sets Curl login and pasw
     *
     * @param string $login
     * @param string $password
     *
     * @return $this|CurlBuilderInterface
     */
    public function logIn(string $login, string $password): CurlBuilderInterface
    {
        curl_setopt($this->ch, CURLOPT_USERPWD, $login.':'.$password);

        return $this;
    }

    /**
     * Method sets referer
     *
     * @param string $referer
     *
     * @return $this|CurlBuilderInterface
     */
    public function setReferer(string $referer): CurlBuilderInterface
    {
        curl_setopt($this->ch, CURLOPT_REFERER, $referer);

        return $this;
    }

    /**
     * Method sets cookie file
     *
     * @param string $file
     *
     * @return $this|CurlBuilderInterface
     */
    public function setCookieFile(string $file): CurlBuilderInterface
    {
        curl_setopt($this->ch, CURLOPT_COOKIEFILE, $file);

        return $this;
    }

    /**
     * @return $this|CurlBuilderInterface
     */
    public function setBaseUserAgent(): CurlBuilderInterface
    {
        curl_setopt($this->ch, CURLOPT_USERAGENT, CurlBaseInfo::USER_AGENT);

        return $this;
    }

    /**
     * Method sets user agent
     *
     * @param string $userAgent
     *
     * @return $this|CurlBuilderInterface
     */
    public function setUserAgent(string $userAgent): CurlBuilderInterface
    {
        curl_setopt($this->ch, CURLOPT_USERAGENT, $userAgent);

        return $this;
    }

    /**
     * Method sets cookie
     *
     * @param string $cookie
     *
     * @return $this|CurlBuilderInterface
     */
    public function setCookie(string $cookie): CurlBuilderInterface
    {
        curl_setopt($this->ch, CURLOPT_COOKIE, $cookie);

        return $this;
    }

    /**
     * Method builds header
     *
     * @return HeaderBuilderInterface
     */
    public function buildHeader(): HeaderBuilderInterface
    {
        return new HeaderBuilder($this);
    }

    /**
     * Method sets log file
     *
     * @param string $logFilePath
     *
     * @return $this|CurlBuilderInterface
     */
    public function setLogFile(string $logFilePath): CurlBuilderInterface
    {
        if (file_exists($logFilePath)) {
            curl_setopt($this->ch, CURLOPT_STDERR, fopen($logFilePath, 'wb+'));
            curl_setopt($this->ch, CURLOPT_VERBOSE, 1);
        }

        return $this;
    }

    /**
     * Method sets Curl timeout
     *
     * @param int $timeOut
     *
     * @return $this|CurlBuilderInterface
     */
    public function setTimeOut(int $timeOut): CurlBuilderInterface
    {
        curl_setopt($this->ch, CURLOPT_TIMEOUT, $timeOut);

        return $this;
    }

    /**
     * Method sets Curl encoding
     *
     * @param string $encoding
     *
     * @return $this|CurlBuilderInterface
     */
    public function setEncoding(string $encoding): CurlBuilderInterface
    {
        curl_setopt($this->ch, CURLOPT_ENCODING, $encoding);

        return $this;
    }
}
