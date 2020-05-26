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
     * $params =
     *  [
     *    'url'         => '',
     *    'host'        => '',
     *    'header'      => '',
     *    'method'      => '',
     *    'referer'     => '',
     *    'cookie'      => '',
     *    'post_fields' => '',
     *    'timeout'     => 0
     *    ['login'      => '',]
     *    ['password'   => '',]
     *  ];
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
     * @param string $logFile
     */
    public function setLogFile(string $logFile): void;
}
