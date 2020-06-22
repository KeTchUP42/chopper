<?php
declare(strict_types = 1);

namespace Chopper\Curl\Request;

use Chopper\Curl\CurlBuilder\CurlBuilderInterface;

/**
 * CurlRequestInterface
 */
interface CurlRequestInterface
{
    /**
     * Inits Curl session
     *
     * @param string $url
     *
     * @return CurlBuilderInterface
     */
    public function init(string $url): CurlBuilderInterface;
}
