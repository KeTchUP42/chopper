<?php
declare(strict_types = 1);

namespace Chopper\Curl\HeaderStatement;

use Chopper\Curl\CurlStatement\CurlStatementInterface;

/**
 * HeaderStatementInterface
 */
interface HeaderStatementInterface
{
    /**
     * Method applies header
     *
     * @return CurlStatementInterface
     */
    public function applyHeader(): CurlStatementInterface;

    /**
     * Установка Header.
     *
     * @param array $header
     *
     * @return $this|HeaderStatementInterface
     */
    public function setHeader(array $header): HeaderStatementInterface;

    /**
     * Method resets header
     *
     * @return $this|HeaderStatementInterface
     */
    public function setBaseHeader(): HeaderStatementInterface;

    /**
     * Method adds field to header
     *
     * @param string $fieled
     *
     * @return $this|HeaderStatementInterface
     */
    public function addHeader(string $fieled): HeaderStatementInterface;

    /**
     * Method sets Curl host
     *
     * @param string $host
     *
     * @return $this|HeaderStatementInterface
     */
    public function setHost(string $host): HeaderStatementInterface;
}
