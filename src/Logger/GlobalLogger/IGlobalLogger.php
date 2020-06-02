<?php
declare(strict_types = 1);

namespace Chopper\Logger\GlobalLogger;

use Zend\Log\LoggerInterface;

/**
 * IGlobalLogger
 */
interface IGlobalLogger
{
    /**
     * Global logger configuring
     *
     * @param string $logFilePath
     */
    public function configureLogger(string $logFilePath): void;

    /**
     * Получить LogFilePath
     *
     * @return mixed
     */
    public function getLogFilePath(): string;

    /**
     * Method returns system logger
     *
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface;
}
