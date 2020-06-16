<?php
declare(strict_types = 1);

namespace Chopper\Gear\Handling\Mixer;

use Chopper\Gear\Handling\MixerCell\MixerCellInterface;

/**
 * MixerInterface
 */
interface MixerInterface
{
    /**
     * Установка MixerCell.
     *
     * @param MixerCellInterface $mixerCell
     *
     * @return MixerInterface
     */
    public function setMixerCell(MixerCellInterface $mixerCell): MixerInterface;

    /**
     * Method starts handling
     *
     * @return string
     */
    public function handle(): ?string;
}
