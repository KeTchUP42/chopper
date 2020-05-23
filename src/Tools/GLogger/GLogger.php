<?php
declare(strict_types = 1);

namespace Chopper\Tools\GLogger;

use Chopper\Exceptions\GLoggerException;
use Chopper\Traits\SingletonTrait;
use Zend\Log\Logger;
use Zend\Log\LoggerInterface;
use Zend\Log\Writer\Stream;

/**
 * GLogger
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
        unlink($logFilePath);
        static::$logger = new Logger;
        static::$logger->addWriter(new Stream($logFilePath));
    }

    /**
     * @return LoggerInterface
     */
    public static function getLogger(): LoggerInterface
    {
        if (static::$logger === null) {
            throw new GLoggerException('GLogger did not configured.');
        }

        return static::$logger;
    }
}
