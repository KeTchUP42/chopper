<?php
declare(strict_types = 1);

namespace Chopper\Logger\GlobalLogger;

use Chopper\Traits\SingletonTrait;
use Zend\Log\Logger;
use Zend\Log\LoggerInterface;
use Zend\Log\Writer\Stream;

/**
 * GlobalLogger
 */
final class GlobalLogger implements IGlobalLogger
{
    use SingletonTrait;

    /**
     * @var IGlobalLogger
     */
    private static $globalLogger;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var string
     */
    private $logFilePath;

    /**
     * Получить GlobalLogger
     *
     * @return IGlobalLogger
     */
    public static function getGlobalLogger(): IGlobalLogger
    {
        return self::$globalLogger ?? new self();
    }

    /**
     * Method configures global logger
     *
     * @param string $logFilePath
     */
    public static function configureGlobalLogger(string $logFilePath): void
    {
        self::$globalLogger = new self();
        self::$globalLogger->configureLogger($logFilePath);
    }

    /**
     * Global logger configuring
     *
     * @param string $logFilePath
     */
    public function configureLogger(string $logFilePath): void
    {
        if (file_exists($logFilePath)) {
            unlink($logFilePath);
        }
        $this->logFilePath = $logFilePath;
        $this->logger      = new Logger;
        $this->logger->addWriter(new Stream($logFilePath));
    }

    /**
     * Получить LogFilePath
     *
     * @return string
     */
    public function getLogFilePath(): string
    {
        return $this->logFilePath;
    }

    /**
     * Method returns system logger
     *
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        if ($this->logger === null) {
            throw new \RuntimeException(sprintf('%s did not configured.', self::class));
        }

        return $this->logger;
    }
}
