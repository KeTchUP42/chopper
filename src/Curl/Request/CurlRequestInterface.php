<?php
declare(strict_types = 1);

namespace Chopper\Curl\Request;

use Chopper\Curl\CurlBuilder\CurlBuilderInterface;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * Inits building of Curl session.
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
