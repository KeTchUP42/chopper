<?php
declare(strict_types = 1);

namespace Chopper\Gear\Handling\Mixer;

use Chopper\Gear\Handling\MixerCell\MixerCellEssence\MixerCellInterface;
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
     * @var MixerCellInterface
     */
    protected $mixerCell;

    /**
     * Конструктор.
     *
     * @param MixerCellInterface $mixerCell
     * @param LoggerInterface    $logger
     */
    public function __construct(MixerCellInterface $mixerCell, LoggerInterface $logger)
    {
        $this->mixerCell = $mixerCell;
        $this->logger    = $logger;
    }

    /**
     * Установка MixerCell.
     *
     * @param MixerCellInterface $mixerCell
     *
     * @return MixerInterface
     */
    public function setMixerCell(MixerCellInterface $mixerCell): MixerInterface
    {
        $this->mixerCell = $mixerCell;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function handle(): ?string
    {
        $this->logger->info(sprintf("%s is calling %s handle method.", self::class, get_class($this->mixerCell)));
        $this->logger->info(sprintf("%s is calling mixer's handle method.", get_class($this->mixerCell)));

        try {
            $data = $this->mixerCell->handle();
            $this->logger->info(sprintf('Success!'));

            return $data;
        } catch (\Exception $exception) {
            $this->logger->err(sprintf('Error! %s', $exception->getMessage()));
        }

        return null;
    }
}
