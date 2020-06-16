<?php
declare(strict_types = 1);

namespace Chopper\Curl\CurlStatement;

use Chopper\Curl\HeaderStatement\HeaderStatement;
use Chopper\Curl\HeaderStatement\HeaderStatementInterface;
use Chopper\Curl\Response\CurlResponse;
use Chopper\Curl\Response\CurlResponseInterface;

/**
 * CurlStatement
 */
class CurlStatement implements CurlStatementInterface
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
     * @return $this|CurlStatementInterface
     */
    public function useHeadMethod(): CurlStatementInterface
    {
        curl_setopt($this->ch, CURLOPT_NOBODY, true);

        return $this;
    }

    /**
     * Method enables using post method
     *
     * @param mixed $postFields
     *
     * @return $this|CurlStatementInterface
     */
    public function usePostMethod($postFields): CurlStatementInterface
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
     * @return $this|CurlStatementInterface
     */
    public function logIn(string $login, string $password): CurlStatementInterface
    {
        curl_setopt($this->ch, CURLOPT_USERPWD, $login.':'.$password);

        return $this;
    }

    /**
     * Method sets referer
     *
     * @param string $referer
     *
     * @return $this|CurlStatementInterface
     */
    public function setReferer(string $referer): CurlStatementInterface
    {
        curl_setopt($this->ch, CURLOPT_REFERER, $referer);

        return $this;
    }

    /**
     * Method sets cookie file
     *
     * @param string $file
     *
     * @return $this|CurlStatementInterface
     */
    public function setCookieFile(string $file): CurlStatementInterface
    {
        curl_setopt($this->ch, CURLOPT_COOKIEFILE, $file);

        return $this;
    }

    /**
     * @return $this|CurlStatementInterface
     */
    public function setBaseUserAgent(): CurlStatementInterface
    {
        curl_setopt($this->ch, CURLOPT_USERAGENT, CurlBaseInfo::USER_AGENT);

        return $this;
    }

    /**
     * Method sets user agent
     *
     * @param string $userAgent
     *
     * @return $this|CurlStatementInterface
     */
    public function setUserAgent(string $userAgent): CurlStatementInterface
    {
        curl_setopt($this->ch, CURLOPT_USERAGENT, $userAgent);

        return $this;
    }

    /**
     * Method sets cookie
     *
     * @param string $cookie
     *
     * @return $this|CurlStatementInterface
     */
    public function setCookie(string $cookie): CurlStatementInterface
    {
        curl_setopt($this->ch, CURLOPT_COOKIE, $cookie);

        return $this;
    }

    /**
     * Method builds header
     *
     * @return HeaderStatementInterface
     */
    public function buildHeader(): HeaderStatementInterface
    {
        return new HeaderStatement($this);
    }

    /**
     * Method sets log file
     *
     * @param string $logFilePath
     *
     * @return $this|CurlStatementInterface
     */
    public function setLogFile(string $logFilePath): CurlStatementInterface
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
     * @return $this|CurlStatementInterface
     */
    public function setTimeOut(int $timeOut): CurlStatementInterface
    {
        curl_setopt($this->ch, CURLOPT_TIMEOUT, $timeOut);

        return $this;
    }

    /**
     * Method sets Curl encoding
     *
     * @param string $encoding
     *
     * @return $this|CurlStatementInterface
     */
    public function setEncoding(string $encoding): CurlStatementInterface
    {
        curl_setopt($this->ch, CURLOPT_ENCODING, $encoding);

        return $this;
    }
}
