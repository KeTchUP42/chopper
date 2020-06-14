<?php
declare(strict_types = 1);

namespace Chopper\Gear\Facade;

use Zend\Log\LoggerInterface;

/**
 * TemplateMixer
 */
final class TemplateMixer
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var string
     */
    private $templDir;

    /**
     * Конструктор.
     *
     * @param string          $templDir
     * @param LoggerInterface $logger
     */
    public function __construct(string $templDir, LoggerInterface $logger)
    {
        $this->templDir = $templDir;
        $this->logger   = $logger;
    }

    /**
     * Method executes mixer
     *
     * @param string $filename
     *
     * @return bool
     */
    public function mix(string $filename): bool
    {
        //todo
        return false;
    }
}
