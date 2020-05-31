<?php
declare(strict_types = 1);

namespace Chopper\Curl\Response;

/**
 * CurlRespone
 */
class CurlResponse implements ICurlResponse
{
    /**
     * @var string
     */
    private $header;

    /**
     * @var string
     */
    private $body;

    /**
     * @var string
     */
    private $curl_error;

    /**
     * @var int
     */
    private $http_code;

    /**
     * @var string
     */
    private $last_url;

    /**
     * Конструктор.
     *
     * @param string $header
     * @param string $body
     * @param string $curl_error
     * @param int    $http_code
     * @param string $last_url
     */
    public function __construct(string $header, string $body, string $curl_error, int $http_code, string $last_url)
    {
        $this->header     = $header;
        $this->body       = $body;
        $this->curl_error = $curl_error;
        $this->http_code  = $http_code;
        $this->last_url   = $last_url;
    }

    /**
     * Получить Header
     *
     * @return string
     */
    public function getHeader(): string
    {
        return $this->header;
    }

    /**
     * Получить Body
     *
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Получить CurlError
     *
     * @return string
     */
    public function getCurlError(): string
    {
        return $this->curl_error;
    }

    /**
     * Получить HttpCode
     *
     * @return int
     */
    public function getHttpCode(): int
    {
        return $this->http_code;
    }

    /**
     * Получить LastUrl
     *
     * @return string
     */
    public function getLastUrl(): string
    {
        return $this->last_url;
    }
}
