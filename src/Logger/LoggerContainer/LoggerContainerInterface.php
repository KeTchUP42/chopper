<?php
declare(strict_types = 1);

namespace Chopper\Logger\LoggerContainer;

use Zend\Log\LoggerInterface;

/**
 * LoggerContainerInterface
 */
interface LoggerContainerInterface
{
    /**
     * Logger configuring
     *
     * @param string $logFilePath
     */
    public function configureLogger(string $logFilePath): void;

    /**
     * Получить LogFilePath
     *
     * @return string
     */
    public function getLogFilePath(): string;

    /**
     * Method returns containers logger
     *
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface;
}
