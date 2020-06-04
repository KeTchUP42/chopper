<?php
declare(strict_types = 1);

namespace Chopper\Curl\HeaderStatement;

use Chopper\Curl\CurlStatement\CurlBaseInfo;
use Chopper\Curl\CurlStatement\CurlStatementInterface;

/**
 *  HeaderStatement
 */
class HeaderStatement implements HeaderStatementInterface
{
    /**
     * @var array
     */
    private $header = [];

    /**
     * @var CurlStatementInterface
     */
    private $curlStatement;

    /**
     * Конструктор.
     *
     * @param CurlStatementInterface $curlStatement
     */
    public function __construct(CurlStatementInterface $curlStatement)
    {
        $this->curlStatement = $curlStatement;
    }

    /**
     * Method resets header
     *
     * @return $this|HeaderStatementInterface
     */
    public function setBaseHeader(): HeaderStatementInterface
    {
        $this->header = CurlBaseInfo::HEADER;

        return $this;
    }

    /**
     * Установка Header.
     *
     * @param array $header
     *
     * @return $this|HeaderStatementInterface
     */
    public function setHeader(array $header): HeaderStatementInterface
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Method adds field to header
     *
     * @param string $fieled
     *
     * @return $this|HeaderStatementInterface
     */
    public function addHeader(string $fieled): HeaderStatementInterface
    {
        $this->header[] = $fieled;

        return $this;
    }

    /**
     * Method sets Curl host
     *
     * @param string $host
     *
     * @return $this|HeaderStatementInterface
     */
    public function setHost(string $host): HeaderStatementInterface
    {
        if (!empty($this->header)) {
            $this->header[] = "Host: ".$host;
        }

        return $this;
    }

    /**
     * Methof applies header
     *
     * @return CurlStatementInterface
     */
    public function applyHeader(): CurlStatementInterface
    {
        curl_setopt($this->curlStatement->getCurlDescriptor(), CURLOPT_HEADER, true);
        curl_setopt($this->curlStatement->getCurlDescriptor(), CURLOPT_HTTPHEADER, $this->header);

        return $this->curlStatement;
    }
}
