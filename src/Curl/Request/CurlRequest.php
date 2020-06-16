<?php
declare(strict_types = 1);

namespace Chopper\Curl\Request;

use Chopper\Curl\CurlStatement\CurlStatement;
use Chopper\Curl\CurlStatement\CurlStatementInterface;

/**
 * CurlRequest
 */
class CurlRequest implements CurlRequestInterface
{
    /**
     * Inits curl session
     *
     * @param string $url
     *
     * @return CurlStatementInterface
     */
    public function init(string $url): CurlStatementInterface
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        return new CurlStatement($ch);
    }
}
