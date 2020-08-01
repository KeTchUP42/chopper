<?php
declare(strict_types = 1);

namespace App\Logger\LoggerContainer;

use App\Exceptions\RuntimeException;
use Zend\Log\Logger;
use Zend\Log\LoggerInterface;
use Zend\Log\Writer\Stream;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * LoggerContainer
 */
class LoggerContainer implements LoggerContainerInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var string
     */
    private $logFilePath;

    /**
     * @inheritDoc
     */
    public function configureLogger(string $logFilePath, bool $append = false): void
    {
        if ((!$append) && file_exists($logFilePath)) {
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
            throw new RuntimeException(sprintf('%s did not configured.', static::class));
        }

        return $this->logger;
    }
}
