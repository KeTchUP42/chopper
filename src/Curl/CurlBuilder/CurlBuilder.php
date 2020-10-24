<?php
declare(strict_types = 1);

namespace App\Curl\CurlBuilder;

use App\Curl\CurlInfo\CurlBaseInfo;
use App\Curl\HeaderBuilder\HeaderBuilder;
use App\Curl\HeaderBuilder\HeaderBuilderInterface;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * CurlBuilder
 */
class CurlBuilder extends AbstractCurlBuilder implements CurlBuilderInterface
{
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
     * Method sets Curl login and password
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
        if (is_file($logFilePath)) {
            $file       = fopen($logFilePath, 'ab');
            $multiplier = str_repeat(CurlBaseInfo::MULTIPLIER, 100);
            fwrite($file, "\n$multiplier\n");

            curl_setopt($this->ch, CURLOPT_STDERR, $file);
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
