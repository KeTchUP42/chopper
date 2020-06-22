<?php
declare(strict_types = 1);

namespace Chopper\Curl\CurlBuilder;

use Chopper\Curl\HeaderBuilder\HeaderBuilderInterface;
use Chopper\Curl\Response\CurlResponseInterface;

/**
 * CurlBuilderInterface
 */
interface CurlBuilderInterface
{
    /**
     * Make Curl request
     *
     * @return CurlResponseInterface
     */
    public function exec(): CurlResponseInterface;

    /**
     * Method enables head method
     *
     * @return $this|CurlBuilderInterface
     */
    public function useHeadMethod(): CurlBuilderInterface;

    /**
     * Method enables using post method
     *
     * @param string $postFields
     *
     * @return $this|CurlBuilderInterface
     */
    public function usePostMethod(string $postFields): CurlBuilderInterface;

    /**
     * Получить CurlDescriptor
     *
     * @return resource
     */
    public function getCurlDescriptor();

    /**
     * Method sets Curl pasw and login
     *
     * @param string $login
     * @param string $password
     *
     * @return $this|CurlBuilderInterface
     */
    public function logIn(string $login, string $password): CurlBuilderInterface;

    /**
     * Method sets referer
     *
     * @param string $referer
     *
     * @return $this|CurlBuilderInterface
     */
    public function setReferer(string $referer): CurlBuilderInterface;

    /**
     * @return $this|CurlBuilderInterface
     */
    public function setBaseUserAgent(): CurlBuilderInterface;

    /**
     * Method sets cookie file
     *
     * @param string $file
     *
     * @return $this|CurlBuilderInterface
     */
    public function setCookieFile(string $file): CurlBuilderInterface;

    /**
     * Method sets user agent
     *
     * @param string $userAgent
     *
     * @return $this|CurlBuilderInterface
     */
    public function setUserAgent(string $userAgent): CurlBuilderInterface;

    /**
     * Method sets cookie
     *
     * @param string $cookie
     *
     * @return $this|CurlBuilderInterface
     */
    public function setCookie(string $cookie): CurlBuilderInterface;

    /**
     * Method builds header
     *
     * @return HeaderBuilderInterface
     */
    public function buildHeader(): HeaderBuilderInterface;

    /**
     * Method sets log file
     *
     * @param string $logFilePath
     *
     * @return $this|CurlBuilderInterface
     */
    public function setLogFile(string $logFilePath): CurlBuilderInterface;

    /**
     * Method sets Curl timeout
     *
     * @param int $timeOut
     *
     * @return $this|CurlBuilderInterface
     */
    public function setTimeOut(int $timeOut): CurlBuilderInterface;

    /**
     * Method sets curl encoding
     *
     * @param string $encoding
     *
     * @return $this|CurlBuilderInterface
     */
    public function setEncoding(string $encoding): CurlBuilderInterface;
}
