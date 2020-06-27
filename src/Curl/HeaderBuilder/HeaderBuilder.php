<?php
declare(strict_types = 1);

namespace Chopper\Curl\HeaderBuilder;

use Chopper\Curl\CurlBuilder\CurlBuilderInterface;
use Chopper\Curl\CurlInfo\CurlBaseInfo;

/**
 * HeaderBuilder
 * Http header builder, uses in CurlBuilder.
 */
class HeaderBuilder implements HeaderBuilderInterface
{
    /**
     * @var array
     */
    private $header = [];

    /**
     * @var CurlBuilderInterface
     */
    private $curlStatement;

    /**
     * Конструктор.
     *
     * @param CurlBuilderInterface $curlStatement
     */
    public function __construct(CurlBuilderInterface $curlStatement)
    {
        $this->curlStatement = $curlStatement;
    }

    /**
     * Method resets header
     *
     * @return $this|HeaderBuilderInterface
     */
    public function setBaseHeader(): HeaderBuilderInterface
    {
        $this->header = CurlBaseInfo::HEADER;

        return $this;
    }

    /**
     * Установка Header.
     *
     * @param array $header
     *
     * @return $this|HeaderBuilderInterface
     */
    public function setHeader(array $header): HeaderBuilderInterface
    {
        $this->header = $header;

        return $this;
    }

    /**
     * Method adds field to header
     *
     * @param string $fieled
     *
     * @return $this|HeaderBuilderInterface
     */
    public function addHeader(string $fieled): HeaderBuilderInterface
    {
        $this->header[] = $fieled;

        return $this;
    }

    /**
     * Method sets Curl host
     *
     * @param string $host
     *
     * @return $this|HeaderBuilderInterface
     */
    public function setHost(string $host): HeaderBuilderInterface
    {
        if (!empty($this->header)) {
            $this->header[] = "Host: ".$host;
        }

        return $this;
    }

    /**
     * Methof applies header
     *
     * @return CurlBuilderInterface
     */
    public function applyHeader(): CurlBuilderInterface
    {
        curl_setopt($this->curlStatement->getCurlDescriptor(), CURLOPT_HEADER, true);
        curl_setopt($this->curlStatement->getCurlDescriptor(), CURLOPT_HTTPHEADER, $this->header);

        return $this->curlStatement;
    }
}
