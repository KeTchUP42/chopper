<?php
declare(strict_types = 1);

namespace App\Logger\GlobalLogger;

use App\Exceptions\RuntimeException;
use App\Logger\LoggerContainer\LoggerContainer;
use App\Logger\LoggerContainer\LoggerContainerInterface;
use App\Traits\ClosedConstructorTrait;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
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
        if (self::$loggerContainer === null) {
            throw new RuntimeException(sprintf('%s did not configured.', self::class));
        }

        return self::$loggerContainer;
    }

    /**
     * Method configures global logger
     *
     * @param string $logFilePath
     */
    public static function configureGlobalLogger(string $logFilePath): void
    {
        self::$loggerContainer = new LoggerContainer();
        self::$loggerContainer->configureLogger($logFilePath, true);
    }
}
