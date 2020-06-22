<?php
declare(strict_types = 1);

namespace Chopper\Curl\CurlInfo;

/**
 * CurlBaseInfo
 * Base Curl session information
 */
interface CurlBaseInfo
{
    public const USER_AGENT = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Safari/537.36';
    public const HEADER     = [
        "Accept: text/xml,application/xml,application/xhtml+xml,text/main;q=0.9,text/plain;q=0.8,image/png,image/jpeg,*/*;q=0.5",
        "Accept-Language: ru-ru,ru;q=0.7,en-us;q=0.5,en;q=0.3",
        "Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.7",
        "Keep-Alive: 300"
    ];
}
