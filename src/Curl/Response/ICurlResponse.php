<?php
declare(strict_types = 1);

namespace Chopper\Curl\Response;

/**
 *  ICurlResponse
 */
interface ICurlResponse
{
    /**
     * Получить Header
     *
     * @return string
     */
    public function getHeader(): string;

    /**
     * Получить Body
     *
     * @return string
     */
    public function getBody(): string;

    /**
     * Получить CurlError
     *
     * @return string
     */
    public function getCurlError(): string;

    /**
     * Получить HttpCode
     *
     * @return int
     */
    public function getHttpCode(): int;

    /**
     * Получить LastUrl
     *
     * @return string
     */
    public function getLastUrl(): string;
}
