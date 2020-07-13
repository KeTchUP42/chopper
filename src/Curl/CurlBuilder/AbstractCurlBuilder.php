<?php
declare(strict_types = 1);

namespace Chopper\Curl\CurlBuilder;

use Chopper\Curl\Response\CurlResponse;
use Chopper\Curl\Response\CurlResponseInterface;

/**
 * AbstractCurlBuilder
 *
 * Class contains base builder code.
 */
abstract class AbstractCurlBuilder
{
    /**
     * @var resource
     */
    protected $ch;

    /**
     * Конструктор.
     *
     * @param resource $ch
     */
    public function __construct($ch)
    {
        $this->ch = $ch;
    }

    /**
     * Make Curl request
     *
     * @return CurlResponseInterface
     */
    public function exec(): CurlResponseInterface
    {
        $response   = curl_exec($this->ch);
        $curl_error = curl_error($this->ch);

        if ($curl_error !== "") {
            return new CurlResponse('', '', $curl_error, -1, '');
        }

        $header_size = curl_getinfo($this->ch, CURLINFO_HEADER_SIZE);
        $header      = substr($response, 0, $header_size);
        $body        = substr($response, $header_size);
        $http_code   = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        $last_url    = curl_getinfo($this->ch, CURLINFO_EFFECTIVE_URL);

        return new CurlResponse($header, $body, $curl_error, $http_code, $last_url);
    }

    /**
     * Получить CurlDescriptor
     *
     * @return resource
     */
    public function getCurlDescriptor()
    {
        return $this->ch;
    }
}
