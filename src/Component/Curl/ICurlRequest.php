<?php
declare(strict_types = 1);

namespace Chopper\Component\Curl;

/**
 * ICurlRequest
 */
interface ICurlRequest
{
    /**
     * Init curl session
     *
     * @param array $params
     */
    public function init(array $params): void;

    /**
     * Make curl request
     *
     * @return array
     */
    public function exec(): array;

    /**
     * Method sets log file
     *
     * @param string $logFilePath
     */
    public function setLogFile(string $logFilePath): void;
}
