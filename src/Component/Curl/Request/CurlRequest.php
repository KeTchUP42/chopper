<?php
declare(strict_types = 1);

namespace Chopper\Component\Curl\Request;

use Chopper\Component\Curl\CurlStatement\CurlStatement;
use Chopper\Component\Curl\CurlStatement\ICurlStatement;

/**
 * CurlRequest
 */
class CurlRequest implements ICurlRequest
{
    /**
     * Init curl session
     *
     * @param string $url
     *
     * @return ICurlStatement
     */
    public function init(string $url): ICurlStatement
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        return new CurlStatement($ch);
    }
}
