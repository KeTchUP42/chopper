<?php
declare(strict_types = 1);

namespace Chopper\Component\Curl\HeaderStatement;

use Chopper\Component\Curl\CurlStatement\ICurlStatement;

/**
 * IHeaderStatement
 */
interface IHeaderStatement
{
    /**
     * Method applies header
     *
     * @return ICurlStatement
     */
    public function applyHeader(): ICurlStatement;

    /**
     * Установка Header.
     *
     * @param array $header
     *
     * @return $this|IHeaderStatement
     */
    public function setHeader(array $header): IHeaderStatement;

    /**
     * Method resets header
     *
     * @return $this|IHeaderStatement
     */
    public function setBaseHeader(): IHeaderStatement;

    /**
     * Method adds field to header
     *
     * @param string $fieled
     *
     * @return $this|IHeaderStatement
     */
    public function addHeader(string $fieled): IHeaderStatement;

    /**
     * Method sets Curl host
     *
     * @param string $host
     *
     * @return $this|IHeaderStatement
     */
    public function setHost(string $host): IHeaderStatement;
}
