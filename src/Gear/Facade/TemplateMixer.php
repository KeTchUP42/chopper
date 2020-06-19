<?php
declare(strict_types = 1);

namespace Chopper\Gear\Facade;

use Chopper\Gear\Handling\Mixer\Mixer;
use Chopper\Gear\Handling\MixerCell\MixerCellEssence\MixerCellInterface;
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
     * Конструктор.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Method executes mixer
     *
     * @param string             $dest
     *
     * @param MixerCellInterface $mixerCell
     *
     * @return bool
     */
    public function mix(string $dest, MixerCellInterface $mixerCell): bool
    {
        $data = (new Mixer($mixerCell, $this->logger))->handle();
        if (is_null($data)) {
            return false;
        }

        file_put_contents($dest, $data);
        if (!file_exists($dest)) {
            $this->logger->warn(sprintf("%s is not valid file path!", $dest));

            return false;
        }

        return true;
    }
}
