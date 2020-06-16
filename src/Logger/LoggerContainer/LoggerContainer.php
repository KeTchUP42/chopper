<?php
declare(strict_types = 1);

namespace Chopper\Logger\LoggerContainer;

use Chopper\Exceptions\RuntimeException;
use Zend\Log\Logger;
use Zend\Log\LoggerInterface;
use Zend\Log\Writer\Stream;

/**
 * LoggerContainer
 */
class LoggerContainer implements LoggerContainerInterface
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var string
     */
    private $logFilePath;

    /**
     * @inheritDoc
     */
    public function configureLogger(string $logFilePath): void
    {
        if (file_exists($logFilePath)) {
            unlink($logFilePath);
        }
        $this->logFilePath = $logFilePath;
        $this->logger      = new Logger();
        $this->logger->addWriter(new Stream($logFilePath));
    }

    /**
     * @inheritDoc
     */
    public function getLogFilePath(): string
    {
        return $this->logFilePath;
    }

    /**
     * @inheritDoc
     */
    public function getLogger(): LoggerInterface
    {
        if ($this->logger === null) {
            throw new RuntimeException(sprintf('%s did not configured.', self::class));
        }

        return $this->logger;
    }
}
