<?php
declare(strict_types = 1);

namespace Chopper\Curl\Request;

use Chopper\Curl\CurlStatement\CurlStatementInterface;

/**
 * CurlRequestInterface
 */
interface CurlRequestInterface
{
    /**
     * Init Curl session
     *
     * @param string $url
     *
     * @return CurlStatementInterface
     */
    public function init(string $url): CurlStatementInterface;
}
