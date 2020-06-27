<?php
declare(strict_types = 1);

namespace Chopper\Logger\GlobalLogger;

use Chopper\Logger\LoggerContainer\LoggerContainer;
use Chopper\Logger\LoggerContainer\LoggerContainerInterface;
use Chopper\Traits\ClosedConstructorTrait;

/**
 * Global system logger, it uses log file path form .env config.
 */
final class SystemLogger
{
    use ClosedConstructorTrait;

    /**
     * @var LoggerContainerInterface
     */
    private static $loggerContainer;

    /**
     * Получить GlobalLoggerContainer
     *
     * @return LoggerContainerInterface
     */
    public static function getLoggerContainer(): LoggerContainerInterface
    {
        return self::$loggerContainer ?? new LoggerContainer();
    }

    /**
     * Method configures global logger
     *
     * @param string $logFilePath
     */
    public static function configureGlobalLogger(string $logFilePath): void
    {
        self::$loggerContainer = new LoggerContainer();
        self::$loggerContainer->configureLogger($logFilePath);
    }
}
