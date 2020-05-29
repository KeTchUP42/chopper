<?php
declare(strict_types = 1);

namespace Chopper\Component\Curl\HeaderStatement;

use Chopper\Component\Curl\CurlStatement\CurlBaseInfo;
use Chopper\Component\Curl\CurlStatement\ICurlStatement;

/**
 *  HeaderStatement
 */
class HeaderStatement implements IHeaderStatement
{
    /**
     * @var array
     */
    private $header = [];

    /**
     * @var ICurlStatement
     */
    private $curlStatement;

    /**
     * Конструктор.
     *
     * @param ICurlStatement $curlStatement
     */
    public function __construct(ICurlStatement $curlStatement)
    {
        $this->curlStatement = $curlStatement;
    }

    /**
     * Method resets header
     *
     * @return $this|IHeaderStatement
     */
    public function setBaseHeader(): IHeaderStatement
    {
        $this->header = CurlBaseInfo::HEADER;

        return $this;
    }

    /**
     * Установка Header.
     *
     * @param array $header
     *
     * @return $this|IHeaderStatement
     */
    public function setHeader(array $header): IHeaderStatement
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Method adds field to header
     *
     * @param string $fieled
     *
     * @return $this|IHeaderStatement
     */
    public function addHeader(string $fieled): IHeaderStatement
    {
        $this->header[] = $fieled;

        return $this;
    }

    /**
     * Method sets Curl host
     *
     * @param string $host
     *
     * @return $this|IHeaderStatement
     */
    public function setHost(string $host): IHeaderStatement
    {
        if (!empty($this->header)) {
            $this->header[] = "Host: ".$host;
        }

        return $this;
    }

    /**
     * Methof applies header
     *
     * @return ICurlStatement
     */
    public function applyHeader(): ICurlStatement
    {
        curl_setopt($this->curlStatement->getCurlDescriptor(), CURLOPT_HEADER, true);
        curl_setopt($this->curlStatement->getCurlDescriptor(), CURLOPT_HTTPHEADER, $this->header);

        return $this->curlStatement;
    }
}
