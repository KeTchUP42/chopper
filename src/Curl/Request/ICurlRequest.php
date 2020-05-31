<?php
declare(strict_types = 1);

namespace Chopper\Curl\Request;

use Chopper\Curl\CurlStatement\ICurlStatement;

/**
 * ICurlRequest
 */
interface ICurlRequest
{
    /**
     * Init Curl session
     *
     * @param string $url
     *
     * @return ICurlStatement
     */
    public function init(string $url): ICurlStatement;
}
