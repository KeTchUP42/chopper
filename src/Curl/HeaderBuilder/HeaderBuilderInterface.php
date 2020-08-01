<?php
declare(strict_types = 1);

namespace App\Curl\HeaderBuilder;

use App\Curl\CurlBuilder\CurlBuilderInterface;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * HeaderBuilderInterface
 */
interface HeaderBuilderInterface
{
    /**
     * Method applies header
     *
     * @return CurlBuilderInterface
     */
    public function applyHeader(): CurlBuilderInterface;

    /**
     * Установка Header.
     *
     * @param array $header
     *
     * @return $this|HeaderBuilderInterface
     */
    public function setHeader(array $header): HeaderBuilderInterface;

    /**
     * Method resets header
     *
     * @return $this|HeaderBuilderInterface
     */
    public function setBaseHeader(): HeaderBuilderInterface;

    /**
     * Method adds field to header
     *
     * @param string $fieled
     *
     * @return $this|HeaderBuilderInterface
     */
    public function addHeader(string $fieled): HeaderBuilderInterface;

    /**
     * Method sets Curl host
     *
     * @param string $host
     *
     * @return $this|HeaderBuilderInterface
     */
    public function setHost(string $host): HeaderBuilderInterface;
}
