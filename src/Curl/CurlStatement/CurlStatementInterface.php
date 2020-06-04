<?php
declare(strict_types = 1);

namespace Chopper\Curl\CurlStatement;

use Chopper\Curl\HeaderStatement\HeaderStatementInterface;
use Chopper\Curl\Response\CurlResponseInterface;

/**
 * CurlStatementInterface
 */
interface CurlStatementInterface
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
     * @return $this|CurlStatementInterface
     */
    public function useHeadMethod(): CurlStatementInterface;

    /**
     * Method enables post method
     *
     * @param string $postFields
     *
     * @return $this|CurlStatementInterface
     */
    public function usePostMethod(string $postFields): CurlStatementInterface;

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
     * @return $this|CurlStatementInterface
     */
    public function logIn(string $login, string $password): CurlStatementInterface;

    /**
     * Method sets referer
     *
     * @param string $referer
     *
     * @return $this|CurlStatementInterface
     */
    public function setReferer(string $referer): CurlStatementInterface;

    /**
     * @return $this|CurlStatementInterface
     */
    public function setBaseUserAgent(): CurlStatementInterface;

    /**
     * Method sets cookie file
     *
     * @param string $file
     *
     * @return $this|CurlStatementInterface
     */
    public function setCookieFile(string $file): CurlStatementInterface;

    /**
     * Method sets user agent
     *
     * @param string $userAgent
     *
     * @return $this|CurlStatementInterface
     */
    public function setUserAgent(string $userAgent): CurlStatementInterface;

    /**
     * Method sets cookie
     *
     * @param string $cookie
     *
     * @return $this|CurlStatementInterface
     */
    public function setCookie(string $cookie): CurlStatementInterface;

    /**
     * Method builds header
     *
     * @return HeaderStatementInterface
     */
    public function buildHeader(): HeaderStatementInterface;

    /**
     * Method sets log file
     *
     * @param string $logFilePath
     *
     * @return $this|CurlStatementInterface
     */
    public function setLogFile(string $logFilePath): CurlStatementInterface;

    /**
     * Method sets Curl timeout
     *
     * @param int $timeOut
     *
     * @return $this|CurlStatementInterface
     */
    public function setTimeOut(int $timeOut): CurlStatementInterface;

    /**
     * Method sets curl encoding
     *
     * @param string $encoding
     *
     * @return $this|CurlStatementInterface
     */
    public function setEncoding(string $encoding): CurlStatementInterface;
}
