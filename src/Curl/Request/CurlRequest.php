<?php
declare(strict_types = 1);

namespace App\Curl\Request;

use App\Curl\CurlBuilder\CurlBuilder;
use App\Curl\CurlBuilder\CurlBuilderInterface;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * CurlRequest
 */
class CurlRequest implements CurlRequestInterface
{
    /**
     * Inits Curl session
     *
     * @param string $url
     *
     * @return CurlBuilderInterface
     */
    public function init(string $url): CurlBuilderInterface
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        return new CurlBuilder($ch);
    }
}
