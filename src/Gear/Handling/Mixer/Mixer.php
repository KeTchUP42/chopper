<?php
declare(strict_types = 1);

namespace Chopper\Gear\Handling\Mixer;

use Zend\Log\LoggerInterface;

/**
 * Mixer
 */
class Mixer implements MixerInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Конструктор.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    //todo
}
