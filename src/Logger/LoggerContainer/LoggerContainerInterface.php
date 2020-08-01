<?php
declare(strict_types = 1);

namespace App\Logger\LoggerContainer;

use Zend\Log\LoggerInterface;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * LoggerContainerInterface
 */
interface LoggerContainerInterface
{
    /**
     * Logger configuring
     *
     * @param string $logFilePath
     * @param bool   $append
     */
    public function configureLogger(string $logFilePath, bool $append = false): void;

    /**
     * Получить LogFilePath
     *
     * @return string
     */
    public function getLogFilePath(): string;

    /**
     * Method returns logger from container
     *
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface;
}
