<?php
declare(strict_types = 1);

namespace Chopper\Component\Curl\CurlStatement;

use Chopper\Component\Curl\HeaderStatement\HeaderStatement;
use Chopper\Component\Curl\HeaderStatement\IHeaderStatement;
use Chopper\Component\Curl\Response\CurlResponse;
use Chopper\Component\Curl\Response\ICurlResponse;

/**
 * CurlStatement
 */
class CurlStatement implements ICurlStatement
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
     * @return ICurlResponse
     */
    public function exec(): ICurlResponse
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
     * @return $this|ICurlStatement
     */
    public function applyHeadMethod(): ICurlStatement
    {
        curl_setopt($this->ch, CURLOPT_NOBODY, true);

        return $this;
    }

    /**
     * Method enables post method
     *
     * @param string $postFields
     *
     * @return $this|ICurlStatement
     */
    public function applyPostMethod(string $postFields): ICurlStatement
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
     * @return $this|ICurlStatement
     */
    public function logIn(string $login, string $password): ICurlStatement
    {
        curl_setopt($this->ch, CURLOPT_USERPWD, $login.':'.$password);

        return $this;
    }

    /**
     * Method sets referer
     *
     * @param string $referer
     *
     * @return $this|ICurlStatement
     */
    public function setReferer(string $referer): ICurlStatement
    {
        curl_setopt($this->ch, CURLOPT_REFERER, $referer);

        return $this;
    }

    /**
     * Method sets cookie file
     *
     * @param string $file
     *
     * @return $this|ICurlStatement
     */
    public function setCookieFile(string $file): ICurlStatement
    {
        curl_setopt($this->ch, CURLOPT_COOKIEFILE, $file);

        return $this;
    }

    /**
     * @return $this|ICurlStatement
     */
    public function setBaseUserAgent(): ICurlStatement
    {
        curl_setopt($this->ch, CURLOPT_USERAGENT, CurlBaseInfo::USER_AGENT);

        return $this;
    }

    /**
     * Method sets user agent
     *
     * @param string $userAgent
     *
     * @return $this|ICurlStatement
     */
    public function setUserAgent(string $userAgent): ICurlStatement
    {
        curl_setopt($this->ch, CURLOPT_USERAGENT, $userAgent);

        return $this;
    }

    /**
     * Method sets cookie
     *
     * @param string $cookie
     *
     * @return $this|ICurlStatement
     */
    public function setCookie(string $cookie): ICurlStatement
    {
        curl_setopt($this->ch, CURLOPT_COOKIE, $cookie);

        return $this;
    }

    /**
     * Method builds header
     *
     * @return IHeaderStatement
     */
    public function buildHeader(): IHeaderStatement
    {
        return new HeaderStatement($this);
    }

    /**
     * Method sets log file
     *
     * @param string $logFilePath
     *
     * @return $this|ICurlStatement
     */
    public function setLogFile(string $logFilePath): ICurlStatement
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
     * @return $this|ICurlStatement
     */
    public function setTimeOut(int $timeOut): ICurlStatement
    {
        curl_setopt($this->ch, CURLOPT_TIMEOUT, $timeOut);

        return $this;
    }
}
