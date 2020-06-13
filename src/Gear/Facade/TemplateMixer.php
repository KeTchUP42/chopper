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
    private $templatesPath;

    /**
     * Конструктор.
     *
     * @param string          $templatesPath
     * @param LoggerInterface $logger
     */
    public function __construct(string $templatesPath, LoggerInterface $logger)
    {
        $this->templatesPath = $templatesPath;
        $this->logger        = $logger;
    }

    /**
     * Method generates new file from some templates
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
