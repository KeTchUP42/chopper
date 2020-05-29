<?php
declare(strict_types = 1);

namespace Chopper\Component\Curl\CurlStatement;

use Chopper\Component\Curl\HeaderStatement\IHeaderStatement;
use Chopper\Component\Curl\Response\ICurlResponse;

/**
 *  ICurlStatement
 */
interface ICurlStatement
{
    /**
     * Make Curl request
     *
     * @return ICurlResponse
     */
    public function exec(): ICurlResponse;

    /**
     * Method enables head method
     *
     * @return $this|ICurlStatement
     */
    public function applyHeadMethod(): ICurlStatement;

    /**
     * Method enables post method
     *
     * @param string $postFields
     *
     * @return $this|ICurlStatement
     */
    public function applyPostMethod(string $postFields): ICurlStatement;

    /**
     * Method sets Curl pasw and login
     *
     * @param string $login
     * @param string $password
     *
     * @return $this|ICurlStatement
     */
    public function logIn(string $login, string $password): ICurlStatement;

    /**
     * Method sets referer
     *
     * @param string $referer
     *
     * @return $this|ICurlStatement
     */
    public function setReferer(string $referer): ICurlStatement;

    /**
     * @return $this|ICurlStatement
     */
    public function setBaseUserAgent(): ICurlStatement;

    /**
     * Method sets cookie file
     *
     * @param string $file
     *
     * @return $this|ICurlStatement
     */
    public function setCookieFile(string $file): ICurlStatement;

    /**
     * Method sets user agent
     *
     * @param string $userAgent
     *
     * @return $this|ICurlStatement
     */
    public function setUserAgent(string $userAgent): ICurlStatement;

    /**
     * Method sets cookie
     *
     * @param string $cookie
     *
     * @return $this|ICurlStatement
     */
    public function setCookie(string $cookie): ICurlStatement;

    /**
     * Method sets log file
     *
     * @param string $logFilePath
     *
     * @return $this|ICurlStatement
     */
    public function setLogFile(string $logFilePath): ICurlStatement;

    /**
     * Method sets Curl timeout
     *
     * @param int $timeOut
     *
     * @return $this|ICurlStatement
     */
    public function setTimeOut(int $timeOut): ICurlStatement;

    /**
     * Method builds header
     *
     * @return IHeaderStatement
     */
    public function buildHeader(): IHeaderStatement;

    /**
     * Получить CurlDescriptor
     *
     * @return resource
     */
    public function getCurlDescriptor();
}
