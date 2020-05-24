<?php
declare(strict_types = 1);

namespace Chopper\Component\Logger\GlobalLogger;

use Chopper\Component\Logger\GlobalLogger\Exception\GLoggerException;
use Chopper\Component\Traits\SingletonTrait;
use Zend\Log\Logger;
use Zend\Log\LoggerInterface;
use Zend\Log\Writer\Stream;

/**
 * GlobalLogger
 */
class GLogger
{
    /**
     * @var
     */
    protected static $logger;

    use SingletonTrait;

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
        static::$logger = new Logger;
        static::$logger->addWriter(new Stream($logFilePath));
    }

    /**
     * @return LoggerInterface
     */
    public static function getLogger(): LoggerInterface
    {
        if (static::$logger === null) {
            throw new GLoggerException('GlobalLogger did not configured.');
        }

        return static::$logger;
    }
}
