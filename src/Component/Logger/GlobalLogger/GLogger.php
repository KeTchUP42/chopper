<?php
declare(strict_types = 1);

namespace Chopper\Component\Logger\GlobalLogger;

use Chopper\Component\Traits\SingletonTrait;
use Zend\Log\Logger;
use Zend\Log\LoggerInterface;
use Zend\Log\Writer\Stream;

/**
 * GlobalLogger
 */
class GLogger
{
    use SingletonTrait;

    /**
     * @var LoggerInterface
     */
    private static $logger;

    /**
     * @var string
     */
    private static $logFilePath;

    /**
     * Global logger configuring
     *
     * @param string $logFilePath
     */
    public static function configureGlobalLogger(string $logFilePath): void
    {
        if (file_exists($logFilePath)) {
            unlink($logFilePath);
        }
        self::$logFilePath = $logFilePath;
        self::$logger      = new Logger;
        self::$logger->addWriter(new Stream($logFilePath));
    }

    /**
     * Получить LogFilePath
     *
     * @return mixed
     */
    public static function getLogFilePath(): string
    {
        return self::$logFilePath;
    }

    /**
     * @return LoggerInterface
     */
    public static function getLogger(): LoggerInterface
    {
        if (self::$logger === null) {
            throw new \RuntimeException(sprintf('%s did not configured.', self::class));
        }

        return self::$logger;
    }
}
