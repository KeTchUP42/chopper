<?php
declare(strict_types = 1);

namespace Chopper\Logger\GlobalLogger;

use Chopper\Logger\LoggerContainer\LoggerContainer;
use Chopper\Logger\LoggerContainer\LoggerContainerInterface;
use Chopper\Traits\SingletonTrait;

/**
 * SystemLogger
 */
final class SystemLogger
{
    use SingletonTrait;

    /**
     * @var LoggerContainerInterface
     */
    private static $globalLoggerContainer;

    /**
     * Получить GlobalLoggerContainer
     *
     * @return LoggerContainerInterface
     */
    public static function getGlobalLoggerContainer(): LoggerContainerInterface
    {
        return self::$globalLoggerContainer ?? new LoggerContainer();
    }

    /**
     * Method configures global logger
     *
     * @param string $logFilePath
     */
    public static function configureGlobalLogger(string $logFilePath): void
    {
        self::$globalLoggerContainer = new LoggerContainer();
        self::$globalLoggerContainer->configureLogger($logFilePath);
    }
}
